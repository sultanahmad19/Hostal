<?php
// update-building.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
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

// Update building details
$buildingId = $_POST['building_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$location = $_POST['location'];
$fees = $_POST['fees'];
$availableRooms = $_POST['available_rooms'];

$sqlUpdateBuilding = "UPDATE buildings
                     SET name = ?, description = ?, location = ?, fees = ?, available_rooms = ?
                     WHERE id = ?";
$stmtUpdateBuilding = $conn->prepare($sqlUpdateBuilding);

if (!$stmtUpdateBuilding) {
    die("Prepare failed: " . $conn->error);
}

$stmtUpdateBuilding->bind_param("sssidi", $name, $description, $location, $fees, $availableRooms, $buildingId);
$stmtUpdateBuilding->execute();

// Check if the update was successful before redirecting
if ($stmtUpdateBuilding) {
    // Redirect to the view-building.php page
    header("Location: view-building.php?id=$buildingId");
    exit();
} else {
    // Handle the case where the update failed
    echo "Error updating building details.";
}

// Close the statement
$stmtUpdateBuilding->close();
$conn->close();
?>
