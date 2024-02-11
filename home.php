<?php
    session_start();
    if(isset($_SESSION["username"])){
        include_once('conn.php');
        // $username = $_SESSION["username"];
        $name = $_SESSION["name"];
    }
    else{
        header("location:login.php");
        // echo 'You are not logged in';
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabha Attendance Management System</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .align-center {
            text-align: center;
        }
        h4 {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12">
                <?php require 'partials/_nav.php' ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br />
                <h3 class="align-center">Hello <?php echo $name ?></h3>
                <hr />
                <!-- <h3 class="align-center">🙏🏻 જય સ્વામિનારાયણ 🙏🏻</h3>
                <h4 class="align-center">🙏🏻 દાસના દાસ 🙏🏻</h4>
                <hr /> -->
                <h1 class="align-center">Welcome to Sabha Attendance Management System</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- <h3 class="align-center"><a href="register.php">Register new member</a></h3> -->
                <hr />
                <h4 class="align-center"><a href="fill_member_attendance.php">Fill Attendance for Member</a></h4>
                <hr />
                <h4 class="align-center"><a href="display_day.php">Check Attendance for Date</a></h4>
                <h4 class="align-center"><a href="display_day_with_photo.php">Check Attendance for Date (with Photo)</a></h4>
                <h4 class="align-center"><a href="display_member_attendance.php">Check Attendance for Member</a></h4>
                <h4 class="align-center"><a href="display_datewise_number_of_members.php">Date-wise Number of Members</a></h4>
                <h4 class="align-center"><a href="display_memberwise_number_of_sabha.php">Member-wise Number of Sabha Attended</a></h4>
                <h4 class="align-center"><a href="display_timewise_number_of_sabha.php">Time-wise Number of Sabha Attended</a></h4>
                <hr />
                <h4 class="align-center"><a href="display_members.php">All Members</a></h4>
                <h4 class="align-center"><a href="display_active_members.php">Active Members</a></h4>
                <h4 class="align-center"><a href="display_inactive_members.php">Inactive Members</a></h4>
                <h4 class="align-center"><a href="display_ambrish_report.php">Ambrish Report</a></h4>
                <h4 class="align-center"><a href="display_detailed_report.php">Detailed Members Report</a></h4>
                <h4 class="align-center"><a href="display_age_wise_members.php">Age-wise Report</a></h4>
                <h4 class="align-center"><a href="display_monthly_birthday_report.php">Monthly Birthday Report</a></h4>
                <h4 class="align-center"><a href="display_members_not_attending_sabha.php">Members not attending Sabha</a></h4>
                <h4 class="align-center"><a href="filter_members.php">Search Members</a></h4>
                <hr />
                <h4 class="align-center"><a href="qr_codes.php">QR Codes</a></h4>
                <br/><br/>
                <br/><br/>
            </div>
        </div>
        <!-- <div class="row">
            <br/>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">The current link item</a>
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                <a class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
            </div>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>