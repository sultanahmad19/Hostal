<?php
// view-building.php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$buildingId = isset($_GET['id']) ? $_GET['id'] : '';

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

// Fetch building details from the database
$sql = "SELECT * FROM buildings WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if prepare() was successful
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $buildingId);
$stmt->execute();
$result = $stmt->get_result();

// Check if building exists
if ($result->num_rows > 0) {
    $building = $result->fetch_assoc();
} else {
    // Redirect or handle error if building not found
    header("Location: error-page.php");
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Building</title>
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
    </style>
</head>
<body>
<div class="dashboard-container">
   <?php include('newpage.php')?>

        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <!-- Add your dashboard content here -->
            <div class="view-container">
                <h2>View Building</h2>
                <img src="<?php echo $building['image']; ?>" alt="Building Image" class="img-fluid" width="25%" height="25%">
                <p><strong>Name:</strong> <?php echo $building['name']; ?></p>
                <p><strong>Description:</strong> <?php echo $building['description']; ?></p>
                <p><strong>Location:</strong> <?php echo $building['location']; ?></p>
                <p><strong>Fees:</strong> <?php echo $building['fees']; ?></p>
                <p><strong>Available Rooms:</strong> <?php echo $building['available_rooms']; ?></p>

                <!-- Direct link to the edit page -->
                <a href="edit_building.php?id=<?php echo $buildingId; ?>" class="btn btn-primary">Edit Building</a>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
