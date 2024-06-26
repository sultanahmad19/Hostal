<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}



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
    <title>Student Dashboard</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
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
       
        /* Styles from Rooms page for room display */

        .rooms_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .rooms_list-item {
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .item-wrapper {
            width: 100%;
        }

        .media img {
            width: 100%;
            height: 200px;
            border-radius: 8px 0 0 8px;
        }

        .main {
            padding: 20px;
        }

        .main_title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .main_description {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .main_amenities {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .main_amenities-item {
            font-size: 0.9rem;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .main_amenities-item i {
            margin-right: 5px;
            color: black;
        }

        .main_pricing {
            text-align: right;
        }

        .main_pricing-item .h2 {
            color: #28a745;
        }

        .theme-element--accent {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="welcome-message">
        Welcome, user !
    </div>

    <!-- User dropdown with logout -->
    <div class="user-dropdown">
        <img src="../admin/admin-icn.png" alt="Profile Picture" width="40" height="40" class="rounded-circle">
        <div class="dropdown">
            <button  class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User Menu
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../admin/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Sidebar with Bootstrap classes for responsiveness -->
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <img src="../admin/logo-icon-nav.png" alt="Logo" width="30" height="30">
                            Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="student-details.php">
                            Students Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mess.php">
                            Mess Details
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <!-- Main content section for displaying room details -->
            <main class="rooms section">
                <!-- Ascending and Descending buttons -->
               
                <!-- Container for the room list -->
                <div class="container">
                    <h2 class="mb-4" style="text-align:center;">Notifications For User</h2>
                    <div class="row ">

                    <!-- Display notifications added in the current week -->
                    <div class="notification-section">
                        <h3 class="notification-header">Notifications Added in Current Week</h3>
                        <div class="row">
                            <?php
                            foreach ($currentWeek as $notification) {
                                echo '<div class="col-md-4" style ="width:50rem">
                                        <div class="notification-card">
                                            <div class="notification-details">
                                                <h5 class="card-title">' . $notification['name'] . '</h5>
                                                <p class="card-text">' . $notification['details'] . '</p>
                                                <p class="card-text"><strong>Date:</strong> ' . $notification['date'] . '</p>
                                            </div>
                                        </div>
                                        <br>
                                    </div>';
                            }
                            ?>
                        </div>
                    <br>

                    </div>
                    </div>
                    <br>

                    <!-- Display notifications older than a week but less than two weeks -->
                    <div class="row">

                    <div class="notification-section">
                        <h3 class="notification-header">Notifications Older Than a Week</h3>
                        <div class="row">
                            <?php
                            foreach ($olderThanWeek as $notification) {
                                echo '<div class="col-md-4" style ="width:50rem">
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
                    <br>

                    </div>
                    </div>
                    <br>


                    <!-- Display all other notifications -->
                    <div class="row">

                    <div class="notification-section">
                        <h3 class="notification-header">All Other Notifications</h3>
                        <div class="row">
                            <?php
                            foreach ($otherNotifications as $notification) {
                                echo '<div class="col-md-4" style ="width:50rem">
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
                    <br>

                    </div>
                    </div>
                    <br>


                </div>
            </main>
        </main>
    </div>
</div>

<!-- Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    function sortBuildings(order) {
        const buildingsList = document.querySelectorAll('.rooms_list-item');

        const sortedBuildings = Array.from(buildingsList).sort((a, b) => {
            const feesA = parseInt(a.querySelector('.main_pricing-item .h2').innerText);
            const feesB = parseInt(b.querySelector('.main_pricing-item .h2').innerText);

            if (order === 'ascending') {
                return feesA - feesB;
            } else {
                return feesB - feesA;
            }
        });

        const container = document.getElementById('rooms_list');
        container.innerHTML = '';

        sortedBuildings.forEach(building => {
            container.appendChild(building);
        });
    }
</script>

</body>
</html>
