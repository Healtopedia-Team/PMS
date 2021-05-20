<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner - Check In</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 order-md-1 order-last">
                        <center><h3>QR Scanner</h3></center>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <label class="disp-blck">Scan QR to check-in</label>
                            </div>
                            <div class="card-body">
                                <video id="webcameraPreview" playsinline style="width: 100%;"></video>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="qrscanner/adapter.min.js"></script>
    <script type="text/javascript" src="qrscanner/instascan.js"></script>
    <script type="text/javascript" src="qrscanner/QrCodeScanner.js"></script>
    <script type="text/javascript">
        //HTML video component for web camera
        var videoComponent = $("#webcameraPreview");
        //HTML select component for cameras change
        var webcameraChanger = $("#webcameraChanger");
        var options = {};
        //init options for scanner
        options = initVideoObjectOptions("webcameraPreview");
        var cameraId = 1;

        initScanner(options);

        initAvaliableCameras(
            webcameraChanger,
            function () {
                cameraId = parseInt(getSelectedCamera(webcameraChanger));
            }
        );

        initCamera(cameraId);


        scanStart(function (data){
            window.location.href = data;
        });

    </script>
</body>

</html>
