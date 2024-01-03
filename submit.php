<?php
	include_once('conn.php');

	// Check timezone
	date_default_timezone_set('Asia/Kolkata');
	// date_default_timezone_set('Asia/Calcutta');
	// $timezone = date_default_timezone_get();
	// echo('<script>alert("'.$timezone.'");</script>');

	$memberid = '';
	if(isset($_GET["memberid"])) {
		$memberid = $_GET["memberid"];
	}

	$name = '';
	if(isset($_GET["name"])) {
		$name = $_GET["name"];
	}

	// Check if member is active
	$sql = "SELECT * FROM member WHERE memberid=$memberid AND active=true";
	$result = $con->query($sql);
	if($result->num_rows < 1){
		$result->free();
		echo '<script>alert("Invalid Member ID");</script>';
		exit();
	}

	// Check if today is friday or not
	// date_diff(datetime1, datetime2, absolute)
	$day = date('D');  // Fri
	// $day = date('l');  // Friday

	// if(strcmp($day, "Fri") == 0) {    // TODO: Uncomment this if condition
		// check if time between 8:30 and 9:30 / 10:00
		
		// Current date in PHP
		$date = date('Y-m-d');

		$sql = "INSERT INTO attendance (memberid, date) VALUES ($memberid, '$date')";
		try {
			if($con->query($sql)){
				echo('<script>alert("Attendance submitted successfully");</script>');
			}
			else{	
				echo('<script>alert("Attendance already submitted for today");</script>');
				echo 'Error : '.$sql."<br>\n".$con->error;
			}
		} catch(Exception $e) {
			echo('<script>alert("Attendance already submitted for today");</script>');
			echo 'Error : '.$sql."<br>\n".$e->getMessage();
		}

		// $con->close();
	// } 
	// else {
	// 	echo('<script>alert("Today is not Friday");</script>');
	// }

	// Display Records
    if($memberid != null) {
		$sql = "SELECT * FROM attendance WHERE memberid = $memberid ORDER BY attendanceid DESC LIMIT 52";
		$result = $con->query($sql);
	}
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
		.table-align-center {
			text-align: center;
		}
	</style>
</head>
<body>
    <!-- <?php echo("Hello World from PHP"); ?> -->
	<!-- <h3>જય સ્વામિનારાયણ 🙏🏻</h3> -->
	<!-- <h3>દાસના દાસ 🙏🏻</h3> -->
	<div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <h4 class="text-center">Attended Sabha</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-success table-bordered table-responsive-md table-sm table-striped align-middle table-align-center">
                    <tr>
                        <th class="text-center">Date</th>
                        <!-- <th class="text-center">Attendance Timestamp</th> -->
						<th class="text-center">Time</th>
                    </tr>
					<?php
					if(isset($result)) {
						while($row = $result->fetch_assoc()) { 
							// $dateStr = $row['timestamp'];
							// $t = strtotime($dateStr);
							$datetime = new DateTime($row['timestamp']);
							$datetime->add(new DateInterval('PT10H30M'));
					?>
						<tr>
							<td> <?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('d M Y') ?> </td>
							<!-- <td> <?= $row['timestamp'] ?> </td> -->
							<!-- <td> <?= $datetime->format('Y-m-d H:i:s') ?> </td> -->
							<!-- <td> <?= $datetime->format('H:i') ?> </td> -->
							<td> <?= $datetime->format('g:i A') ?> </td>
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
            </div>
        </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>