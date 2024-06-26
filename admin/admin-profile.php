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
        /* Add more styles as needed */
    </style>
</head>
<body>

<div class="dashboard-container">
  <?php include('newpage.php')?>
        <!-- Content area -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <!-- Add your dashboard content here -->
    <h2>Main Content Area</h2>

    <!-- Admin Profile Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <!-- Admin Profile Image (replace with actual image path) -->
            <img src="admin-icn.png" alt="Admin Profile" class="rounded-circle" width="150" height="150">
        </div>
        <div class="col-md-8">
            <!-- Admin Profile Information -->
            <h4>Welcome, Admin !</h4>
            <!-- You can display additional admin profile details here -->

            <div class="mt-3">
                
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
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
