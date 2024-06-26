<?php
session_start();
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

// Function to validate admin login
function validateAdminLogin($username, $password, $conn) {
    // SQL query to check admin credentials using prepared statement
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    
    $stmt = $conn->prepare($sql);

    // Check if the prepared statement is successful
    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set username in session after successful login
        $_SESSION['username'] = $username;
        return true; // Valid admin credentials
    } else {
        return false; // Invalid admin credentials
    }
}

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate admin login
    if (validateAdminLogin($username, $password, $conn)) {
        // Redirect to dashboard.php on successful login
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials";
    }
}

// Close the database connection
$conn->close();
?>





<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">

        <!-- Loader for this page -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <!-- Login form Main Section -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box row">
                <!-- Side image of the login page -->
                <div class="col-lg-6 col-md-5 modal-bg-img" style="background-image: url(../assets/images/adimg.jpg);">
                </div>
                <div class="col-lg-6 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <!-- icon on the login form -->
                            <img src="../assets/images/big/icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Admin Login</h2>

                        <form class="mt-4" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <!-- Email label -->
                                        <label class="text-dark" for="uname">Email or Username</label>
                                        <!-- Input field for email or username -->
                                        <input class="form-control" name="username" id="uname" type="text" placeholder="Email or Username" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <!-- Password label -->
                                        <label class="text-dark" for="pwd">Password</label>
                                        <!-- Input field for Password -->

                                        <input class="form-control" name="password" id="pwd" type="password" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <!-- Submit button for login form -->
                                    <button type="submit" name="login" class="btn btn-block btn-danger">LOGIN</button>
                                </div>
                                
                                <div class="col-lg-12 text-center mt-5">
                                   <a href="../student/index.php" class="text-danger">Go to Student Panel</a> |
                                   <a href="../index.php" class="text-Success">Go to Home </a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>

    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>