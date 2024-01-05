<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("location:login.php");
        exit();
    }
    $username = $_SESSION["username"];
    $mandal = $_SESSION["mandal"];

    include_once('conn.php');

    $startAge = 1;
    $endAge = 30;

    if (isset($_GET['startAge']) && isset($_GET['endAge'])) {
        $startAge = $_GET['startAge'];
        $endAge = $_GET['endAge'];
    }

    $sql = "SELECT memberid, name, gender, dob, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS my_age, mobileno, address, active FROM member WHERE (TIMESTAMPDIFF(YEAR, dob, CURDATE())) BETWEEN $startAge AND $endAge AND mandal='$mandal' AND active=true ORDER BY my_age";

    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members of<?php echo ($mandal) ?> Mandal</title>
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

        <form method="GET" action="" id="searchByDaysForm">
            <div class="row g-3 align-items-center justify-content-center">
                <div class="col-auto">
                    <label for="startAge" class="col-form-label"><b>Age between</b></label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control col-md-1" name="startAge" id="startAge" value="<?= $startAge ?>" required>
                </div>
                <div class="col-auto">
                    <label for="days" class="col-form-label"><b>and</b></label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control col-md-1" name="endAge" id="endAge" value="<?= $endAge ?>" required>
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
                <h3 class="text-center"><u>Members of <?= $mandal ?> Mandal of age between <?= $startAge ?> and <?= $endAge ?> Years</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">Total number of Members :
                    <?= isset($result) ? $result->num_rows : 0 ?>
                </h5>
                <table class="table table-bordered table-responsive-md table-sm align-middle">
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
                <br />
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>