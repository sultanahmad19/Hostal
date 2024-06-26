<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Details</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />
    <!-- Custom styles for the Home page -->
    <link rel="stylesheet" href="css/index.min.css" />
    <style>
        

        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: gray;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<?php include('header.php')?>
    <div class="container">
        <h2 class="text-center mb-4">Mess Details</h2>
        <?php
        // Fetch mess details from the database
        $sql = "SELECT * FROM mess";
        $result = $conn->query($sql);
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Display table headers
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
                        </tr>
                    </thead>
                    <tbody>';

            // Fetch data and populate the table rows
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['day'] . '</td>
                        <td>' . $row['breakfast'] . '</td>
                        <td>' . $row['lunch'] . '</td>
                        <td>' . $row['dinner'] . '</td>
                    </tr>';
            }

            // Close the table
            echo '</tbody></table>';
        } else {
            echo '<p>No mess details found.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
    <?php
    include 'footer.php';
    ?>
    <!-- Bootstrap JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Including common scripts -->
    <script src="js/common.min.js"></script>
</body>
</html>
