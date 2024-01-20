<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    $memberid = '';
    $row = '';
    
    if(isset($_GET['memberid'])) {
        $memberid = $_GET['memberid'];

        // Only Active Members
        $sql = "SELECT memberid, name, mobileno, gender, dob, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS my_age, marital_status, blood_group, qualification, occupation, address, is_ambrish, satsang_patrika, email, photo, active
        FROM member WHERE Mandal='$mandal' AND memberid=$memberid";

        $result = $con->query($sql);

        $row = $result->fetch_assoc();
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
    </style>
</head>

<body>
    <div class="container bg-light">
        <div class="row">
            <div class="row">
                <div class="col-md-12 pt-3">
                    <a href="" onclick="window.history.go(-1); return false;">< Go back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <h3 class="text-center"><u><b><?= $mandal ?> Mandal</b></u></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <h3 class="text-center"><u><b>ID no : <?= $row != null ? $row['memberid'] : '' ?></b></u></h3>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12 text-center">
                    <?= $row != null && $row['photo'] != '' ? '<img src="images/photos/'.$row['photo'].'" style="max-height: 200px; max-width: 150px;" class="img-thumbnail" alt="photo" />' : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <h3 class="text-center"><u><?= $row != null ? $row['name'] : '' ?></u></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Mobile no : </b>
                    <?= $row != null ? $row['mobileno'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Birth Date : </b>
                    <?= $row != null ? DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M Y') : '' ?>
                    (<?= $row != null ? $row['my_age'] : '' ?> years)
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Marital Status : </b>
                    <?= $row != null ? $row['marital_status'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Blood Group : </b>
                    <?= $row != null ? $row['blood_group'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Qualification : </b>
                    <?= $row != null ? $row['qualification'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Address : </b>
                    <?= $row != null ? $row['address'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Ambrish : </b>
                    <?= $row != null && $row['is_ambrish']==1 ? "Yes" : "No" ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Getting Satsang Patrika : </b>
                    <?= $row != null && $row['satsang_patrika']==1 ? "Yes" : "No" ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <b>Active : </b>
                    <?= $row != null && $row['active']==1 ? "Yes" : "No" ?>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="window.print()"> Print </button>
            </div>
            <br/>
            <br/>
            <div class="text-center">
                <span>This report was generated on <span id="reportDate">20 Jan 2024 at 09:29:00</span></span>
            </div>
            <br/>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/dateFunctions.js"></script>
    <script>
        const spanElement = document.getElementById('reportDate');
        spanElement.innerText = getFormattedDate();
    </script>
</body>

</html>