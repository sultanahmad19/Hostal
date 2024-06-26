<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
$message = ""; // Variable to store the success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["notificationName"];
    $details = $_POST["notificationDetails"];
    $date = $_POST["notificationDate"];

    // Insert data into the database
    $sql = "INSERT INTO notifications (name, details, date) VALUES ('$name', '$details', '$date')";

    if ($conn->query($sql) === TRUE) {
        $message = "Notification added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notification</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
    <div class="container mt-5">
        <h2 class="mb-4">Add Notification</h2>
        <!-- Display alert if message is not empty -->
        <?php if ($message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form id="notificationForm" action="" method="post">
            <div class="form-group">
                <label for="notificationName">Notification Name:</label>
                <input type="text" class="form-control" id="notificationName" name="notificationName" required>
            </div>

            <div class="form-group">
                <label for="notificationDetails">Notification Details:</label>
                <textarea class="form-control" id="notificationDetails" name="notificationDetails" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="notificationDate">Notification Date:</label>
                <input type="date" class="form-control" id="notificationDate" name="notificationDate" required>
            </div>

            <button type="submit" class="btn btn-success">Add Notification</button>
        </form>
    </div>
    </main>
    </div>

</div>
    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
