<?php
    // session_start();
    if(isset($_POST['btnSubmit'])){
        include_once('conn.php');
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];

        // $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' AND active=true";
        $sql = "SELECT * FROM admin WHERE username='$username' AND active=true";

        $result = $con->query($sql);
        $con->close();
        if($result->num_rows == 1){
            session_start();
            // $row = $result->fetch_row();
            $row = $result->fetch_assoc();

            // echo(md5($password));

            if(md5($password) == $row['password']) {
                // echo '<script>alert("Correct Password");</script>';
                // var_dump($row);
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['mandal'] = $row['mandal'];
                // echo $row['username'];
                // echo(md5($password));
                // exit();
                $result->free();
                header('location:home.php');
                exit();
            } else {
                $result->free();
                echo '<script>alert("Invalid Password");</script>';
            }
        }else{
            $result->free();
            echo '<script>alert("Invalid Username");</script>';
            // echo 'Invalid username or password';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabha Attendance Management System - Login</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- <?php
        if(isset($password)) {
            echo(md5($password));
        }
    ?> -->
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3 bg-primary">
                <img src="images/sha_logo.png" alt="Shri Hari Ashram" class="mx-auto d-block" />
                <br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h1 class="text-center"><u>Sabha Attendance Management System</u></h1>
                <br/>
                <h3 class="text-center"><u>Login Credentials</u></h3>
                <br/><br/>
            </div>
        </div>
        <form method="POST" action="#" class="pt-4">
            <div class="form-group row">
                <label for="txtUsername" class="col-md-1 offset-3 col-form-label">Username</label>
                <div class="col-md-4">
                    <input type="text" name="txtUsername" id="txtUsername" class="form-control" required>
                </div>
            </div>
            <br/>
            <div class="form-group row">
                <label for="txtPassword" class="col-md-1 offset-3 col-form-label">Password</label>
                <div class="col-md-4">
                    <input type="password" name="txtPassword" id="txtPassword" class="form-control" required>
                </div>
            </div>
            <br/>
            <div class="form-group row">
                <div class="col-md-4 offset-4">
                    <input type="submit" class="btn btn-primary btn-block btn-lg" name="btnSubmit" value="Login">
                </div>
            </div>
        </form>
        <!-- <hr/>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="login.php">
                    <div class="mb-3 row">
                        <label for="txtUsername" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtUsername" name="txtUsername">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="txtPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="txtPassword">
                        </div>
                    </div>
                    <div class="mb-3 offset-md-2 row">
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <hr />
            </div>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>