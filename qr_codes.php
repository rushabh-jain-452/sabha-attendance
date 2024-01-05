<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    $dindoli_qr_link = 'https://drive.google.com/drive/folders/1qsxhfZh5Dj7D9A17qd1znmvXr3uMYHuO?usp=sharing';
    $dindoli_pdf_link = 'https://drive.google.com/file/d/1ljNcqw3U-AQ-7FCttVhpSPcqJRF8EKQa/view?usp=sharing';

    $harinagar_qr_link = 'https://drive.google.com/drive/folders/1eNvBx5Di0pOLaNr_zCDN7Rxh0df_OhwR?usp=sharing';
    $harinagar_pdf_link = 'https://drive.google.com/file/d/1ljNcqw3U-AQ-7FCttVhpSPcqJRF8EKQa/view?usp=sharing';  // TODO : change this

    $qr_link = '';
    $pdf_link = '';

    switch ($mandal) {
        case 'Dindoli':
            $qr_link = $dindoli_qr_link;
            $pdf_link = $dindoli_pdf_link;
            break;
        case 'Harinagar':
            $qr_link = $harinagar_qr_link;
            $pdf_link = $harinagar_pdf_link;
            break;
        case 'Navagam':
            $qr_link = $harinagar_qr_link;
            $pdf_link = $harinagar_pdf_link;
            break;
        default:
          //code block
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabha Attendance Management System</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-12 pt-3">
                <a href="home.php">< Go back to Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">0
                <h1 class="text-center"><u>QR Codes of <?= $mandal ?> Mandal</u></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h4 class="text-center"><a href="<?= $qr_link ?>" target="_blank">Display QR Codes</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-3">
                <h4 class="text-center"><a href="<?= $pdf_link ?>" target="_blank">Download QR Codes PDF</a></h4>
            </div>
        </div>
        <br/>
        <br/>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>