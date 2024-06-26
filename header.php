<style>
    .nav-item{
        text-decoration: none !important;
    }
    .nav-item:hover{
        text-decoration:underline !important;
        
        transition: black .3s ease-in-out;
    }
    
</style>
<!-- Header section with main container -->
<header class="header d-flex align-items-center" data-page="home">
    <!-- Container for positioning and styling -->
    <div class="container position-relative d-flex justify-content-between align-items-center">

        <!-- Brand logo and name -->
        <a class="brand d-flex align-items-center" href="index.php">
            <!-- Theme-specific logo -->
            <span class="brand_logo theme-element">
                <!-- SVG logo -->
                <svg id="brandHeader" width="22" height="23" viewBox="0 0 22 23" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG path for the logo -->
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.03198 3.80281V7.07652L3.86083 9.75137L0.689673 12.4263L0.667474 6.56503C0.655304 3.34138 0.663875 0.654206 0.686587 0.593579C0.71907 0.506918 1.4043 0.488223 3.87994 0.506219L7.03198 0.529106V3.80281ZM21.645 4.36419V5.88433L17.0383 9.76316C14.5046 11.8966 11.2263 14.6552 9.75318 15.8934L7.07484 18.145V20.3225V22.5H3.85988H0.64502L0.667303 18.768L0.689673 15.036L2.56785 13.4609C3.60088 12.5946 6.85989 9.85244 9.81009 7.36726L15.1741 2.84867L18.4096 2.8464L21.645 2.84413V4.36419ZM21.645 15.5549V22.5H18.431H15.217V18.2638V14.0274L15.4805 13.7882C15.8061 13.4924 21.5939 8.61606 21.6236 8.61248C21.6353 8.61099 21.645 11.7351 21.645 15.5549Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!-- Brand name -->
            <span class="brand_name">HostelPro</span>
        </a>

        <!-- Offcanvas menu trigger -->
        <div class="header_offcanvas offcanvas offcanvas-end" id="menuOffcanvas">
            <!-- Header offcanvas container with header and close button -->
            <div class="header_offcanvas-header d-flex justify-content-between align-content-center">

                <!-- Brand logo and name in offcanvas menu -->
                <a class="brand d-flex align-items-center" href="index.php">
                    <!-- Theme-specific logo in offcanvas menu -->
                    <span class="brand_logo theme-element">
                        <!-- SVG logo -->
                        <svg id="brandOffset" width="22" height="23" viewBox="0 0 22 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- SVG path for the logo -->
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.03198 3.80281V7.07652L3.86083 9.75137L0.689673 12.4263L0.667474 6.56503C0.655304 3.34138 0.663875 0.654206 0.686587 0.593579C0.71907 0.506918 1.4043 0.488223 3.87994 0.506219L7.03198 0.529106V3.80281ZM21.645 4.36419V5.88433L17.0383 9.76316C14.5046 11.8966 11.2263 14.6552 9.75318 15.8934L7.07484 18.145V20.3225V22.5H3.85988H0.64502L0.667303 18.768L0.689673 15.036L2.56785 13.4609C3.60088 12.5946 6.85989 9.85244 9.81009 7.36726L15.1741 2.84867L18.4096 2.8464L21.645 2.84413V4.36419ZM21.645 15.5549V22.5H18.431H15.217V18.2638V14.0274L15.4805 13.7882C15.8061 13.4924 21.5939 8.61606 21.6236 8.61248C21.6353 8.61099 21.645 11.7351 21.645 15.5549Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!-- Brand name in offcanvas menu -->
                    <span class="brand_name">Hostel Pro</span>
                </a>

                <!-- Close button for offcanvas menu -->
                <button class="close" type="button" data-bs-dismiss="offcanvas">
                    <!-- Close icon -->
                    <i class="icon-close--entypo"></i>
                </button>
            </div>

            <!-- Navigation menu -->
            <nav class="header_nav">
                <!-- Navigation list -->
                <ul class="header_nav-list">
                    <!-- Home link with dynamic class for active page -->
                    <li class="header_nav-list_item">
                        <a class="nav-item " href="index.php"
                            data-page="home"  >Home</a>
                    </li>

                    <!-- Hostel link with dynamic class for active page -->
                    <li class="header_nav-list_item">
                        <a class=" nav-item " href="room.php"
                            data-page="room"  >Hostel</a>
                    </li>

                    <!-- Notifications link with dynamic class for active page -->
                    <!-- <li class="header_nav-list_item">
                        <a class="nav-item "
                            href="notifications.php" data-page="notifications">Notifications</a>
                    </li> -->

                    <!-- About Us link with dynamic class for active page -->
                    <li class="header_nav-list_item">
                        <a class="link nav-item >" href="About.php"
                            data-page="contacts" >About Us</a>
                    </li>
                    <!-- Login dropdown with dynamic class for active page -->
                    <li class="header_nav-list_item dropdown">
                        <!-- Dropdown link with icon -->
                        <a class="nav-link nav-link--contacts dropdown-toggle d-inline-flex align-items-center theme-element--accent"
                            style="color:white;" href="./student/index.php" data-bs-toggle="collapse"
                            data-bs-target="#contactsMenu" aria-expanded="false" aria-controls="contactsMenu">
                            Login
                        </a>
                        <!-- Empty dropdown menu, can be filled with login options -->
                        <div class="dropdown-menu collapse" id="contactsMenu">
                            <!-- Login options go here -->
                        </div>
                    </li>
                </ul>
            </nav>
        </div>


        <!-- Trigger button for small screens -->
        <button class="header_trigger d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#menuOffcanvas">
            <!-- Stream icon for the trigger -->
            <i class="icon-stream"></i>
        </button>
    </div>
</header>
