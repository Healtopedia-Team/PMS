<?php include 'dbconnect.php';

//get all appointments in range from now(1 hour early) to tomorrow

$result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,appointwoo.appoint_id,appointwoo.start_appoint,appointwoo.statusapp FROM orderwoo LEFT JOIN appointwoo ON orderwoo.order_id=appointwoo.order_id WHERE appointwoo.start_appoint BETWEEN 1618484638 AND 1618574638");
$appointment = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
        <?php include 'sidebar.php'; ?>
        <header class='mb-3'>
            <nav class="navbar navbar-expand navbar-light ">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Mail</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">No new mail</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Notifications</h6>
                                    </li>
                                    <li><a class="dropdown-item">No notification available</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600">John Ducky</h6>
                                        <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="assets/images/faces/1.jpg">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Hello, John!</h6>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                        Settings</a></li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                        Wallet</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main" style="margin-top: -90px;">


            <div class="page-heading">
                <h3>Dashboard
                </h3>
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
                                                <h6 class="font-extrabold mb-0">1</h6>
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
                                                <h6 class="font-extrabold mb-0">12</h6>
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
                                                <h6 class="font-extrabold mb-0">45</h6>
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
                                                <?php foreach ($appointment as $rows) : ?>
                                                    <tr>
                                                        <td class="text-bold-500">
                                                            <strong>#<?php echo $rows['appoint_id']; ?> <?php echo $rows['firstname']; ?> <?php echo $rows['lastname']; ?></strong><br>
                                                            Executive Health Screening (Women)<br>
                                                            <?php 
                                                            
                                                            $times = $rows['start_appoint'];
                                                            $time = date('h:i A', strtotime($time.'-8 hour'));
                                                            echo $time; ?><br>

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
                                                        span class="badge bg-danger">Canceled</span>

                                                        </td>
                                                        <td class="text-bold-500"></td>
                                                    <?php
                                                            }
                                                            else{ ?>
                                                            
                                                            span class="badge bg-warning">Waiting Payment</span>

                                                        </td>
                                                        <td class="text-bold-500"></td>
                                                            <?php

                                                            }
                                                    ?>
                                                    </tr>
                                                <?php endforeach; ?>
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
                                                    <tr>
                                                        <td class="text-bold-500">Basic Health Screening (Male)</td>
                                                        <td class="text-bold-500">12</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Executive Health Screening (Male)</td>
                                                        <td class="text-bold-500">52</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Executive Health Screening (Male)</td>
                                                        <td class="text-bold-500">8</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Executive Health Screening (Male)</td>
                                                        <td class="text-bold-500">12</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Executive Health Screening (Male)</td>
                                                        <td class="text-bold-500">55</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel33" aria-hidden="true">
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
                                    <form action="#">
                                        <div class="modal-body">
                                            <label>Enter Patient I/C : </label>
                                            <div class="form-group">
                                                <input type="text" placeholder="I/C Number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="button" class="btn btn-primary ml-1" data-bs-toggle="modal"
                                                data-bs-target="#warning" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Check-In</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade text-left" id="warning" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel140"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel140">
                                                                        Warning
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Adding patient's I/C Number will make means that the patient with I/C number entered has checked-in for their appointment. Continue?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cancel</span>
                                                                    </button>

                                                                    <button type="button" class="btn btn-warning ml-1"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Yes</span>
                                                                    </button>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
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
