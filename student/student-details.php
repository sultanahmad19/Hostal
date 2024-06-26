<?php 
session_start();
// $email = "user1@gmail.com";

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$_SESSION['logged_in_user_email'] = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
            width: 80%;
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
        .student-card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .student-image {
            max-width: 100%;
            height: auto;
        }

        .student-details {
            padding: 20px;
        }

        .student-actions {
            padding: 10px;
            text-align: center;
        }
        /* Add more styles as needed */
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
        <h2>Students Details</h2>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            

            <!-- Display Student Cards from Database -->
            <div class="row">
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

                
                $logged_in_user_email = $_SESSION['logged_in_user_email'];

                $sql = "SELECT * FROM user_registration WHERE email = '$logged_in_user_email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-12">
                                <div class="student-card">
                                    <div class="student-details">
                                        <h5 class="card-title">' . $row['name'] . '</h5>
                                        <p class="card-text"><strong>Email:</strong> ' . $row['email'] . '</p>
                                        <p class="card-text"><strong>Reg. Number:</strong> ' . $row['registration_number'] . '</p>
                                        <p class="card-text"><strong>Room Number:</strong> ' . $row['room_number'] . '</p>
                                        <p class="card-text"><strong>Phone:</strong> ' . $row['contact_number'] . '</p>
                                    </div>
                                    <div class="student-actions">
                                        <a href="view-student.php?id=' . $row['id'] . '" class="btn btn-info">View</a>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo "<p>No student found with the logged-in user's email.</p>";
                }

                $conn->close();
            ?>

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
