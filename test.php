<?php

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$result = mysqli_query($conn, "SELECT package_name FROM packagewoo");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                                <button type="button" class="btn btn-outline-primary">All</button>
                                <button type="button" class="btn btn-outline-primary">Approved</button>
                                <button type="button" class="btn btn-outline-primary">Pending</button>
                                <button type="button" class="btn btn-outline-primary">Postponed</button>
                            </div>
                            <a href="request-addappoint.php">
                                <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;z-index: 597;">
                                    Add Request
                                </button>
                            </a>

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
                                    <tr>
                                        <td>Deanna Tan</td>
                                        <td>Executive Health Screening (Women)</td>
                                        <td>12/5/2021</td>
                                        <td>12:00PM</td>
                                        <td>Approved</td>
                                        <td>
                                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                <button class="btn btn-warning"><i class="bi bi-calendar3-week"></i></button>
                                                <button class="btn btn-info"><i class="bi bi-search"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Selvendran Baskaran</td>
                                        <td>Basic Health Screening (Men)</td>
                                        <td>22/5/2021</td>
                                        <td>04:00PM</td>
                                        <td>Pending</td>
                                        <td>
                                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                <button class="btn btn-warning"><i class="bi bi-calendar3-week"></i></button>
                                                <button class="btn btn-info"><i class="bi bi-search"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Muaz</td>
                                        <td>Mental Health Screening</td>
                                        <td>5/5/2021</td>
                                        <td>09:00AM</td>
                                        <td>Postponed</td>
                                        <td>
                                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                <button class="btn btn-warning"><i class="bi bi-calendar3-week"></i></button>
                                                <button class="btn btn-info"><i class="bi bi-search"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </section>
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
</body>
</html>
