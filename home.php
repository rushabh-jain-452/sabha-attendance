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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .align-center {
            text-align: center;
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
                <h3 class="align-center">🙏🏻 જય સ્વામિનારાયણ 🙏🏻</h3>
                <h4 class="align-center">🙏🏻 દાસના દાસ 🙏🏻</h4>
                <hr />
                <h1 class="align-center">Welcome to Sabha Attendance Management System</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- <h3 class="align-center"><a href="register.php">Register new member</a></h3> -->
                <br />
                <h3 class="align-center"><a href="display_day.php">Check Attendance for Date</a></h3>
                <br />
                <h3 class="align-center"><a href="display_member_attendance.php">Check Attendance for Member</a></h3>
                <br />
                <h3 class="align-center"><a href="display_members.php">Display All Members</a></h3>
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