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

        <!-- <div class="dashboard-container"> -->
        <!-- Content area -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <!-- Add your dashboard content here -->
    <h2>Main Content Area</h2>

    <!-- Admin Profile Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <!-- Admin Profile Image (replace with actual image path) -->
            <img src="../admin/admin-icn.png" alt="Admin Profile" class="rounded-circle" width="150" height="150">
        </div>
        <div class="col-md-8">
            <!-- Admin Profile Information -->
            <h4>Welcome, User !</h4>
            <!-- You can display additional admin profile details here -->

            <div class="mt-3">
                
                <a href="../admin/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>


</main>

    </div>


<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
