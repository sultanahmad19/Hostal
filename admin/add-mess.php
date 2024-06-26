<?php
session_start();

// Check if the user is not logged in, redirect to the login page
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

// Initialize variables to store form data
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each day and collect form data
    foreach ($days as $day) {
        $breakfast = $_POST["breakfast_$day"];
        $lunch = $_POST["lunch_$day"];
        $dinner = $_POST["dinner_$day"];

        // Validate and insert data into the database
        $sql = "INSERT INTO mess (day, breakfast, lunch, dinner) VALUES ('$day', '$breakfast', '$lunch', '$dinner')";

        if (!$conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Redirect to manage-mess page after record submission
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
    <title>Add New Mess</title>
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
        <h2>Add New Mess</h2>

        <!-- Add New Mess Form -->
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return showPopup()">
                <?php foreach ($days as $day) { ?>
                    <div class="form-group">
                        <label for="breakfast_<?php echo $day; ?>"><?php echo $day; ?> - Breakfast:</label>
                        <input type="text" class="form-control" id="breakfast_<?php echo $day; ?>" name="breakfast_<?php echo $day; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lunch_<?php echo $day; ?>"><?php echo $day; ?> - Lunch:</label>
                        <input type="text" class="form-control" id="lunch_<?php echo $day; ?>" name="lunch_<?php echo $day; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dinner_<?php echo $day; ?>"><?php echo $day; ?> - Dinner:</label>
                        <input type="text" class="form-control" id="dinner_<?php echo $day; ?>" name="dinner_<?php echo $day; ?>" required>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary">Add Mess</button>
            </form>
        </div>
    </main>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
   
</script>

</body>
</html>
