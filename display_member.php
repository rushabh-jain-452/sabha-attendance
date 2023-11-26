<!-- Filter by date -->
<!-- Filter by name from dropdown -->
<?php
    date_default_timezone_set('Asia/Kolkata');

    $con = new mysqli("localhost", "root", "", "attendancedb");
    if($con->connect_errno){
        die("Connection failed.".$con->connect_error);
    }

    $sql = "SELECT memberid, name FROM member ORDER BY name";

    $memberResult = $con->query($sql);

    if(isset($_GET['memberid'])) {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $memberid = $_GET['memberid'];

        $sql = "SELECT * FROM attendance WHERE memberid = $memberid AND date BETWEEN '$startDate' AND '$endDate' ORDER BY attendanceid";

        $result = $con->query($sql);

        $n = $result -> num_rows;
        // echo('<script>alert("Number of sabhas : '.$n.'");</script>');

        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        $weeks = ceil(($endTime - $startTime) / 60 / 60 / 24 / 7);

        $per = $n * 100 / $weeks;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance for Member</title>
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
                <h1 class="text-center"><u>Attendance for Member</u></h1>
            </div>
        </div>
        <form method="GET" action="" id="searchByMemberForm">
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label"><b>Name</b></label>
                <div class="col-md-2">
                    <select name="memberid" class="form-select" id="memberid">
                        <?php
                            while($row = $memberResult->fetch_assoc()) { 
                        ?>
                            <option value="<?= $row['memberid'] ?>"> <?= $row['name'] ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <br/>
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label"><b>From</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="startDate" id="startDate" max="<?php print(date('Y-m-d')); ?>" required>
                </div>
                <label for="date" class="col-md-2 col-form-label"><b>To</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="endDate" id="endDate" max="<?php print(date('Y-m-d')); ?>" required>
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
                <h2 class="text-center">From <?= isset($startDate) ? DateTime::createFromFormat('Y-m-d', $startDate)->format('d M Y') : '' ?> 
                    to <?= isset($endDate) ? DateTime::createFromFormat('Y-m-d', $endDate)->format('d M Y') : '' ?> 
                </h2>
                <h2 class="text-center">Total <?= isset($n) ? $n : 0 ?> sabha attended out of <?= isset($weeks) ? $weeks : 0 ?> (<?= isset($per) ? $per : 0 ?> %) </h2>
                <table class="table table-success table-bordered table-responsive-md table-sm table-striped align-middle table-align-center">
                    <tr>
                        <th>Date</th>
                        <th>Attendance Timestamp</th>
                    </tr>
					<?php
                    if(isset($result)) {
                        while($row = $result->fetch_assoc()) { 
                        
					?>
						<tr>
							<td> <?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('d M Y') ?> </td>
							<td> <?= $row['timestamp'] ?> </td>
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
