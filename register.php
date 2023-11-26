<?php
    if(isset($_GET["btnSubmit"]) && isset($_GET["txtName"]) && isset($_GET["rdbGender"]) && isset($_GET["dtpBirthDate"]) && isset($_GET["txtMobileNo"]) && isset($_GET["txtAddress"])){
        include_once('conn.php');

        $name = $_GET["txtName"];
        $gender = $_GET["rdbGender"];
        $dob = $_GET["dtpBirthDate"];
        $mobileno = $_GET["txtMobileNo"];
        $address = $_GET["txtAddress"];

        $sql = "INSERT INTO member (name, gender, dob, mobileno, address) VALUES ('$name', '$gender','$dob', '$mobileno', '$address')";
        if($con->query($sql)){
            // echo 'Member registered successfully';
            echo('<script>alert("Member registered successfully");</script>');
        }
        else{	
            echo 'Error : '.$sql."<br>\n".$con->error;
        }
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <!-- Name -->
    <!-- Gender -->
    <!-- DOB -->
    <!-- Mobile no -->
    <!-- Address -->

    <!-- <form>
        <div class="mb-3">
            <label for="txtName" class="form-label">Name</label>
            <input type="text" class="form-control" id="txtName">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> -->

    <!-- Copied Form -->
    <!-- <div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <h1 class="text-center"><u>New Member Registration</u></h1>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-10 offset-2">
                <form method="GET" action="">
                    <div class="form-group row">
                        <label for="txtName" class="col-md-2 col-form-label"><b>Name</b></label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="txtName" id="txtName" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-2"><b>Gender</b></label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="rdbGender" id="Male" value="Male" required>
                                <label for="Male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="rdbGender" id="Female" value="Female" required>
                                <label for="Female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dtpBirthDate" class="col-md-2 col-form-label"><b>Birth Date</b></label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="dtpBirthDate" id="dtpBirthDate" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtMobileNo" class="col-md-2 col-form-label"><b>Mobile No</b></label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="txtMobileNo" id="txtMobileNo" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtAddress" class="col-md-2 col-form-label"><b>Address</b></label>
                        <div class="col-md-7">
                            <textarea class="form-control" id="txtAddress" rows="3"></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-3 offset-2">
                            <input type="submit" class="btn btn-success btn-lg btn-block" name="btnSubmit" value="Register">
                        </div>
                    </div>
                </form>
                <br><br><br><br><br>
            </div>
        </div>
    </div> -->

    <!-- Form with floating labels -->
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <h1 class="text-center"><u>New Member Registration</u></h1>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-12">
                <form method="GET" action="" id="registrationForm">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="txtName" id="txtName" maxlength="50" placeholder="Name" required>
                        <label for="txtName"><b>Name</b></label>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="" class="col-md-2"><b>Gender</b></label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="rdbGender" id="Male" value="M" required>
                                <label for="Male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="rdbGender" id="Female" value="F" required>
                                <label for="Female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dtpBirthDate" class="col-md-2 col-form-label"><b>Birth Date</b></label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="dtpBirthDate" id="dtpBirthDate" required>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="txtMobileNo" class="col-md-2 col-form-label"><b>Mobile No</b></label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="txtMobileNo" id="txtMobileNo" maxlength="10" required>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="txtAddress" class="col-md-2 col-form-label"><b>Address</b></label>
                        <div class="col-md-7">
                            <textarea class="form-control" id="txtAddress" rows="3" form="registrationForm"></textarea>
                        </div>
                    </div> -->
                    <br/>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="txtAddress" id="txtAddress" maxlength="500" placeholder="Address" required>
                        <label for="txtAddress"><b>Address</b></label>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success btn-lg btn-block" name="btnSubmit" value="Register">
                        </div>
                    </div>
                </form>
                <br><br><br><br><br>
            </div>
        </div>
    </div>

    <!-- <?php echo("Welcome to YDS Dindoli Mandal Sabha"); ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->
</body>
</html>