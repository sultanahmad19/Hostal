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

// Fetch mess details from the database
$sql = "SELECT * FROM mess";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    $messDetails = array();
    while ($row = $result->fetch_assoc()) {
        $messDetails[] = array(
            'id' => $row['id'],
            'day' => $row['day'],
            'breakfast' => $row['breakfast'],
            'lunch' => $row['lunch'],
            'dinner' => $row['dinner']
        );
    }
} else {
    // No rows found
    $messDetails = array();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mess</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
        .mess-table-container {
            margin-top: 20px;
        }

        .mess-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .mess-table th,
        .mess-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
 <?php include('newpage.php')?>

        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      
     
            <h2>Manage Mess</h2>

            <!-- Add New Mess Button -->
            <div class="text-right mb-3">
                <a href="add-mess.php" class="btn btn-primary">Add New Mess</a>
            </div>

            <!-- Display dynamic Mess Table based on database data -->
            <div class="mess-table-container">
                <table class="mess-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($messDetails as $mess) {
                            echo '<tr>
                                    <td>' . $mess['day'] . '</td>
                                    <td>' . $mess['breakfast'] . '</td>
                                    <td>' . $mess['lunch'] . '</td>
                                    <td>' . $mess['dinner'] . '</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Edit and Delete buttons -->
            <div class="action-buttons">
    <a href="edit-mess.php" class="btn btn-warning">Edit</a>
    <a href="#" class="btn btn-danger" onclick="confirmDeleteTable()">Delete</a>
</div>
</main>

</div>

</div>   

    <!-- Bootstrap JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
<script>
    function confirmDeleteTable() {
        // Prompt the user for confirmation
        var confirmDelete = confirm("Are you sure you want to delete the mess?");

        if (confirmDelete) {
            // Make an AJAX request to the server to delete the entire table
            $.ajax({
                type: "POST",
                url: "delete-mess.php", // Reference to the new delete-mess.php file
                success: function (response) {
                    // Handle the server response
                    console.log(response);
                    // Optionally, you can reload the page or handle the UI accordingly
                    location.reload();
                },
                error: function (error) {
                    console.error("Error deleting mess", error);
                    alert("Error deleting mess. Please try again.");
                }
            });
        }
    }
</script>


</html>
