<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    date_default_timezone_set('Asia/Kolkata');

    include_once('conn.php');

    $sabhaHour = 20;
    $sabhaMin = 15;

    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
    $sabhaTime = isset($_GET['sabhaTime']) ? $_GET['sabhaTime'] : ($sabhaHour.':'.$sabhaMin);  // 21:04

    // echo('<script>alert("'.$sabhaTime.'")</script>');

    if(isset($_GET['startDate'])) {
        if($sabhaTime != null) {
            $arr = explode(':', $_GET['sabhaTime']);
            // $sabhaHour = $arr[0] - 10;
            $sabhaHour = $arr[0] - 9;

            $sabhaMin = $arr[1];

            // Time conversion for MySQL time based on server
            if($sabhaMin >= 30) {
                $sabhaMin -= 30;
            } else {
                $sabhaHour--;
                $sabhaMin += 30;
            }
        }

        // echo('<script>alert("'.$sabhaHour.':'.$sabhaMin.'")</script>');

        // $sql = "SELECT memberid, name, count(*) as number_of_sabha FROM (SELECT member.memberid as memberid, name FROM member INNER JOIN attendance ON member.memberid = attendance.memberid WHERE mandal='$mandal' AND date BETWEEN '$startDate' AND '$endDate') as member GROUP BY memberid ORDER BY number_of_sabha DESC, memberid";

        $sql = "SELECT memberid, name, count(*) as number_of_sabha FROM (SELECT member.memberid as memberid, name, hour(timestamp) as hour, minute(timestamp) as min FROM member INNER JOIN attendance ON member.memberid = attendance.memberid WHERE mandal='$mandal' AND date BETWEEN '$startDate' AND '$endDate') as member WHERE (hour = $sabhaHour AND min <= $sabhaMin) OR (hour < $sabhaHour) GROUP BY memberid ORDER BY number_of_sabha DESC, memberid";

        $result = $con->query($sql);

        $n = $result -> num_rows;
        // echo('<script>alert("Number of sabhas : '.$n.'");</script>');

        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        if($endTime <= $startTime) {
            echo('<script>alert("To Date cannot be less than From Date");</script>');
        }

        // $weeks = ceil(($endTime - $startTime) / 60 / 60 / 24 / 7);

        // $per = 0;
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time-wise Attendance</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .align-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <a href="home.php">< Go back to Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h3 class="text-center"><u>Time-wise Number of Sabha Attended</u></h3>
            </div>
        </div>
        <form method="GET" action="" id="searchByMemberForm">
            <div class="form-group row">
                <label for="startDate" class="col-md-2 col-form-label"><b>From</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="startDate" id="startDate" value="<?= $startDate != null ? $startDate : date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
                </div>
                <label for="endDate" class="col-md-2 col-form-label"><b>To</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="endDate" id="endDate" value="<?= $endDate != null ? $endDate : date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            <br/>
            <div class="form-group row">
                <label for="sabhaTime" class="col-md-3 col-form-label"><b>Attended Sabha before time</b></label>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="sabhaTime" id="sabhaTime" value="<?= $sabhaTime ?>" required>
                </div>
            </div>
            <div class="form-group row offset-2">
                <div class="col-md-3">
                    <br/>
                    <button type="submit" class="btn btn-primary" name="btnSearch">Search</button>
                </div>
            </div>
        </form>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center"><u>Time-wise Number of Sabha attended from <?= isset($startDate) ? DateTime::createFromFormat('Y-m-d', $startDate)->format('d M Y') : '' ?> 
                    to <?= isset($endDate) ? DateTime::createFromFormat('Y-m-d', $endDate)->format('d M Y') : '' ?> </u>
                </h4>
                <h5 class="text-center">Total number of Members : <?= isset($result) ? $result -> num_rows : 0 ?></h5>
                <table class="table table-light table-bordered table-responsive-md table-sm table-striped align-middle table-align-center">
                    <tr class="table-primary">
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Number of Sabha</th>
                        <!-- <th class="text-center">Attendance %</th> -->
                    </tr>
					<?php
                    if(isset($result)) {
                        $totalNoOfSabha = 0;
                        while($row = $result->fetch_assoc()) {
                            if($totalNoOfSabha < $row['number_of_sabha']) {
                                $totalNoOfSabha = $row['number_of_sabha'];
                            }

                            $per = 0;
                            try {
                                if($totalNoOfSabha != 0 && $row['number_of_sabha'] != 0) {
                                    $per = $row['number_of_sabha'] * 100 / $totalNoOfSabha;
                                    $per = round($per, 0);
                                }
                            }
                            catch (Exception $e) {
                                // echo('<script>alert("Error");</script>');
                                echo 'Error : '.$e->getMessage();
                            }
					?>
						<tr>
							<td class="text-center"> <?= $row['memberid'] ?> </td>
                            <td> <?= $row['name'] ?> </td>
							<td class="text-center"> <?= $row['number_of_sabha'] ?> </td>
                            <!-- <td class="text-center"> <?= $per ?> % </td> -->
						</tr>
					<?php
						}
                    }
					?>
                </table>
                <br/>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="window.print()"> Print </button>
                </div>
                <br/>
                <div class="text-center">
                    <span>This report was generated on <span id="reportDate">20 Jan 2024 at 09:29:00</span></span>
                </div>
                <br/>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/dateFunctions.js"></script>
    <script>
        const spanElement = document.getElementById('reportDate');
        spanElement.innerText = getFormattedDate();
    </script>
</body>
</html>
