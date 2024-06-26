<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Establish database connection (assuming localhost, root user, empty password)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $registrationNumber = $_POST['studentId'];
    $buildingType = $_POST['building'];
    $mess = $_POST['mess'];
    $contactNumber = $_POST['contactNumber'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : ''; // Handle gender selection
    $totalFees = $_POST['totalFees'];

    // Check available rooms in the selected building
    $checkAvailabilitySQL = "SELECT available_rooms FROM buildings WHERE name = '$buildingType'";
    $result = $conn->query($checkAvailabilitySQL);

    if ($result === false) {
        echo "<script>alert('Error checking available rooms: " . $conn->error . "');</script>";
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableRooms = $row['available_rooms'];

        if ($availableRooms > 0) {
            // Insert data into the user_registration table
            $sql = "INSERT INTO user_registration (name, email, registration_number, building_type, mess, contact_number, gender, total_fees, created_at) 
                    VALUES ('$name', '$email', '$registrationNumber', '$buildingType', '$mess', '$contactNumber', '$gender', '$totalFees', NOW())";

            if ($conn->query($sql) === TRUE) {
                // Update available_rooms in buildings table
                $updateBuildingSQL = "UPDATE buildings SET available_rooms = available_rooms - 1 WHERE name = '$buildingType'";
                $conn->query($updateBuildingSQL);

                // Assign room number
                $roomNumber = assignRoomNumber($conn, $buildingType);

                // Update the user registration record with the assigned room number
                $updateRoomNumberSQL = "UPDATE user_registration SET room_number = '$roomNumber' WHERE registration_number = '$registrationNumber'";
                $conn->query($updateRoomNumberSQL);

                echo "<script>alert('Record inserted successfully. Room Number: $roomNumber');</script>";
            } else {
                echo "<script>alert('Error inserting record: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('No room available in the selected building.');</script>";
        }
    } else {
        echo "<script>alert('Error: No result from the query. Building type: $buildingType');</script>";
    }
}

$conn->close();

function assignRoomNumber($conn, $buildingType) {
    // You can implement your logic to calculate and assign room numbers based on the building
    // For example, you could query the database for the next available room number in the selected building
    $query = "SELECT MAX(room_number) + 1 AS next_room FROM user_registration WHERE building_type = '$buildingType'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['next_room'] ?? 1; // Default to 1 if no previous room numbers
    }

    return 1; // Default to 1 if no previous room numbers
}
?>
<?php
// Establish database connection (assuming localhost, root user, empty password)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch building types and fees from the database
$buildingData = array();
$result = $conn->query("SELECT name, fees FROM buildings");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $buildingData[$row["name"]] = $row["fees"];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .welcome-message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .user-dropdown {
            position: absolute;
            top: 20px;
            right: 20px;
        }
       
    </style>
</head>
<body>

<div class="dashboard-container">
    <?php include('newpage.php')?>
        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
           
<form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="form-control" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>

    <label for="studentId">Student ID:</label>
    <input type="text" id="studentId" name="studentId" class="form-control" required><br>

    <label for="building">Building Name/Type:</label>
    <select id="building" name="building" class="form-control" required>
        <option value="" disabled selected>Select Building Type</option>
        <?php
        foreach ($buildingData as $buildingType => $fees) {
            echo "<option value='$buildingType' data-fees='$fees'>$buildingType</option>";
        }
        ?>
    </select><br>

    <label for="mess">Mess:</label>
    <select id="mess" name="mess" class="form-control" required>
        <option value="" disabled selected>Select Mess Option</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select><br>

    <label for="contactNumber">Contact Number:</label>
    <input type="text" id="contactNumber" name="contactNumber" class="form-control" required pattern="[0-9]{11}"><br>

    <label for="gender">Gender:</label>
    <input type="radio" id="male" name="gender" value="male" required>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" required>
    <label for="female">Female</label><br>

    <label for="totalFees">Total Fees per Month:</label>
    <input type="text" id="totalFees" name="totalFees" class="form-control" readonly>
    <br>

    <input type="submit" value="Submit" class="btn btn-primary">
</form>
        </main>
    </div>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the 'mess' dropdown
    document.getElementById('mess').addEventListener('change', updateTotalFees);

    // Fetch the form element
    var form = document.getElementById('registrationForm');

    // Add event listener for form submission
    form.addEventListener('submit', function (event) {
        // Check if the form is valid
        if (!form.checkValidity()) {
            event.preventDefault(); // Prevent the default form submission
            event.stopPropagation();
        }

        // Initial update of fees when the page loads
        updateTotalFees();
        form.classList.add('was-validated'); // Add Bootstrap's 'was-validated' class for styling
    });
});

function updateTotalFees() {
    var buildingSelect = document.getElementById('building');
    var messOption = document.getElementById('mess').value;
    var totalFeesInput = document.getElementById('totalFees');

    var selectedBuilding = buildingSelect.options[buildingSelect.selectedIndex];
    var baseFees = parseFloat(selectedBuilding.dataset.fees);

    var totalFees = messOption === 'yes' ? baseFees + 200 : baseFees;
    totalFeesInput.value = totalFees.toFixed(2); // Display fees with two decimal places
}
</script>

</html>
