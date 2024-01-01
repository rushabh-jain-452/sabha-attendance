<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark"> -->
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark"> -->
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">Sabha Attendance System</a> -->
        <a class="navbar-brand" href="#">
            <img src="images/sha_logo.png" alt="Shri Hari Ashram" height="50" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="display_day.php">Check Attendance for Date</a></li>
                        <li><a class="dropdown-item" href="display_member_attendance.php">Check Attendance for Member</a></li>
                        <li><a class="dropdown-item" href="display_members.php">Display All Members</a></li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>