<div class="welcome-message">
        Welcome, Admin <?php // Your username here! ?>
    </div>

    <!-- User dropdown with logout -->
    <div class="user-dropdown">
        <img src="admin-icn.png" alt="Profile Picture" width="40" height="40" class="rounded-circle">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <a class="nav-link" href="dashboard.php">
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
                        <a class="nav-link" href="manage-mess.php">
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