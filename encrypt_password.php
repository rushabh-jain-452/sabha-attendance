<?php
    $encryptedText = '';
    if(isset($_GET['btnEncrypt']) && isset($_GET['txtPassword'])) {
        $password = $_GET['txtPassword'];
        $encryptedText = md5($password);
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
    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .align-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-light">
        <form method="GET" action="" id="searchByDaysForm">
            <br/><br/>
            <div class="row g-3 align-items-center justify-content-center">     
                <div class="col-auto">
                    <label for="txtPassword" class="col-form-label"><b>Password</b></label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="txtPassword" id="txtPassword" />
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="btnEncrypt">Encrypt</button>
                </div>
            </div>
        </form>
        <br />
        <hr />
        <div class="row">
            <div class="col-md-12 pt-3">
                <h3 class="text-center"><?= $encryptedText != '' ? $encryptedText : '' ?></h3>
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