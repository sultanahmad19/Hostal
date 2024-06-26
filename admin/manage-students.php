<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .student-card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .student-image {
            max-width: 100%;
            height: auto;
        }

        .student-details {
            padding: 20px;
        }

        .student-actions {
            padding: 10px;
            text-align: center;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>

<div class="dashboard-container">
    <?php include('newpage.php')?>
        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h2>Manage Students</h2>

            <!-- Add New Student Button -->
            <div class="text-right mb-3">
                <a href="add-new-student.php" class="btn btn-primary">Add New Student</a>
            </div>

            <!-- Display Student Cards from Database -->
            <div class="row">
                <?php
                // Establish database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "hostelpro";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the user_registration table
                $sql = "SELECT * FROM user_registration";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4">
                                <div class="student-card">
                                    <div class="student-details">
                                        <h5 class="card-title">' . $row['name'] . '</h5>
                                        <p class="card-text"><strong>Email:</strong> ' . $row['email'] . '</p>
                                        <p class="card-text"><strong>Reg. Number:</strong> ' . $row['registration_number'] . '</p>
                                        <p class="card-text"><strong>Room Number:</strong> ' . $row['room_number'] . '</p>
                                        <p class="card-text"><strong>Phone:</strong> ' . $row['contact_number'] . '</p>
                                    </div>
                                    <div class="student-actions">
                                    <a href="view-student.php?id=' . $row['id'] . '" class="btn btn-info">View</a>
                                    <a href="edit-student.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete(' . $row['id'] . ')">Delete</button>
                                        </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo "<p>No students found.</p>";
                }

                $conn->close();
                ?>
            </div>

        </main>
    </div>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
function confirmDelete(studentId) {
    var confirmation = confirm("Are you sure you want to delete this record?");
    
    if (confirmation) {
        // If the user confirms, redirect to a PHP file that handles deletion
        window.location.href = 'delete-student.php?id=' + studentId;
    }
}
</script>
</body>
</html>
