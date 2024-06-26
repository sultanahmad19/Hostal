<?php
session_start();

// Check if the user is not logged in, redirect to the login page
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
        Welcome, Admin !
    </div>

    <!-- User dropdown with logout -->
    <div class="user-dropdown">
        <img src="admin-icn.png" alt="Profile Picture" width="40" height="40" class="rounded-circle">
        <div class="dropdown">
            <button  class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User Menu
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin-profile.php">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Sidebar with Bootstrap classes for responsiveness -->
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="logo-icon-nav.png" alt="Logo" width="30" height="30">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-rooms.php">
                            Manage  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Buildings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-students.php">
                            Manage &nbsp; &nbsp;Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-notifications.php">
                            Manage Mess
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-notifications.php">
                            Manage Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addstudent.php">
                            Add Student
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
                <div class="buttons px-5 mb-3">
                    <!-- Button for Ascending order of building fees -->
                    <button class="theme-element theme-element--accent btn mr-3 text-white" onclick="sortBuildings('ascending')">Ascending</button>
                    <!-- Button for Descending order of building fees -->
                    <button class="theme-element theme-element--accent btn mr-3 text-white" onclick="sortBuildings('descending')">Descending</button>
                </div>
                <!-- Container for the room list -->
                <div class="container">
                    <!-- Fetch data from the 'buildings' table and display dynamically -->
                    <?php
                    // Assuming you have a database connection established
                    $dbHost = 'localhost';
                    $dbUser = 'root';
                    $dbPassword = '';
                    $dbName = 'hostelpro';

                    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT * FROM buildings";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<ul class="rooms_list" id="rooms_list">';
                        echo '<li class="rooms_list-item" data-order="' . $row['id'] . '" data-aos="fade-up">';
                        echo '<div class="item-wrapper d-md-flex">';
                        echo '<div class="media">';
                        echo '<picture>';
                        echo '<img class="lazy" src="' . $row['image'] . '" alt="IMAGE IS LOADING ..." />';
                        echo '</picture>';
                        echo '</div>';
                        echo '<div class="main d-md-flex justify-content-between">';
                        echo '<div class="main_info d-md-flex flex-column justify-content-between">';
                        echo '<p class="main_title h4" >' . $row['name'] . '</p>';
                        echo '<p class="main_description">' . $row['description'] . '</p>';
                        echo '<div class="main_amenities">';
                        echo '<span class="main_amenities-item d-inline-flex align-items-center">';
                        echo '<i class="fa fa-map-marker-alt"></i>';
                        echo $row['location'];
                        echo'&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo '</span>';
                        // Add the mess icon and "View Mess" link
                        echo '<span class="main_amenities-item d-inline-flex align-items-center">';
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">';
                        echo '<div class="wrapper d-flex flex-column">';
                        echo '<span class="main_pricing-item">';
                        echo '&nbsp;&nbsp;<span class="h2" style="margin-top:-20px !important;">' . $row['fees'] . '£</span>/1 month';
                        echo '</span>';
                        echo '</div>';
                        echo '<a class="theme-element theme-element--accent btn text-white" href="../registerroom.php">Book now</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ul>';
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
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
