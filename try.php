<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Healtopedia - Dashboard </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dtsel.css" />
    <script src="dtsel.js"></script>
    <style type="text/css">
        @media print {

            #detail,
            #detail * {
                visibility: visible;
            }

            #detail {
                position: absolute;
                left: 0;
                top: 0;
            }

            @page {
                size: 40mm 60mm;
                padding: 0;
                margin: 0;
                border: none;
                border-collapse: collapse;
            }

            #printarea *{
                margin: 0.5mm;
                padding: 0.5mm;
            }

        }
    </style>
</head>

<body>

    <!-- Begin Page Content -->
    <div class="text-center">
        <img src="logo.png" width="250px" height="80px">
        <h1 class="h5 text-gray-900 mb-4">Healtopedia Registration Form</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Queue Management System</h6>
                    </div>
                    <div class="card-body" id="detail">
                        <p><b>Client Details</b></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Queue Number:</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>A011</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>IC Number:</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>991203-91-3733</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Name on IC:</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Hel Dev Rer<h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Gender:</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Male</h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="printqueue" id="printqueue" class="btn btn-primary" onclick="printDiv('printarea')">Print the Queue Number<i class="bi bi-chevron-double-down"></i></button>
                            </div>
                            <div class="col-md-6">
                                <a href="add-apps.php"><button type="submit" name="backtoprevious" class="btn btn-primary">Back to Previous Form<i class="bi bi-chevron-double-down"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="printarea" style="font-weight:bold;max-height:100%; display:none;">
                <h1>A011</h1>
                <h4>Pun Jun Wei</h4>
                <h4>990088776655</h4>
                <h4>Male</h4>
            </div>




        </div>
        <!-- /.container-fluid -->



    </div>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName);
            printContents.style.transform = 'rotate(90deg)';
            //document.getElementById("#detail").style.display = 'none';
            var originalContents = document.body.innerHTML;


            document.body.innerHTML = printContents.innerHTML;

            window.print();

            document.body.innerHTML = originalContents;
        }
        //
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
