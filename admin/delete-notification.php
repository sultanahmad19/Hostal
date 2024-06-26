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

    // Delete the notification from the database
    $deleteSql = "DELETE FROM notifications WHERE id = $notificationId";

    if ($conn->query($deleteSql) === TRUE) {
        // Redirect back to the manage-notifications.php page after deletion
        header("Location: manage-notifications.php");
        exit();
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }
} else {
    // Redirect to manage-notifications.php if notification ID is not provided
    header("Location: manage-notifications.php");
    exit();
}

// Close the database connection
$conn->close();
?>
