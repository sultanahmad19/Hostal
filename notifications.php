<?php
$activePage = 'notification';
?>

<?php
// Include your database connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications from the database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fetch the notifications into an array
$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Close the database connection
$conn->close();

// Separate notifications based on date
$currentWeek = [];
$olderThanWeek = [];
$otherNotifications = [];

$currentDate = strtotime(date('Y-m-d'));

foreach ($notifications as $notification) {
    $notificationDate = strtotime($notification['date']);
    $timeDifference = $currentDate - $notificationDate;

    if ($timeDifference < 7 * 24 * 60 * 60) {
        // Notification added in the current week
        $currentWeek[] = $notification;
    } elseif ($timeDifference >= 7 * 24 * 60 * 60 && $timeDifference < 14 * 24 * 60 * 60) {
        // Notifications older than a week but less than two weeks
        $olderThanWeek[] = $notification;
    } else {
        // All other notifications
        $otherNotifications[] = $notification;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Notifications</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />
    <!-- Custom styles for the Home page -->
    <link rel="stylesheet" href="css/index.min.css" />
    <!-- Add your custom CSS styles here -->
    <style>
        
        
        .notification-section {
            margin-bottom: 30px;
        }
        .notification-header {
            font-size: 24px;
            font-weight: bold;
            color: #040b11;
        }
        .notification-card {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .notification-card:hover {
            transform: scale(1.02);
        }
        .notification-details {
            padding: 20px;
        }
        .notification-actions {
            text-align: right;
        }
        .btn-view, .btn-edit, .btn-delete {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include('header.php')?>
<div class="container">
    <h2 class="mb-4" style="text-align:center;">User Notifications</h2>

    <!-- Display notifications added in the current week -->
    <div class="notification-section">
        <h4 class="notification-header">Notifications Added in Current Week</h4>
        <div class="row">
            <?php
            foreach ($currentWeek as $notification) {
                echo '<div class="col-md-4">
                        <div class="notification-card">
                            <div class="notification-details">
                                <h5 class="card-title">' . $notification['name'] . '</h5>
                                <p class="card-text">' . $notification['details'] . '</p>
                                <p class="card-text"><strong>Date:</strong> ' . $notification['date'] . '</p>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

    <!-- Display notifications older than a week but less than two weeks -->
    <div class="notification-section">
        <h4 class="notification-header">Notifications Older Than a Week</h4>
        <div class="row">
            <?php
            foreach ($olderThanWeek as $notification) {
                echo '<div class="col-md-4">
                        <div class="notification-card">
                            <div class="notification-details">
                                <h5 class="card-title">' . $notification['name'] . '</h5>
                                <p class="card-text">' . $notification['details'] . '</p>
                                <p class="card-text"><strong>Date:</strong> ' . $notification['date'] . '</p>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

    <!-- Display all other notifications -->
    <div class="notification-section">
        <h4 class="notification-header">All Other Notifications</h4>
        <div class="row">
            <?php
            foreach ($otherNotifications as $notification) {
                echo '<div class="col-md-4">
                        <div class="notification-card">
                            <div class="notification-details">
                                <h5 class="card-title">' . $notification['name'] . '</h5>
                                <p class="card-text">' . $notification['details'] . '</p>
                                <p class="card-text"><strong>Date:</strong> ' . $notification['date'] . '</p>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <!-- Including footer -->
 <?php
    include 'footer.php';
    ?>

    <!-- Including common scripts -->
    <script src="js/common.min.js"></script>
    
   
</body>
</html>

