<?php
    if(isset($_GET['date'])) {
        date_default_timezone_set('Asia/Kolkata');

        include_once('conn.php');

        $date = $_GET['date'];
        $param = $_GET['param'];

        $sql = "SELECT member.memberid as memberid, name, gender, dob, mobileno, address, attendance.timestamp as timestamp FROM member INNER JOIN attendance ON member.memberid = attendance.memberid WHERE attendance.date = '$date' ORDER BY attendance.timestamp";

        if(strcmp($param, "Absent") == 0) {
            $sql = "SELECT memberid, name, gender, dob, mobileno, address, '' as timestamp FROM member WHERE memberid NOT IN (SELECT memberid from attendance WHERE date = '$date')";
        }

	    $result = $con->query($sql);
        // echo('<script>alert("No of members : '.$result->num_rows.'");</script>');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance for Day</title>
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
                <h1 class="text-center"><u>Attendance for Date</u></h1>
            </div>
        </div>
        <form method="GET" action="" id="searchByDayForm">
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label"><b>Sabha Date</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" id="date" max="<?php print(date('Y-m-d')); ?>" required>
                </div>
                <div class="col-md-2">
                    <select name="param" class="form-select" id="param">
                        <option value="Absent">Absent</option>
                        <option value="Present" selected>Present</option>
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
                <h2 class="text-center">Total number of Members : <?= isset($result) ? $result -> num_rows : 0 ?></h2>
                <table class="table table-bordered table-responsive-md table-sm align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Mobile No</th>
                            <!-- <th>Address</th> -->
                            <th>Time</th>
                        </tr>
                    </thead>
					<?php
					if(isset($result)) {
                        while($row = $result->fetch_assoc()) { 
					?>
						<tr>
							<td> <?= $row['memberid'] ?> </td>
                            <td> <?= $row['name'] ?> </td>
                            <td> <?= $row['gender'] ?> </td>
                            <td> <?= DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M Y') ?> </td>
                            <td> <?= $row['mobileno'] ?> </td>
                            <!-- <td> <?= $row['address'] ?> </td> -->
                            <td> <?= $row['timestamp'] ?> </td>
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>