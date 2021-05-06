<?php

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php");

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true){
    header("location: auth-login.php");
    exit;
}
$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'completed' ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report - Healtopedia Digital</title>
    
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main" style="margin-top: -50px;">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Patient Report</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Request Appointment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['req_custname']; ?></td>
                                            <td><?php echo $row['req_packname']; ?></td>
                                            <td><?php echo $row['req_appdate']; ?></td>
                                            <td><?php echo $row['req_apptime']; ?></td>
                                            <td><?php echo $row['req_status']; ?></td>
                                            <td>
                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">

                                                        <!--input type="text" name="requestid" value="<?php echo $row['request_id']; ?>" style="display: none;"-->

                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload<?php echo $row['request_id']; ?>"><i class="bi bi-cloud-upload"></i></button>

                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#download<?php echo $row['request_id']; ?>"><i class="bi bi-cloud-download"></i></button>

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#patient<?php echo $row['request_id']; ?>"><i class="bi bi-search"></i></button>
                                                    </div>
                                            </td>
                                        </tr>
                            <!--========================================== M O D A L == I N F O =====================================-->
                                        <div class="modal fade text-left" id="patient<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel17">Request Appointment Detail</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label><b>Package Name</b>: <?php echo $row['req_packname']; ?></label>
                                                        <br>
                                                        <label><b>Client Name</b>: <?php echo $row['req_custname']; ?></label>
                                                        <br>
                                                        <label><b>IC/Passport</b>: <?php echo $row['req_custid']; ?></label>
                                                        <br>
                                                        <label><b>No Phone</b>: <?php echo $row['req_custphone']; ?></label>
                                                        <br>
                                                        <label><b>Address</b>: <?php echo $row['req_custaddress']; ?></label>
                                                        <br>
                                                        <label><b>Nationalities</b>: <?php echo $row['req_custnational']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Date</b>: <?php echo $row['req_appdate']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Time</b>: <?php echo $row['req_apptime']; ?></label>
                                                        <br>
                                                        <label><b>Status</b>: <?php echo $row['req_status']; ?></label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <!--========================================== M O D A L == U P L O A D == R E P O R T =====================================-->
                                        <div class="modal fade text-left" id="upload<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Upload Report</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="file" name="fileupload">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Close</span>
                                                            </button>
                                                            <button type="submit" name="requpreport" class="btn btn-primary ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Submit</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            <!--========================================== E N D == O F == M O D A L =====================================-->
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'request-appointment-footer.php';?>