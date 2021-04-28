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

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>
<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <header class="mb-3">
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
                                        <h6 class="mb-0 text-gray-600"><?php echo $_SESSION["name"]?></h6>
                                        <p class="mb-0 text-sm text-gray-600"><?php echo $_SESSION["role"]?></p>
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
                                    <h6 class="dropdown-header">Hello, <?php echo $_SESSION["name"]?>!</h6>
                                </li>
                                <li><a class="dropdown-item" href="user-profile.php"><i class="icon-mid bi bi-person me-2"></i>Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
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
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group mb-4" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary <?php if ($your_variable=="request-appointment-all") {echo "active"; }else{echo"noactive";}?>" onclick="requestall()">All</button>
                                <button type="button" class="btn btn-outline-primary <?php if ($your_variable=="request-appointment-approved") {echo "active"; }else{echo"noactive";}?>" onclick="requestapproved()">Approved</button>
                                <button type="button" class="btn btn-outline-primary <?php if ($your_variable=="request-appointment-pending") {echo "active"; }else{echo"noactive";}?>" onclick="requestpending()">Pending</button>
                                <button type="button" class="btn btn-outline-primary <?php if ($your_variable=="request-appointment-postponed") {echo "active"; }else{echo"noactive";}?>" onclick="requestpostponed()">Postponed</button>
                                <button type="button" class="btn btn-outline-primary <?php if ($your_variable=="request-appointment-rejected") {echo "active"; }else{echo"noactive";}?>" onclick="requestrejected()">Rejected</button>
                            </div>
                            <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;z-index: 597;" onclick="addappoint()">
                                Add Request
                            </button>
                            <script>
                                function requestall(){
                                     window.location.href="https://pms.healtopedia.com/request-appointment-all.php";
                                }
                                function requestapproved(){
                                     window.location.href="https://pms.healtopedia.com/request-appointment-approved.php";
                                }
                                function requestpending(){
                                     window.location.href="https://pms.healtopedia.com/request-appointment-pending.php";
                                }
                                function requestpostponed(){
                                     window.location.href="https://pms.healtopedia.com/request-appointment-postponed.php";
                                }
                                function addappoint(){
                                     window.location.href="https://pms.healtopedia.com/request-addappoint.php";
                                }
                                function requestrejected(){
                                     window.location.href="https://pms.healtopedia.com/request-appointment-rejected.php";
                                }
                            </script>
