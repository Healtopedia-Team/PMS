<?php

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php"); 
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
        <?php include 'sidebar.php'?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

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
                            </script>
