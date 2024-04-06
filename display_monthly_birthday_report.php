<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    $month = date('m');

    if (isset($_GET['month'])) {
        $month = $_GET['month'];
    }

    $sql = "SELECT memberid, name, gender, dob, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS my_age, mobileno, address, active FROM member WHERE MONTH(dob) = $month AND mandal='$mandal' AND active=true ORDER BY DAY(dob)";

    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Sabha Attendance Management System</title> -->
    <title>
        <?= $months[$month-1] ?> - Birthdays
    </title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <a href="home.php">
                    < Go back to Home</a>
            </div>
        </div>

        <form method="GET" action="" id="searchByMonthForm">
            <div class="row g-3 align-items-center justify-content-center">
                <div class="col-auto">
                    <label for="month" class="col-form-label"><b>Select Month</b></label>
                </div>
                <div class="col-auto">
                    <select name="month" class="form-select" id="month">
                        <?php
                            for($i=1; $i <= sizeof($months); $i++) {
                                echo('<option value="'.$i.'" '.($month==$i?'selected':'').'>'.$months[$i-1].'</option>');
                            }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="btnSearch">Search</button>
                </div>
            </div>
        </form>
        <!-- <br /> -->
        <hr />
        <div class="row">
            <div class="col-md-12 pt-3">
                <h3 class="text-center"><u>Members of <?= $mandal ?> Mandal having birthday in <b><?= $months[$month-1] ?></b> Month</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">Total number of Members :<?= isset($result) ? $result->num_rows : 0 ?></h5>
                <table class="table table-bordered table-striped table-responsive-md table-sm align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <!-- <th class="text-center">Gender</th> -->
                            <th class="text-center">Birth date</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Mobile No</th>
                            <th class="text-center">Address</th>
                            <!-- <th class="text-center">Active</th>
                            <th class="text-center">Action</th> -->
                            <th class="text-center">View Details</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($result)) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr class="<?= $row['active'] == 0 ? 'table-danger' : '' ?>">
                                <td class="text-center">
                                    <?= $row['memberid'] ?>
                                </td>
                                <td>
                                    <?= $row['name'] ?>
                                </td>
                                <!-- <td> <?= $row['gender'] ?> </td> -->
                                <td class="text-center">
                                    <?= DateTime::createFromFormat('Y-m-d', $row['dob'])->format('d M Y') ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['my_age'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['mobileno'] ?>
                                </td>
                                <td>
                                    <?= $row['address'] ?>
                                </td>
                                <!-- <td class="text-center">
                                    <?= $row['active'] == 1 ? "Yes" : "No" ?>
                                </td>
                                <td class="text-center"><a
                                        href="display_members_not_attending_sabha.php?memberid=<?= $row['memberid'] ?>&action=<?= $row['active'] == 1 ? 0 : 1 ?>&days=<?= $days ?>"
                                        class="btn btn-sm btn-primary">
                                        <?= $row['active'] == 1 ? 'Deactivate' : 'Activate' ?>
                                    </a></td> -->
                                    <td class="text-center">
                                <a href="member_details.php?memberid=<?= $row['memberid'] ?>" class="btn btn-sm btn-primary" title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </td>
                            </tr>
                            <?php
                        }
                        $con->close();
                    }
                    ?>
                </table>
                <br />
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/dateFunctions.js"></script>
    <script>
        const spanElement = document.getElementById('reportDate');
        spanElement.innerText = getFormattedDate();
    </script>
</body>

</html>