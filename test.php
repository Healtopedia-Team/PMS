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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
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
                                    <li class="breadcrumb-item active" aria-current="page">Add Request</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                            <section id="basic-horizontal-layouts">
                                <div class="row match-height">
                                    <div class="col-md-6 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Check Date</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form class="form form-horizontal">
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <form action="function.php" method="POST">
                                                                    <div>
                                                                        <input type="text" id="datecheck" name="datecheck" class="form-control datepicker" size="5" autocomplete="off" placeholder="click here.." required>
                                                                        <br>
                                                                        <button type="submit" name="submitdate" class="btn btn-primary">CHECK TIME SLOT AVAILABILITIES ></button>
                                                                        <br><br>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                                <!--div class="col-md-6 col-12" style="display: none;">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Horizontal Form with Icons</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-horizontal">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label>Name</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="form-group has-icon-left">
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control"
                                                                                            placeholder="Name" id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-person"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label>Email</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="form-group has-icon-left">
                                                                                    <div class="position-relative">
                                                                                        <input type="email" class="form-control"
                                                                                            placeholder="Email" id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-envelope"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label>Mobile</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="form-group has-icon-left">
                                                                                    <div class="position-relative">
                                                                                        <input type="number" class="form-control"
                                                                                            placeholder="Mobile">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-phone"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label>Password</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="form-group has-icon-left">
                                                                                    <div class="position-relative">
                                                                                        <input type="password" class="form-control"
                                                                                            placeholder="Password">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-lock"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-8 offset-md-4">
                                                                                <div class='form-check'>
                                                                                    <div class="checkbox">
                                                                                        <input type="checkbox" id="checkbox2"
                                                                                            class='form-check-input' checked>
                                                                                        <label for="checkbox2">Remember Me</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 d-flex justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                                                <button type="reset"
                                                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div-->

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

    <script src="scripttime.js"></script>
    <script src='script.js'></script>

    <?php
    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
    $result=mysqli_query($conn, "SELECT datedisable FROM xdate");
    $user=mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>
    <script type="text/javascript">
        var disableDates = [<?php foreach ($user as $row){echo "'".$row['datedisable']."'".",";}?>];
          
        $('.datepicker').datepicker({
            startDate: new Date(),
            format: 'mm/dd/yyyy',
            beforeShowDay: function(date){
                dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                if(disableDates.indexOf(dmy) != -1){
                    return false;
                }
                else{
                    return true;
                }
            }
        });

        $('.dateappoint').datepicker({
            startDate: new Date(),
            format: 'mm/dd/yyyy',
            beforeShowDay: function(date){
                dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
            }
        });
    </script>
</body>
</html>
