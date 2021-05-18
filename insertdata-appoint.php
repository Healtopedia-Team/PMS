<?php include 'dbconnect.php';

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
    <title>Calendar - Patient Management System</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Added for the notification system use-->

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'agendaWeek,month,agendaDay'
                },
                events: 'load.php',
                selectable:true,
                selectHelper:true,
                eventClick:function(event)
                {
                  var title = event.title;
                  $('#detailinfo').modal('show');
                }
            });
        });
    </script>
</head>
<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>

        <div id="main" style="margin-top: -40px;">
            <div class="page-content">
                <section class="row">
                    <div class="section">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                                <div class="modal fade" id="detailinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Event Name</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Event detail here......
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Accept</span>
                                                </button>
                                            </div>
                                        </div>
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
<?php
    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    $data = file_get_contents('https://pms.healtopedia.com/slotjson.php');
    $data = json_decode($data, true);

    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    foreach ( $data as $row ) {
        foreach ( $data2 as $row2 ) {
            if ($row2['id'] == $row['product_id']) {
                $orderid = $row['order_id'];
                $appointid = $row['id'];
                $statusapp = $row['status'];
                $prodid = $row2['id'];
                $packagename = $row2['name'];
                $startappoint = $row['start'];
                $endappoint = $row['end'];
                                
                $result=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
                $user=mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($user as $key) {
                    if ($key['Total'] < 1) {
                        $sql = " INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid', statusapp = '$statusapp', start_appoint = '$startappoint', end_appoint = '$endappoint', prod_id = '$prodid', pack_name = ''$packagename";

                        mysqli_query($conn, $sql);
                    }
                }

                /*$start = date('Y-m-d H:i',$row['start']);
                $end = date('Y-m-d H:i',$row['end']);
                $sql2 = "INSERT INTO calendar SET event_title = '$packagename', start_event = '$start', end_event = '$end'";

                mysqli_query($conn, $sql2);*/
            }
        }
    }
?>
