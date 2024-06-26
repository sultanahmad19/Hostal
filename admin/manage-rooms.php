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

// Fetch room details from the database
$sql = "SELECT * FROM buildings";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    $buildings = array();
    while ($row = $result->fetch_assoc()) {
        $buildings[] = array(
            'id' => $row['id'],
            'image' => $row['image'], // Ensure that the image path is correct
            'name' => $row['name'],
            'description' => $row['description'],
            'location' => $row['location'],
            'fees' => $row['fees']
        );
    }
} else {
    // No rows found
    $buildings = array();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Bootstrap JS scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Your custom CSS styles -->
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

        .Building-card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .Building-image {
            max-width: 100%;
            height: auto;
        }

        .Building-details {
            padding: 20px;
        }

        .Building-actions {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="dashboard-container">
<?php include('newpage.php')?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h2>Manage Buildings</h2>

            <!-- Add New Room Building -->
            <div class="text-right mb-3">
                <a href="add-new-room.php" class="btn btn-primary">Add New Building</a>
            </div>

            <!-- Display dynamic Building Cards based on database data -->
            <div class="row">
                <?php
                foreach ($buildings as $building) {
                    echo '<div class="col-md-4">
                <div class="Building-card">
                    <img src="' . $building['image'] . '" alt="' . $building['name'] . '" class="Building-image">
                    <div class="Building-details">
                        <h5 class="card-title">' . $building['name'] . '</h5>
                        <p class="card-text">' . $building['description'] . '</p>
                        <p class="card-text"><strong>Location:</strong> ' . $building['location'] . '</p>
                        <p class="card-text"><strong>Fees:</strong> ' . $building['fees'] . '</p>
                    </div>
                    <div class="Building-actions">
                        <a href="view-building.php?id=' . $building['id'] . '"><button class="btn btn-info">View</button></a>
                        <a href="edit_building.php?id=' . $building['id'] . '" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger" onclick="deleteBuilding(' . $building['id'] . ')">Delete</button>
                    </div>
                </div>
            </div>';
                }
                ?>
            </div>

        </main>

    </div>

    <!-- Bootstrap JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // AJAX function to delete the building
        function deleteBuilding(buildingId) {
            if (confirm("Are you sure you want to delete this building?")) {
                $.ajax({
                    type: 'POST',
                    url: 'delete-building.php',
                    data: { id: buildingId },
                    success: function (response) {
                        // Reload the page or update the UI as needed
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                        // Handle error
                    }
                });
            }
        }

        // AJAX function to load the edit page
        function editBuilding(buildingId) {
            $.ajax({
                type: 'GET',
                url: 'edit_building.php?id=' + buildingId, // Corrected URL
                success: function (response) {
                    // Load the edit page content into a modal or a separate div
                    $('#editModalBody').html(response);
                    $('#editModal').modal('show');
                },
                error: function (error) {
                    console.log(error);
                    // Handle error
                }
            });
        }
    </script>

</body>

</html>