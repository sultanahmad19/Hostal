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

// Fetch mess details from the database for displaying in the form
$sql = "SELECT * FROM mess";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $messDetails[] = array(
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each day and update data in the database
    foreach ($messDetails as $mess) {
        $day = $mess['day'];
        $breakfast = $_POST["breakfast_$day"];
        $lunch = $_POST["lunch_$day"];
        $dinner = $_POST["dinner_$day"];

        // Validate and update data in the database
        $sql = "UPDATE mess SET breakfast=?, lunch=?, dinner=? WHERE day=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $breakfast, $lunch, $dinner, $day);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }

    // Redirect to manage-mess page after updating records
    header("Location: manage-mess.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mess</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Your custom CSS styles -->
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
        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <?php include('newpage.php') ?>

    <!-- Content area -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Edit Mess</h2>

        <!-- Edit Mess Form -->
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php foreach ($messDetails as $mess) { ?>
                    <div class="form-group">
                        <label for="breakfast_<?php echo $mess['day']; ?>"><?php echo $mess['day']; ?> - Breakfast:</label>
                        <input type="text" class="form-control" id="breakfast_<?php echo $mess['day']; ?>" name="breakfast_<?php echo $mess['day']; ?>" value="<?php echo $mess['breakfast']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lunch_<?php echo $mess['day']; ?>"><?php echo $mess['day']; ?> - Lunch:</label>
                        <input type="text" class="form-control" id="lunch_<?php echo $mess['day']; ?>" name="lunch_<?php echo $mess['day']; ?>" value="<?php echo $mess['lunch']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dinner_<?php echo $mess['day']; ?>"><?php echo $mess['day']; ?> - Dinner:</label>
                        <input type="text" class="form-control" id="dinner_<?php echo $mess['day']; ?>" name="dinner_<?php echo $mess['day']; ?>" value="<?php echo $mess['dinner']; ?>" required>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </main>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
