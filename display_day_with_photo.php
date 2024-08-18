<?php
    include_once('constants.php');

    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    date_default_timezone_set('Asia/Kolkata');

    $date = isset($_GET['date']) ? $_GET['date'] : '';
    $param = isset($_GET['param']) ? $_GET['param'] : 'Present';
    $formattedDate = '';

    if(isset($_GET['date'])) {
        date_default_timezone_set('Asia/Kolkata');

        include_once('conn.php');

        $sql = "SELECT member.memberid as memberid, name, gender, dob, mobileno, address, photo, attendance.timestamp as timestamp FROM member INNER JOIN attendance ON member.memberid = attendance.memberid WHERE attendance.date = '$date' AND mandal='$mandal' ORDER BY attendance.timestamp";

        if(strcmp($param, "Absent") == 0) {
            $sql = "SELECT memberid, name, gender, dob, mobileno, address, photo, '' as timestamp FROM member WHERE memberid NOT IN (SELECT memberid from attendance WHERE date = '$date') AND mandal='$mandal' AND active=true";
        }

	    $result = $con->query($sql);
        // echo('<script>alert("No of members : '.$result->num_rows.'");</script>');

        // Format date
        // $date = new Date();
        $formattedDate = DateTime::createFromFormat('Y-m-d', $date)->format('d M Y');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sabha Attendance Management System</title> -->
    <title>
        <?= $formattedDate ?>
        <?= strcmp($param, "Present") == 0 ? ' Sabha Attendance' : ' - Absent' ?>
    </title>
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
                <h2 class="text-center"><u><?= strcmp($param, "Present") == 0 ? 'Attendance' : $param ?> for Date - 
                <span id="attendanceDate"><?= $formattedDate ?></span></u></h2>
            </div>
        </div>
        <form method="GET" action="" id="searchByDayForm">
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label"><b>Sabha Date</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" id="date" value="<?= $date != '' ? $date : date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-2">
                    <select name="param" class="form-select" id="param">
                        <option value="Absent" <?= strcmp($param, "Absent") == 0 ? 'selected' : '' ?>>Absent</option>
                        <option value="Present" <?= strcmp($param, "Present") == 0 ? 'selected' : '' ?>>Present</option>
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
            <div class="col-md-12">
                <h3 class="text-center">Total number of Members : <?= isset($result) ? $result -> num_rows : 0 ?></h3>
                <table class="table table-bordered table-striped table-responsive-md table-sm align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">ID</th>
                            <?php
                                if(strcmp($param, "Present") == 0) {
                                    echo('<th class="text-center">Time</th>');
                                }
                            ?>
                            <th class="text-center">Name</th>
                            <!-- <th class="text-center">Gender</th> -->
                            <th class="text-center">Birthday</th>
                            <th class="text-center">Mobile No</th>
                            <!-- <th>Address</th> -->
                            <th class="text-center">Photo</th>
                        </tr>
                    </thead>
					<?php
					if(isset($result)) {
                        while($row = $result->fetch_assoc()) { 
                            $datetime = new DateTime($row['timestamp']);
							// $datetime->add(new DateInterval('PT10H30M'));
                            $datetime->add(new DateInterval(TIME_DIFFERENCE));
					?>
						<tr>
							<td class="text-center"> <?= $row['memberid'] ?> </td>
                            <!-- <td> <?= $datetime->format('g:i A') ?> </td> -->
                            <!-- <td><?= $row['timestamp'] != "" ? $datetime->format('g:i A') : "" ?></td> -->
                            <?php
                                if(strcmp($param, "Present") == 0) {
                                    echo('<td class="text-center">'.$datetime->format('g:i A').'</td>');
                                }
                            ?>
                            <td> <?= $row['name'] ?> </td>
                            <!-- <td> <?= $row['gender'] ?> </td> -->
                            <td class="text-center"> <?= DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M') ?> </td>
                            <td class="text-center"> <?= $row['mobileno'] ?> </td>
                            <!-- <td> <?= $row['address'] ?> </td> -->
                            <td class="text-center">
                                <!-- <?= $row['photo'] != '' ? '<img src="images/photos/'.$row['photo'].'" height=200 class="card-img-top" alt="photo" />' : '' ?> -->
                                <!-- <?= $row['photo'] != '' ? '<img src="images/photos/'.$row['photo'].'" style="height: 150px; width:130px;" class="img-thumbnail" alt="photo" />' : '' ?> -->
                                <!-- <?= $row['photo'] != '' ? '<img src="images/photos/'.$row['photo'].'" class="img-thumbnail" alt="photo" />' : '' ?> -->
                                <?= $row['photo'] != '' ? '<img src="images/photos/'.$row['photo'].'" style="max-height: 150px; max-width: 130px;" alt="photo" />' : 'Photo not available' ?>
                            </td>
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