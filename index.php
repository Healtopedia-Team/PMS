<?php include 'dbconnect.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}

//get all appointments in range from now(1 hour early) to tomorrow
$timestamp = strtotime('today midnight +8 hour');
$timestamp2 = strtotime('tomorrow midnight +8 hour');


$result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,appointwoo.appoint_id,appointwoo.start_appoint,appointwoo.statusapp,appointwoo.packagename FROM orderwoo LEFT JOIN appointwoo ON orderwoo.order_id=appointwoo.order_id WHERE appointwoo.start_appoint BETWEEN '$timestamp' AND '$timestamp2'");
$appointment = mysqli_fetch_all($result, MYSQLI_ASSOC);
$hosp = $_SESSION["hospital"];
$result2 = mysqli_query($conn, "SELECT packagename, COUNT(*) FROM appointwoo WHERE hospname='$hosp' GROUP BY packagename ORDER BY 2 DESC");
$hospital_list = mysqli_fetch_all($result2, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Patient Management System</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php include 'sidebar-test.php'; ?>

        <div id="main" style="margin-top: -90px;">


            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="section">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Request In-Waiting</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                    $res = mysqli_query($conn, "SELECT COUNT(request_id) as cnt FROM requestappoint WHERE req_status='pending'");
                                                    $req_in_wait = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                                    echo $req_in_wait['cnt'];
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Appointments This Week</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                    $res1 = mysqli_query($conn, "SELECT COUNT(id) as cnt FROM appointwoo WHERE statusapp='paid'");
                                                    $appointment_this_week = mysqli_fetch_all($res1, MYSQLI_ASSOC);
                                                    echo $appointment_this_week['cnt'];
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Completed Appointments</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                    $res2 = mysqli_query($conn, "SELECT COUNT(id) as cnt FROM appointwoo WHERE statusapp='complete'");
                                                    $complete_appointments = mysqli_fetch_all($res2, MYSQLI_ASSOC);
                                                    echo $complete_appointments['cnt'];
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Monthly Revenue</h6>
                                                <h6 class="font-extrabold mb-0">RM112.38</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="doc.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="table-responsive" style="overflow-y:auto; height:310px;">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Today's Appointment &nbsp;<a href="appointment-list-all.php" class="btn rounded-pill btn-sm btn-outline-primary">View
                                                            All</a> </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    foreach ($appointment as $rows) : ?>
                                                        <tr>
                                                            <td class="text-bold-500">
                                                                <strong>#<?php echo $rows['appoint_id']; ?> <?php echo $rows['firstname']; ?> <?php echo $rows['lastname']; ?></strong><br>

                                                                <?php echo $rows['packagename']; ?><br>
                                                                <?php
                                                                $atime = strtotime('-8 hour', $rows['start_appoint']);
                                                                echo date('h:i A', $atime); ?><br>

                                                                <?php

                                                                $status = $rows['statusapp'];
                                                                if ($status == "paid") {
                                                                ?>
                                                                    <span class="badge bg-primary">Booked</span>

                                                            </td>
                                                            <td class="text-bold-500"> <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                                                    Check-In
                                                                </button></td>
                                                        <?php } elseif ($status == "complete") {
                                                        ?>
                                                            <span class="badge bg-success">Checked-In</span>

                                                            </td>
                                                            <td class="text-bold-500"><button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                                                    Check-In
                                                                </button></td>
                                                        <?php
                                                                } elseif ($status == "cancelled") { ?>
                                                            <span class="badge bg-danger">Canceled</span>

                                                            </td>
                                                            <td class="text-bold-500"></td>
                                                        <?php
                                                                } else { ?>

                                                            <span class="badge bg-warning">Waiting Payment</span>

                                                            </td>
                                                            <td class="text-bold-500"> <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                                                    Pay Now
                                                                </button></td>
                                                        <?php

                                                                }
                                                        ?>
                                                        </tr>
                                                    <?php endforeach;
                                                } else { ?>

                                                    <tr>
                                                        <td>No appointments today</td>
                                                    </tr>


                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Weekly Appointment List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Product Overview</h4>
                                    </div>
                                    <div class="table-responsive" style="overflow-y:auto; height:338px;">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($hospital_list as $rows) : ?>
                                                    <tr>
                                                        <?php $package_name = preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/', '', $rows['packagename']); ?>
                                                        <td class="text-bold-500"><?php echo $package_name; ?></td>
                                                        <td class="text-bold-500"><?php echo $rows['COUNT(*)']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel160">
                                        Patient Check-In Authorization
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="function.php" method="POST">
                                    <div class="modal-body">
                                        <label>Enter Patient I/C : </label>
                                        <div class="form-group">
                                            <input type="text" placeholder="I/C Number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" data-bs-toggle="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Check-In</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Logout Confirmation
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Select "Logout" below if you are ready to end your current session.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <a class="btn btn-primary ml-1" href="auth-logout.php">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>