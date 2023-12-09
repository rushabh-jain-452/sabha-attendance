<?php
	// find dept_id from dept_name
	// $result = $con->query("SELECT dept_id FROM tbl_dept WHERE name='$dept_name'");
	// $row = $result->fetch_row();
	// $dept_id = $row[0];

	// Check timezone
	date_default_timezone_set('Asia/Kolkata');
	// date_default_timezone_set('Asia/Calcutta');
	// $timezone = date_default_timezone_get();
	// echo('<script>alert("'.$timezone.'");</script>');


	// Check if today is friday or not
	// date_diff(datetime1, datetime2, absolute)
	$day = date('D');  // Fri
	// $day = date('l');  // Friday

	if(strcmp($day, "Fri") == 0) {    // TODO: Uncomment this if condition
		// check if time between 8:30 and 9:30 / 10:00
		
		// Current date in PHP
		$date = date('Y-m-d');

		include_once('conn.php');
		
		$memberid = $_GET["memberid"];
		$name = $_GET["name"];

		$sql = "INSERT INTO attendance (memberid, date) VALUES ($memberid, '$date')";
		if($con->query($sql)){
			echo('<script>alert("Attendance submitted successfully");</script>');
		}
		else{	
			echo('<script>alert("Attendance already submitted for today");</script>');
			echo 'Error : '.$sql."<br>\n".$con->error;
		}

		// $con->close();
	} 
	// else {
	// 	echo('<script>alert("Today is not Friday");</script>');
	// }

	// Display Records
    $sql = "SELECT * FROM attendance WHERE memberid = $memberid ORDER BY attendanceid DESC LIMIT 52";
	$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Submit</title>
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
                        <th>Date</th>
                        <th>Attendance Timestamp</th>
                    </tr>
					<?php
						while($row = $result->fetch_assoc()) { 
					?>
						<tr>
							<td> <?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('d M Y') ?> </td>
							<td> <?= $row['timestamp'] ?> </td>
						</tr>
					<?php
						}
					?>
                </table>
                <br/><br/>
            </div>
        </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>