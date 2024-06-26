<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buildingId = isset($_POST['id']) ? $_POST['id'] : '';

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostelpro";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform building deletion
    $deleteBuildingQuery = "DELETE FROM buildings WHERE id = ?";
    $stmt = $conn->prepare($deleteBuildingQuery);
    $stmt->bind_param("i", $buildingId);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}
?>
