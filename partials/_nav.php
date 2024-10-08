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
                    <!-- <a class="nav-link active" aria-current="page" href="home.php"> Home </a> -->
                    <a class="nav-link" aria-current="page" href="home.php"> Home </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="fill_member_attendance.php"> Fill Attendance </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Display Members </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="display_members.php">All Members</a></li>
                        <li><a class="dropdown-item" href="display_members_with_photo.php">All Members (with Photo)</a></li>
                        <li><a class="dropdown-item" href="display_active_members.php">Active Members</a></li>
                        <li><a class="dropdown-item" href="display_inactive_members.php">Inactive Members</a></li>
                        <li><a class="dropdown-item" href="display_ambrish_report.php">Ambrish Report</a></li>
                        <li><a class="dropdown-item" href="display_detailed_report.php">Detailed Report</a></li>
                        <li><a class="dropdown-item" href="display_age_wise_members.php">Age-wise Report</a></li>
                        <li><a class="dropdown-item" href="display_monthly_birthday_report.php">Monthly Birthday Report</a></li>
                        <li><a class="dropdown-item" href="display_monthly_birthday_report_with_photo.php">Monthly Birthday Report (with Photo)</a></li>
                        <li><a class="dropdown-item" href="display_members_not_attending_sabha.php">Members not attending Sabha</a></li>
                        <li><a class="dropdown-item" href="display_members_not_attending_sabha_with_photo.php">Members not attending Sabha (with Photo)</a></li>
                        <li><a class="dropdown-item" href="filter_members.php">Search Members</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Attendance Reports </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="display_day.php">Check Attendance for Date</a></li>
                        <li><a class="dropdown-item" href="display_day_with_photo.php">Check Attendance for Date (with Photo)</a></li>
                        <li><a class="dropdown-item" href="display_member_attendance.php">Check Attendance for Member</a></li>
                        <li><a class="dropdown-item" href="display_datewise_number_of_members.php">Date-wise Number of Members</a></li>
                        <li><a class="dropdown-item" href="display_memberwise_number_of_sabha.php">Member-wise Number of Sabha Attended</a></li>
                        <li><a class="dropdown-item" href="display_timewise_number_of_sabha.php">Time-wise Number of Sabha Attended</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a>Display Members</a>
                            <ul class="dropdown-menu">
                                <li>Item 1</li>
                                <li>Item 2</li>
                            </ul>
                        </li> -->


                        <!-- <li><a class="dropdown-item" href="display_members.php">Display All Members</a></li> -->
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="qr_codes.php"> QR Codes </a>
                </li>
                
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="logout.php"> Logout </a>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>