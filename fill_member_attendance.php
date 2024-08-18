<?php
    include_once('constants.php');

    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    // Set timezone
	date_default_timezone_set('Asia/Kolkata');

    // get members list
    $sql = "SELECT memberid, name FROM member WHERE mandal='$mandal' AND active=true ORDER BY name";

    $memberResult = $con->query($sql);
    
    $memberid = '';
    $name = '';
    $date = '';
    if(isset($_GET['btnSubmit']) && isset($_GET['member'])) {
        // $arr = str_split($_GET['member']);
        $arr = explode(',', $_GET['member']);

        $memberid = $arr[0];
        $name = $arr[1];

        $date = $_GET['date'];

        // Check if member is active
        $sql = "SELECT * FROM member WHERE memberid=$memberid AND active=true";
        $result = $con->query($sql);
        if($result->num_rows < 1){
            $result->free();
            echo '<script>alert("Invalid Member ID");</script>';
            exit();
        }

		$sql = "INSERT INTO attendance (memberid, date) VALUES ($memberid, '$date')";
		try {
			if($con->query($sql)){
                echo('<script>alert("Attendance submitted successfully for '.$name.'");</script>');
			}
			else{	
				echo('<script>alert("Attendance already submitted for '.$name.' for date '.$date.'");</script>');
				// echo 'Error : '.$sql."<br>\n".$con->error;
			}
		} catch(Exception $e) {
			echo('<script>alert("Attendance already submitted for today");</script>');
			// echo 'Error : '.$sql."<br>\n".$e->getMessage();
		}
    }

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
    <title>Attendance for Member</title>
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
                <h3 class="text-center"><u>Fill Attendance for Member</u></h3>
            </div>
        </div>
        <form method="GET" action="" id="searchByMemberForm">
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label"><b>Date</b></label>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="member" class="col-md-2 col-form-label"><b>Name</b></label>
                <div class="col-md-3">
                    <select name="member" class="form-select" id="member">
                        <?php
                            while($row = $memberResult->fetch_assoc()) { 
                        ?>
                            <option value="<?= $row['memberid'].','.$row['name'] ?>" <?= $memberid == $row['memberid'] ? 'selected' : '' ?>> <?= $row['name'] ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <br/>
                </div>
            </div>
            <div class="form-group row offset-2">
                <div class="col-md-3">
                    <br/>
                    <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
                </div>
            </div>
        </form>
        <hr/>
        <div class="row">
            <div class="col-md-12">
            <div class="row g-3 align-items-center justify-content-center">
			<div class="col-auto">
				<br/>
				<h3>
					<!-- <b>Name : </b>  -->
					<?= $name ?>
				</h3>
			</div>
		</div>
		<hr/>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h4 class="text-center">Attended <?= isset($result) ? $result -> num_rows : 0 ?> Sabha</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-light table-bordered table-responsive-md table-sm table-striped align-middle table-align-center">
                    <tr class="table-primary">
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
							// $datetime->add(new DateInterval('PT10H30M'));
                            $datetime->add(new DateInterval('TIME_DIFFERENCE'));
					?>
						<tr>
							<td class="text-center"> <?= DateTime::createFromFormat('Y-m-d', $row['date'])->format('d M Y') ?> </td>
							<!-- <td> <?= $row['timestamp'] ?> </td> -->
							<!-- <td> <?= $datetime->format('Y-m-d H:i:s') ?> </td> -->
							<!-- <td> <?= $datetime->format('H:i') ?> </td> -->
							<td class="text-center"> <?= $datetime->format('g:i A') ?> </td>
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
				<br/>
				<br/>
            </div>
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
