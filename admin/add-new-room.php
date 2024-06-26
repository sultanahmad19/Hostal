<?php
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

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $buildingImage = $_FILES['buildingImage']['name'];
    // Handle image upload
    if (isset($_FILES['buildingImage'])) {
        // Move uploaded file to a specific location
        $file_name = $_FILES['buildingImage']['name'];
        $file_tmp = $_FILES['buildingImage']['tmp_name'];
        move_uploaded_file($file_tmp, 'Images/' . $file_name);
        $buildingImage = 'Images/'. $file_name;
    }

    $buildingName = $_POST['buildingName'];
    $buildingDescription = $_POST['buildingDescription'];
    $buildingLocation = $_POST['buildingLocation'];
    $buildingFees = $_POST['buildingFees'];
    $availableRooms = $_POST['availableRooms'];

    // Insert building details into the buildings table
    $insertBuildingQuery = "INSERT INTO buildings (image, name, description, location, fees, available_rooms) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertBuildingQuery);
    $stmt->bind_param("sssssi", $buildingImage, $buildingName, $buildingDescription, $buildingLocation, $buildingFees, $availableRooms);
    $stmt->execute();

    // Redirect to the dashboard or perform any other action after saving data
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Building</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
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
            <div class="form-container">
    <h2>Add New Building</h2>
    <form method="POST" action="#" enctype="multipart/form-data">
        <div class="form-group">
            <label for="buildingImage">Building Image</label>
            <input type="file" class="form-control" id="buildingImage" name="buildingImage" accept=".jpg" required>
        </div>
        <div class="form-group">
            <label for="buildingName">Building Name</label>
            <input type="text" class="form-control" id="buildingName" name="buildingName" required>
        </div>
        <div class="form-group">
            <label for="buildingDescription">Building Description</label>
            <textarea class="form-control" id="buildingDescription" name="buildingDescription" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="buildingLocation">Building Location</label>
            <input type="text" class="form-control" id="buildingLocation" name="buildingLocation" required>
        </div>
        <div class="form-group">
            <label for="buildingFees">Building Fees (Per Month)</label>
            <input type="number" class="form-control" id="buildingFees" name="buildingFees" required>
        </div>
        <div class="form-group">
            <label for="availableRooms">Available Rooms</label>
            <input type="number" class="form-control" id="availableRooms" name="availableRooms" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Building</button>
    </form>
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
