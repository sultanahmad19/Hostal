

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, compatibility, and title -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Contacts</title>

    <!-- Font Awesome CSS CDN -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-x6d54VW8QDHiXD9FrlQc6d9dXvz5wvi7f4LQrNuuBq9DB79F/VLIUyguwp3vDS/QTdYBMEXchF5AByVSdojWvA==" crossorigin="anonymous" />

    <!-- Font Awesome CSS CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css" integrity="sha512-pZlKGs7nEqF4zoG0egeK167l6yovsuL8ap30d07kA5AJUq+WysFlQ02DLXAmN3n0+H3JVz5ni8SJZnrOaYXWBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom styles for the About page -->
    

    <!-- Preload and minified stylesheets -->
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />

    <!-- Custom styles for the Home page -->
    <link rel="stylesheet" href="css/index.min.css" />
    <link rel="stylesheet" href="css/rooms.min.css" />
    <link rel="stylesheet" href="css/contacts.min.css" />
    
    <style>
        .body {
            background-color: #f7fafd;
        }

        /* Custom styles for the benefits section header */
        .about_benefits-header_title {
            margin-bottom: 50px;
        }

        /* Custom styles for the benefits section */
        .about_benefits {
            background-color: #f8f9fa;
            /* Background color for the section */
            padding: 50px 0;
            /* Adjust the padding as needed */
        }

        /* Custom styles for the benefits list */
        .about_benefits-list {
            list-style: none;
            padding: 0;
            margin: 0;
            /* Ensure equal spacing between items */
        }

        /* Custom styles for each benefit item */
        .about_benefits-list_item {
            background-color: #ffffff;
            /* White background color for each box */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Box shadow for each box */
            padding: 20px;
            /* Adjust the padding as needed */
            margin: 0 10px;
            /* Adjust the margin between boxes */
            border-radius: 8px;
            /* Optional: Add rounded corners */
        }

        /* Custom styles for the benefit titles */
        .about_benefits-list_item h3 {
            font-size: 25px;
        }

        /* Custom styles for the benefit icons */
        .check-in-icon {
            font-size: 3rem;
            color: #007bff;
            /* Bootstrap primary color */
        }

        /* Custom styles for the stages section header */
        .about_stages-main_header {
            margin-bottom: 40px;
        }

        /* Custom styles for the stages section */
        .about_stages {
            padding: 40px;
        }

        /* Custom styles for the icon boxes in the stages section */
        .icon-box {
            width: 80px;
            /* Adjust the width as needed */
            height: 80px;
            /* Adjust the height as needed */
            background-color: #235784;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Box shadow for each box */
            padding: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            /* Add some spacing between the icon box and text */
        }

        /* Custom styles for the icon inside the icon boxes */
        .icon {
            color: #ffffff;
            font-size: 2rem;
            /* White color for the icon */
        }

        /* Additional styles for button background color */
        .theme-element--accent {
            background: #dc3545 !important;
        }

        .h1 {
            font-size: 30px !important;
            padding: 10px;
        }

        .fa-map-marker-alt {
            font-size: 25px;
            margin: 0px 0px 0px 5px;
        }
    </style>
</head>

<body>
    <!-- Including navigation bar or header -->
    <?php
    include 'header.php';
    ?>

    <!-- Page header section -->



    <!-- Benefits Section -->
    <section class="about_benefits section">
        <div class="container">
            <div class="about_benefits-header d-md-flex align-items-center justify-content-between">
                <!-- Header title for the benefits section -->
                <h2 class="about_benefits-header_title" data-aos="fade-up">Quality & Satisfaction Ratio</h2>
            </div>
            <!-- List of benefits with dynamic content -->
            <ul class="about_benefits-list d-md-flex justify-content-between">
                <!-- Benefit Item 1 -->
                <li class="about_benefits-list_item">
                    <h3 class="text-black font-weight-bold text-left">Quality Accommodation</h3>
                    <span class="h1 d-flex align-items-start">85%</span>
                </li>
                <!-- Benefit Item 2 -->
                <li class="about_benefits-list_item">
                    <h3 class="text-black font-weight-bold text-left">Student's Satisfaction</h3>
                    <span class="h1 d-flex align-items-start">80%</span>
                </li>
                <!-- Benefit Item 3 -->
                <li class="about_benefits-list_item">
                    <h3 class="text-black font-weight-bold text-left">Community Engagement</h3>
                    <span class="h1 d-flex align-items-start">88%</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- Stages Section -->
    <section class="about_stages section">
        <div class="container d-xl-flex align-items-center">
            <div class="about_stages-main col-xl-12">
                <!-- Header for the stages section -->
                <h2 class="about_stages-main_header" data-aos="fade-right">Stages of booking a room</h2>
                <hr>
                <!-- List of stages with dynamic content -->
                <ul class="about_stages-main_list">
                    <!-- Stage Item 1 -->
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up">
                        <div class="main d-flex align-items-center justify-content-between">
                            <!-- Icon box for the stage -->
                            <div class="icon-box">
                                <div class="icon">
                                    <i class="fas fa-bed"></i> <!-- Font Awesome icon for bed -->
                                </div>
                            </div>
                            <div class="container">
                                <!-- Title and description for the stage -->
                                <h4 class="main_title">Room reservation</h4>
                                <p class="main_text">Select your desired room and make a reservation to secure your stay. We offer a variety of room options to suit your preferences.</p>
                            </div>
                        </div>
                    </li>
                    <!-- Stage Item 2 -->
                    <li class="list-item d-flex align-items-sm-center" data-aos="fade-up" data-aos-delay="50">
                        <div class="main d-flex align-items-center justify-content-between">
                            <!-- Icon box for the stage -->
                            <div class="icon-box">
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i> <!-- Font Awesome icon for file-alt -->
                                </div>
                            </div>
                            <div class="container">
                                <!-- Title and description for the stage -->
                                <h4 class="main_title">Filling in documents and payment via Bank</h4>
                                <p class="main_text">Complete the necessary paperwork and make a secure payment to confirm your reservation. Our streamlined process ensures a hassle-free experience.</p>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Button for action related to the stages -->
                <div class="wrapper" data-aos="fade-up">
                    <a class="about_stages-main_btn btn theme-element theme-element--accent" href="room.php">Choose room</a>
                </div>
            </div>
        </div>
    </section>

    <main>

        <header class="page">
            <div class="container">
                <!-- Title for the page -->
                <h1 class="page_title">Contact information</h1>
            </div>
        </header>
        <!-- Contact info section start -->
        <section class="contacts_main section">
            <div class="container container--contacts d-xl-flex align-items-center">
                <!-- Contact information column -->
                <div class="contacts_info col-xl-7" data-aos="fade-up">
                    <!-- Contact information header -->
                    <div class="contacts_info-header">
                        <h2 class="contacts_info-header_title">Contacts</h2>
                        <p class="contacts_info-header_text">
                            We value your feedback and inquiries. If you're a student with questions, we're here to assist you. Please feel free to reach out using the information below:
                        </p>
                    </div>
                    <!-- Main contact information block -->
                    <div class="contacts_info-main" >
                        <!-- Block for phone contact information -->
                        <div class="contacts_info-main_block d-sm-flex align-items-start">
                            <!-- Phone icon -->
                            <span class="px-3">
                                <!-- SVG for phone icon -->
                                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.9609 19.75L21 17.1797C20.7812 17.125 20.5625 17.0703 20.3438 17.0703C19.7969 17.0703 19.3047 17.2891 19.0312 17.6719L16.625 20.625C12.7969 18.7656 9.73438 15.7031 7.875 11.875L10.8281 9.46875C11.2109 9.19531 11.4297 8.70312 11.4297 8.15625C11.4297 7.9375 11.375 7.71875 11.3203 7.5L8.75 1.53906C8.47656 0.9375 7.875 0.5 7.21875 0.5C7.05469 0.5 6.94531 0.554688 6.83594 0.554688L1.3125 1.86719C0.546875 2.03125 0 2.6875 0 3.50781C0 17.3438 11.2109 28.5 24.9922 28.5C25.8125 28.5 26.4688 27.9531 26.6875 27.1875L27.9453 21.6641C27.9453 21.5547 27.9453 21.4453 27.9453 21.2812C27.9453 20.625 27.5625 20.0234 26.9609 19.75ZM24.9375 26.75C12.1406 26.75 1.75 16.3594 1.75 3.5625L7.16406 2.30469L9.67969 8.15625L5.6875 11.4375C8.36719 17.0703 11.4297 20.1328 17.1172 22.8125L20.3438 18.8203L26.1953 21.3359L24.9375 26.75Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!-- Wrapper for phone links -->
                            <div class="wrapper d-flex flex-column">
                                <!-- Phone contact links -->
                                <a class="link" href="tel:+1234567890">(44) 1122-3344</a>
                                <a class="link" href="tel:+1234567890">(44) 2222-4444</a>
                            </div>
                        </div>
                        <!-- Block for location contact information -->
                        <div class="contacts_info-main_block d-sm-flex align-items-start">
                            <!-- Location icon -->
                            <i class="fas fa-map-marker-alt py-3 px-3"></i>
                            <!-- Wrapper for location links -->
                            <div class="wrapper d-flex flex-column">
                                <!-- Location contact links -->
                                <a class="link" href="#">Our Location:</a>
                                <a class="link" href="#">Digby Stuart College London, Uk</a>
                            </div>
                        </div>
                    </div>
                    <!-- Contact information footer -->
                    <div class="contacts_info-footer">
                        <h4 class="contacts_info-footer_header" id="mytext">How can I contact the HostelPro for general inquiries?</h4>
                        <div class="contacts_info-footer_content">
                            <!-- Contact information details -->
                            <p class="text">
                                <b>Phone:</b> Call us at +(44) 234-5678 during our business hours (Monday to Sunday, 9:00 AM - 6:00 PM)
                            </p>
                            <p class="text">
                                <b>Visit Us:</b> Our hostel is located at Digby Stuart College London, United Kingdom.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact info section end -->
    </main>

    <!-- Including footer -->
    <?php
    include 'footer.php';
    ?>

    <!-- Including common scripts -->
    <script src="js/common.min.js"></script>
</body>

</html>
