<!-- delete-student.php -->

<?php
// delete-student.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
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

// Delete the student record
$sql = "DELETE FROM user_registration WHERE id = $studentID";
if ($conn->query($sql) === TRUE) {
    header("Location: manage-students.php");
    exit();

} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
