<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostelpro";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the deletion of the entire table
    $deleteTableSql = "DELETE FROM mess";
    if ($conn->query($deleteTableSql) === TRUE) {
        // Redirect to manage-mess page
        header("Location: manage-mess.php");
        exit();
    } else {
        echo "Error deleting mess: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, redirect to the manage-mess page
    header("Location: manage-mess.php");
    exit();
}
?>
