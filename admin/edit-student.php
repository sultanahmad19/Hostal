<!-- edit-student.php -->

<?php
// edit-student.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $studentID = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $buildingType = $_POST['building_type'];
    $mess = $_POST['mess'];
    $contactNumber = $_POST['contact_number'];
    $totalFees = $_POST['total_fees'];
    $roomNumber = $_POST['room_number'];

    // Update student details in the database
    $sql = "UPDATE user_registration SET 
            name='$name', 
            email='$email', 
            building_type='$buildingType', 
            mess='$mess', 
            contact_number='$contactNumber', 
            total_fees='$totalFees', 
            room_number='$roomNumber' 
            WHERE id=$studentID";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the view-student.php page after successful update
        header("Location: view-student.php?id=$studentID");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Check if the student ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "No student ID provided.";
    exit();
}

// Get student ID from the URL parameter
$studentID = $_GET['id'];

// Fetch student data for pre-filling the form
$sql = "SELECT * FROM user_registration WHERE id = $studentID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No student found with the provided ID.";
    exit();
}

// Fetch building types from the buildings table
$buildingOptions = array();
$resultBuilding = $conn->query("SELECT DISTINCT name FROM buildings");

if ($resultBuilding === false) {
    die("Error fetching building types: " . $conn->error);
}

if ($resultBuilding->num_rows > 0) {
    while ($rowBuilding = $resultBuilding->fetch_assoc()) {
        $buildingOptions[] = $rowBuilding["name"];
    }
} else {
    echo "No building types found in the buildings table.";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <!-- Add any additional styles as needed -->
    <style>
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
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="container mt-5">
    <h2>Edit Student Details</h2>
    <form action="edit-student.php?id=<?php echo $studentID; ?>" method="post">
        <!-- Include hidden input for student ID -->
        <input type="hidden" name="student_id" value="<?php echo $studentID; ?>">

        <!-- Add form fields for editing student details -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="building_type">Building Type:</label>
            <select class="form-control" id="building_type" name="building_type" required>
                <?php
                foreach ($buildingOptions as $option) {
                    echo '<option value="' . $option . '" ' . ($row['building_type'] == $option ? 'selected' : '') . '>' . $option . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mess">Mess:</label>
            <select class="form-control" id="mess" name="mess" required>
                <option value="yes" <?php echo ($row['mess'] == 'yes' ? 'selected' : ''); ?>>Yes</option>
                <option value="no" <?php echo ($row['mess'] == 'no' ? 'selected' : ''); ?>>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>
        </div>
        <div class="form-group">
            <label for="total_fees">Total Fees:</label>
            <input type="text" class="form-control" id="total_fees" name="total_fees" value="<?php echo $row['total_fees']; ?>" required>
        </div>
        <div class="form-group">
            <label for="room_number">Room Number:</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo $row['room_number']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="manage-students.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
            </main>
            </div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
