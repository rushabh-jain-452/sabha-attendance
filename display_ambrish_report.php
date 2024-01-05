<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    $param = isset($_GET['param']) ? $_GET['param'] : 'Ambrish';

    // Only Ambrish Members
    $sql = "SELECT * FROM member WHERE Mandal='$mandal' AND is_ambrish=true AND active=true ORDER BY memberid";

    if(strcmp($param, "Not_Ambrish") == 0) {
        $sql = "SELECT * FROM member WHERE Mandal='$mandal' AND is_ambrish=false AND active=true ORDER BY memberid";
    }

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
        <form method="GET" action="" id="searchByDayForm">
            <div class="form-group row align-items-center justify-content-center">
                <label for="param" class="col-md-1 col-form-label"><b>Select</b></label>
                <div class="col-md-2">
                    <select name="param" class="form-select" id="param">
                        <option value="Ambrish" <?= strcmp($param, "Ambrish") == 0 ? 'selected' : '' ?>>Ambrish</option>
                        <option value="Not_Ambrish" <?= strcmp($param, "Not_Ambrish") == 0 ? 'selected' : '' ?>>Not Ambrish</option>
                    </select>
                </div>
                <!-- <div class="dropdown col-md-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Present</a></li>
                        <li><a class="dropdown-item" href="#">Absent</a></li>
                    </ul>
                </div> -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" name="btnSearch">Search</button>
                </div>
            </div>
        </form>
        <hr/>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h3 class="text-center"><u><b><?= $param ?></b> Members of <?= $mandal ?> Mandal</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">Total number of Members : <?= isset($result) ? $result -> num_rows : 0 ?></h5>
                <table class="table table-bordered table-responsive-md table-sm align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <!-- <th class="text-center">Gender</th> -->
                            <th class="text-center">Birth date</th>
                            <th class="text-center">Mobile No</th>
                            <th class="text-center">Address</th>
                        </tr>
                    </thead>
					<?php
					if(isset($result)) {
                        while($row = $result->fetch_assoc()) { 
					?>
						<tr>
							<td class="text-center"> <?= $row['memberid'] ?> </td>
                            <td> <?= $row['name'] ?> </td>
                            <!-- <td> <?= $row['gender'] ?> </td> -->
                            <td class="text-center"> <?= DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M Y') ?> </td>
                            <td class="text-center"> <?= $row['mobileno'] ?> </td>
                            <td> <?= $row['address'] ?> </td>
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>