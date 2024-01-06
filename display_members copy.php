<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    // Only Active Members
    // $sql = "SELECT * FROM member WHERE Mandal='$mandal' AND active=true ORDER BY memberid";

    // All Members
    $sql = "SELECT * FROM member WHERE Mandal='$mandal' ORDER BY memberid";

    $result = $con->query($sql);
    // echo('<script>alert("No of members : '.$result->num_rows.'");</script>');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabha Attendance Management System</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .align-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <a href="home.php">< Go back to Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h3 class="text-center"><u>All Members of <?= $mandal ?> Mandal</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">Total number of Members : <?= isset($result) ? $result -> num_rows : 0 ?></h5>
                <table class="table table-bordered table-striped table-responsive-md table-sm align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <!-- <th class="text-center">Gender</th> -->
                            <th class="text-center">Birth date</th>
                            <th class="text-center">Mobile No</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Active</th>
                        </tr>
                    </thead>
					<?php
					if(isset($result)) {
                        while($row = $result->fetch_assoc()) { 
					?>
						<tr>
							<td> <?= $row['memberid'] ?> </td>
                            <td> <?= $row['name'] ?> </td>
                            <!-- <td> <?= $row['gender'] ?> </td> -->
                            <td> <?= DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M Y') ?> </td>
                            <td> <?= $row['mobileno'] ?> </td>
                            <td> <?= $row['address'] ?> </td>
                            <td> <?= $row['active']==1 ? "Yes" : "No" ?> </td>
						</tr>
					<?php
						}
                        $con->close();
                    }
					?>
                </table>
                <br/>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="window.print()"> Print </button>
                </div>
                <br/>
                <br/>
                <br/>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>