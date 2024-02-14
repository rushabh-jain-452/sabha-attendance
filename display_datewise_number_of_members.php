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

    $sql = "SELECT count(*) as number_of_members FROM member WHERE mandal='$mandal' AND active=true";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $numberOfMembers = $row['number_of_members'];

    // Delete Attendance
    if(isset($_GET['deleteDate'])) {
        $deleteDate = $_GET['deleteDate'];
        $sql = "DELETE FROM attendance WHERE date='$deleteDate'";
        if($con->query($sql)){
            echo '<script> alert("Attendance deleted successfully"); </script>';
        }else{
            echo $sql."<br>";
            echo '<script> alert("Something went wrong..."); </script>';
            // echo "<h3>Something went wrong...!</h3>";
        }
    }

    // Get Attendance
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

    if(isset($_GET['startDate'])) {
        $sql = "SELECT date, count(memberid) as number_of_members FROM `attendance` WHERE date BETWEEN '$startDate' AND '$endDate' AND  memberid IN (SELECT memberid FROM member WHERE mandal='$mandal') GROUP BY date";

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
    <title>Date-wise Attendance</title>
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
                <h3 class="text-center"><u>Date-wise Number of Members</u></h3>
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
                <h4 class="text-center"><u>Number of Members attended Sabha from <?= isset($startDate) ? DateTime::createFromFormat('Y-m-d', $startDate)->format('d M Y') : '' ?> 
                    to <?= isset($endDate) ? DateTime::createFromFormat('Y-m-d', $endDate)->format('d M Y') : '' ?> </u>
                </h4>
                <h5 class="text-center">Total Number of members in <?= $mandal ?> mandal : <?= $numberOfMembers ?></h5>
                <table class="table table-light table-bordered table-responsive-md table-sm table-striped align-middle table-align-center">
                    <tr class="table-primary">
                        <th class="text-center">Date</th>
                        <th class="text-center">Number of Members</th>
                        <th class="text-center">Attendance %</th>
                    </tr>
					<?php
                    if(isset($result)) {
                        while($row = $result->fetch_assoc()) {
                            $per = 0;
                            try {
                                if($numberOfMembers != 0 && $row['number_of_members'] != 0) {
                                    $per = $row['number_of_members'] * 100 / $numberOfMembers;
                                    $per = round($per, 0);
                                }
                            }
                            catch (Exception $e) {
                                // echo('<script>alert("Error");</script>');
                                echo 'Error : '.$e->getMessage();
                            }
					?>
						<tr>
							<td class="text-center">
                                <?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('d M Y') ?> 
                                (<?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('l') ?>)
                                <?php
                                    if($row['number_of_members'] < 10) {
                                ?>
                                    <a href="display_datewise_number_of_members.php?deleteDate=<?=$row['date']?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>" class="btn btn-sm btn-danger" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </a>
                                <?php
                                    }
                                ?>
                            </td>
							<td class="text-center"> <?= $row['number_of_members'] ?> </td>
                            <td class="text-center"> <?= $per ?> % </td>
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
