<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostelpro"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO studentregistration (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        // Data inserted successfully, redirect to login page or perform any other action
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred while inserting data, display error message
        $error_message = "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
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
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" class="form-control" required><br>

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

<!-- <script>
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
</script> -->

</html>
