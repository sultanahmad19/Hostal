<!-- view-student.php -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Details</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
       
        .student-details-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .back-button {
            margin-top: 20px;
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
<div class="student-details-container">
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostelpro";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get student ID from the URL parameter
    $studentID = $_GET['id'];

    // Fetch data for the selected student
    $sql = "SELECT * FROM user_registration WHERE id = $studentID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the complete record
        echo "<h2>Student Details</h2>";
        echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        echo "<p><strong>Registration Number:</strong> " . $row['registration_number'] . "</p>";
        echo "<p><strong>Building Type:</strong> " . $row['building_type'] . "</p>";
        echo "<p><strong>Mess:</strong> " . $row['mess'] . "</p>";
        echo "<p><strong>Contact Number:</strong> " . $row['contact_number'] . "</p>";
        echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
        echo "<p><strong>Total Fees:</strong> " . $row['total_fees'] . "</p>";
        echo "<p><strong>Room Number:</strong> " . $row['room_number'] . "</p>";
    } else {
        echo "<p>No student found with the provided ID.</p>";
    }

    $conn->close();
    ?>
    
    <!-- Back button to return to the main student management page -->
    <a href="manage-students.php" class="btn btn-secondary back-button">Back to Student Management</a>
</div>
</main>
    </div>

</div>
<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
