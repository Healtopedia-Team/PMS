<?php $conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Appointment - Healtopedia Digital</title>

    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php' ?>
        <div id="main" style="margin-top: -50px;">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Request Appointment</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Request Appointment</li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Request</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Check Date</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <form method="POST">
                                                <center>
                                                    <div style="width:600px;">
                                                        <input type="text" id="datecheck" name="datecheck" class="form-control datepicker" size="5" style="padding: 8px;" autocomplete="off" placeholder="Please click here..." required>
                                                        <br>
                                                        <button type="submit" name="submitdate" class="btn btn-primary">CHECK TIME SLOT AVAILABLE&nbsp;&nbsp;<i class="bi bi-chevron-double-down"></i></button>
                                                        <br><br>
                                                    </div>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                if (isset($_POST['submitdate'])) {
                    $sql = "DELETE FROM `requestappoint` WHERE req_packname IS NULL";
                    if (mysqli_query($conn, $sql)) {
                        $appdate = date('Y-m-d', strtotime($_POST['datecheck']));
                        $_SESSION['appdate'] = $appdate;
                        $sql2 = "INSERT INTO requestappoint SET req_appdate = '$appdate'";
                        if (mysqli_query($conn, $sql2)) {
                            $last_id = mysqli_insert_id($conn);
                            include 'req-addpatient.php';
                        }
                    } else {
                        echo "Failed";
                    }
                }

                if (isset($_POST['submitinformation'])) {
                    $packname = $_POST['packname'];
                    $name = $_POST['pname'];
                    $passport = $_POST['passport'];
                    $address = $_POST['address'];
                    $phoneno = $_POST['phoneno'];
                    $national = $_POST['national'];
                    $apptime = $_POST['apptime'];
                    $latestid = $_POST['latestid'];

                    $dateapp = $_SESSION['appdate'];
                    $register_name = $_SESSION["name"];
                    $t = time();
                    $current_timestamp = date("Y-m-d H:i", $t);
                    $finalDateD = date('Y-m-d', strtotime($dateapp));
                    $finalDateT = date('H:i', strtotime($apptime));
                    $reservedTime = $finalDateD . ' ' . $finalDateT;
                    $message = 'Inserting...';
                    /*
                    $sql = "UPDATE requestappoint SET req_packname = '$packname', req_custname = '$name', req_custid = '$passport', req_custaddress = '$address', req_custphone = '$phoneno', req_custnational = '$national', req_apptime = '$apptime', req_status = 'pending' WHERE  request_id = '$latestid'";
                    $query = "INSERT INTO notification (`id`, `name`, `type`, `message`, `status`, `date`, `reserved_date`) VALUES (NULL, '$register_name', 'request-appointment', '$message', 'unread', '$current_timestamp', '$reservedTime')";
                    if (mysqli_query($conn, $sql) and mysqli_query($conn, $query)) {
                        echo '<script>
                            alert("Successfully request an appointment !!");
                            </script>';
                    } else {
                        $var_error = mysqli_error($conn);
                        echo '<script>
                            alert($var_error);
                            </script>';
                    }
                    */
                    $sql = "UPDATE requestappoint SET req_packname = ?, req_custname = ?, req_custid = ?, 
                            req_custaddress = ?, req_custphone = ?, req_custnational = ?, 
                            req_apptime = ?, req_status = 'pending' WHERE  request_id = ?";
                    $rqa = $conn->prepare($sql);
                    $rqa->bind_param("sssssssi", $packname, $name, $passport, $address, $phoneno, $national, $apptime, $latestid);

                    $query = "INSERT INTO notification (`id`, `name`, `type`, `message`, `status`, `date`, `reserved_date`) 
                            VALUES (NULL, ?, 'request-appointment', ?, 'unread', ?, ?)";
                    $not = $conn->prepare($query);
                    $not->bind_param("ssss", $register_name, $message, $current_timestamp, $reservedTime);

                    if ($rqa->execute() && $not->execute()) {
                        echo '<script>
                                alert("Successfully request an appointment !!");
                                </script>';
                    } else {
                        $var_error = $rqa->error . " " . $not->error;
                        echo '<script>
                                alert($var_error);
                                </script>';
                    }
                }
                ?>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Healtopedia Digital</p>
                    </div>
                    <div class="float-end">
                        <p>Powered By Atiq hehehe ;)<span class="text-danger"><i class="bi bi-heart"></i></span></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="scripttime.js"></script>
    <script src='script.js'></script>

    <?php
    /*
    $result=mysqli_query($conn, "SELECT datedisable FROM xdate");
    $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
    */

    $result = $conn->prepare("SELECT datedisable FROM xdate");
    $result->execute();
    $user = $result->get_result()->fetch_all(MYSQLI_ASSOC);
    ?>
    <script type="text/javascript">
        var disableDates = [<?php foreach ($user as $row) {
                                echo "'" . $row['datedisable'] . "'" . ",";
                            } ?>];

        $('.datepicker').datepicker({
            startDate: new Date(),
            format: 'mm/dd/yyyy',
            daysOfWeekDisabled: [0, 6],
            beforeShowDay: function(date) {
                dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                if (disableDates.indexOf(dmy) != -1) {
                    return false;
                } else {
                    return true;
                }
            }
        });
    </script>
</body>

</html>