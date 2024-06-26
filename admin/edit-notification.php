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

// Check if the notification ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $notificationId = $_GET['id'];

    // Fetch the notification details from the database
    $sql = "SELECT * FROM notifications WHERE id = $notificationId";
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Fetch the notification details
    $notificationDetails = $result->fetch_assoc();
} else {
    // Redirect to manage-notifications.php if notification ID is not provided
    header("Location: manage-notifications.php");
    exit();
}

// Handling form submission for editing notification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["notificationName"];
    $details = $_POST["notificationDetails"];
    $date = $_POST["notificationDate"];

    // Update data in the database
    $updateSql = "UPDATE notifications SET name='$name', details='$details', date='$date' WHERE id=$notificationId";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to the manage-notifications.php page
        header("Location: manage-notifications.php");
        exit();
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notification</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .notification-details-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .notification-details-card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        .notification-details {
            padding: 20px;
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
<div class="notification-details-container">
    <h2>Edit Notification</h2>

    <!-- Edit Notification Form -->
    <form id="editNotificationForm" action="" method="post">
        <div class="form-group">
            <label for="notificationName">Notification Name:</label>
            <input type="text" class="form-control" id="notificationName" name="notificationName" value="<?php echo $notificationDetails['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="notificationDetails">Notification Details:</label>
            <textarea class="form-control" id="notificationDetails" name="notificationDetails" rows="4" required><?php echo $notificationDetails['details']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="notificationDate">Notification Date:</label>
            <input type="date" class="form-control" id="notificationDate" name="notificationDate" value="<?php echo $notificationDetails['date']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Notification</button>
    </form>

    <!-- Back to Manage Notifications button -->
    <a href="manage-notifications.php" class="btn btn-secondary back-button">Back to Manage Notifications</a>
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
