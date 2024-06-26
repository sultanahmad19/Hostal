<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Include your database connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications from the database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fetch the notifications into an array
$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Close the database connection
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
        .notification-card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .notification-details {
            padding: 20px;
        }

        .notification-actions {
            padding: 10px;
            text-align: center;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>

<div class="dashboard-container">
    <?php include('newpage.php')?>
        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h2>Manage Notifications</h2>

            <!-- Add New Notification Button -->
            <div class="text-right mb-3">
                <a href="add-notification.php" class="btn btn-primary">Add New Notification</a>
            </div>

            <!-- Sample Notification Cards -->
            <div class="row">
                <?php
                foreach ($notifications as $notification) {
                    echo '<div class="col-md-6">
                            <div class="notification-card">
                                <div class="notification-details">
                                    <h5 class="card-title">' . $notification['name'] . '</h5>
                                    <p class="card-text">' . $notification['details'] . '</p>
                                    <p class="card-text"><strong>Date:</strong> ' . $notification['date'] . '</p>
                                </div>
                                <div class="notification-actions">
                                    <a href="view-notification.php?id=' . $notification['id'] . '" class="btn btn-info">View</a>
                                    <a href="edit-notification.php?id=' . $notification['id'] . '" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete(' . $notification['id'] . ')">Delete</button>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>

        </main>
    </div>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    function confirmDelete(notificationId) {
        if (confirm("Are you sure you want to delete this notification?")) {
            window.location.href = 'delete-notification.php?id=' + notificationId;
        }
    }
</script>

</body>
</html>
