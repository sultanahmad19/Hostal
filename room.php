

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, compatibility, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Rooms | HostelPro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Preload and minified stylesheets -->
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />
    <link rel="stylesheet" href="css/index.min1.css" />
   
    <!-- Custom styles for the Home page -->
    <link rel="stylesheet" href="css/index.min.css" />
    <link rel="stylesheet" href="css/rooms.min.css" />
    <link rel="stylesheet" href="css/contacts.min.css" />
    
    <style>
        main .container {
            margin-bottom: 20px;
        }

        .theme-element--accent {
            background: #dc3545 !important;
        }

        .buttons {
            margin: 0px 0px 0px 13px;
        }

        .buttons button {
            margin: 5px;
        }
        .nav-item:hover{
        transition: black .3s ease-in-out;
    }
    </style>
</head>

<body>
    <!-- Including header with an active page indicator -->
    <?php include 'header.php';  ?>
    <!-- Rooms page content start -->
    <!-- Main content section for displaying room details -->
    <main class="rooms section">
        <!-- Ascending and Descending buttons -->
        <div class="buttons px-5 mb-3">
            <!-- Button for Ascending order of building fees -->
            <button class="theme-element theme-element--accent btn mr-3" onclick="sortBuildings('ascending')">Ascending</button>
            <!-- Button for Descending order of building fees -->
            <button class="theme-element theme-element--accent btn mr-3" onclick="sortBuildings('descending')">Descending</button>
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
                echo '<i class="icon-location icon"></i>';
                echo $row['location'];
                echo '</span>';
                // Add the mess icon and "View Mess" button
                echo '<span class="main_amenities-item d-inline-flex align-items-center">';
                echo '<i class="fas fa-utensils"></i>';
                echo '<a class="btn btn-primary" href="mess-details.php">&nbsp;View Mess</a>';
                echo '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">';
                echo '<div class="wrapper d-flex flex-column">';
                echo '<span class="main_pricing-item">';
                echo '<span class="h2">' . $row['fees'] . '£</span>/1 month';
                echo '</span>';
                echo '</div>';
                echo '<a class="theme-element theme-element--accent btn" href="registerroom.php">Book now</a>';
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

    <!-- Including footer and scripts -->
    <?php include 'footer.php'; ?>
    <script src="js/common.min.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
