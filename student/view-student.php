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
            width: 80%;
            max-width: 1200px;
            /* margin: auto; */
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
    <div class="welcome-message">
        Welcome, user !
    </div>

    <!-- User dropdown with logout -->
    <div class="user-dropdown">
        <img src="../admin/admin-icn.png" alt="Profile Picture" width="40" height="40" class="rounded-circle">
        <div class="dropdown">
            <button  class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User Menu
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../admin/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Sidebar with Bootstrap classes for responsiveness -->
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <img src="../admin/logo-icon-nav.png" alt="Logo" width="30" height="30">
                            Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="student-details.php">
                            Students Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mess.php">
                            Mess Details
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
<div class="dashboard-container">
        <!-- Content area -->
        <main role="main" class="col-md-12 ml-sm-auto col-lg-10 px-4">
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
    <a href="student-details.php" class="btn btn-secondary back-button">Back to Student Details</a>
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
