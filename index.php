
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, compatibility, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home</title>
    <!-- Preload and minified stylesheets -->
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />

    <!-- Custom styles for the Home page -->
    <link rel="stylesheet" href="css/index.min.css" />
    <link rel="stylesheet" href="css/rooms.min.css" />
    <link rel="stylesheet" href="css/contacts.min2.css" />
    
    <style>
        /* Additional styles for the hero section */
        .hero {
            background: gray;
        }

        /* Additional styles for text elements */
        .text {
            font-weight: bold;
            text-align: left;
        }

        /* Additional styles for button background color */
        .theme-element--accent {
            background: #dc3545 !important;
        }

        #viewbutton {
            background: #dc3545 !important;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Including header with an active page indicator -->
    <?php
    include 'header.php';
    
    ?>

    <!-- Main content section -->
    <main>
        <!-- Hero section start -->
        <section class="hero section">
            <div class="container container--hero d-lg-flex align-items-center justify-content-between bg-white">
                <div class="hero_main">
                    <!-- Main title for the hero section -->
                    <h1 class="hero_main-title" data-aos="fade-up">HostelPro — amazing hostel for the free-spirited traveler</h1>

                    <!-- Row for buttons and additional text -->
                    <div class="row d-lg-flex align-items-center justify-content-between">
                        <div class="col-md-6">
                            <!-- Booking buttons for registering hostel and booking a room -->
                            
                            <button class="booking_btn btn theme-element theme-element--accent" onclick="window.location.href='room.php'">Book Hostel</button>
                        </div>
                        <div class="col-md-6 mb-3 mt-4">
                            <!-- Additional text in the hero section -->
                            <!-- Data-aos class is for the animation  and the delay of 100 milisecond -->
                            <p class="text" data-aos="fade-up" data-aos-delay="100">
                                A university hostel provides convenient and secure accommodation for students, fostering a community atmosphere.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero section end -->

        <!-- Rooms section start -->

        <section class="rooms section--blockbg section--nopb">
            <div class="block"></div>
            <div class="container">
                <div class="rooms_header d-sm-flex justify-content-between align-items-center">
                    <!-- Header for the Hostel Information section -->
                    <h2 class="rooms_header-title" data-aos="fade-right">Hostel Information</h2>
                    <!-- Button to view all hostels -->
                    <div class="wrapper" data-aos="fade-left">
                        <a class="btn theme-element theme-element--light" href="room.php" id="viewbutton">View all Hostels</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Rooms section end -->

        <!-- Latest section with room details -->
        <?php
// Assuming you have a database connection established already
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelpro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch room information from the 'buildings' table
$sql = "SELECT name, image FROM buildings LIMIT 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo '<section class="latest section section--blockbg mt-0 pt-0">
            <div class="container mt-0">
                <ul class="latest_list d-md-flex flex-wrap pt-0">';

    while ($row = $result->fetch_assoc()) {
        echo '<li class="latest_list-item col-md-6 col-xl-4" data-order="2" data-aos="fade-up" data-aos-delay="50">
                <div class="item-wrapper d-md-flex flex-column">
                    <div class="media">
                        <img class="lazy" src="' . $row['image'] . '" alt="media" />
                    </div>
                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                        <a class="main_title h4" href="mess-details.php" data-shave="true">' . $row['name'] . '</a>
                        <div class="main_metadata">
                            <button class="booking_btn btn theme-element theme-element--accent" onclick="window.location.href=\'registerroom.php\'">Book Room</button>
                        </div>
                    </div>
                </div>
            </li>';
    }

    echo '</ul>
        </div>
    </section>';
} else {
    echo "0 results";
}

$conn->close();
?>

    </main>

    <!-- Including footer -->
    <?php
    include 'footer.php';
    ?>

    <!-- Including common scripts -->
    <script src="js/common.min.js"></script>
    <!-- Additional script for the Home page -->
    <script src="js/index.min.js"></script>
    <!-- Gallery script (assuming it's used on the page) -->
    <script src="js/gallery.min.js"></script>
</body>

</html>