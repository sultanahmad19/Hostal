<?php
// edit-building.php

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
    <title>Edit Building</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap JS scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .edit-container {
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
            <div class="edit-container">
                <h2>Edit Building</h2>
                <!-- Building Form -->
                <form action="update_building.php" method="post">
                    <input type="hidden" name="building_id" value="<?php echo $building['id']; ?>">

                    <!-- Building Details -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $building['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $building['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $building['location']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="fees">Fees:</label>
                        <input type="number" class="form-control" id="fees" name="fees" value="<?php echo $building['fees']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="available_rooms">Available Rooms:</label>
                        <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="<?php echo $building['available_rooms']; ?>" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </main>
    </div>
</div>
</body>
</html>
