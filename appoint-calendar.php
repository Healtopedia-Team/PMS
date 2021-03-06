<?php include 'dbconnect.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}

$date = date('Y-m-d',strtotime("-1 days"));
/*
$sql = mysqli_query($conn, "SELECT * FROM calendar WHERE cal_start > '$date'");
$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$sql2 = mysqli_query($conn, "SELECT * FROM orderwoo");
$result2 = mysqli_fetch_all($sql2, MYSQLI_ASSOC);

$sql3 = mysqli_query($conn, "SELECT * FROM requestappoint");
$result3 = mysqli_fetch_all($sql3, MYSQLI_ASSOC);

$sql4 = mysqli_query($conn, "SELECT * FROM appointwoo");
$result4 = mysqli_fetch_all($sql4, MYSQLI_ASSOC);

$sql5 = mysqli_query($conn, "SELECT * FROM packagewoo");
$result5 = mysqli_fetch_all($sql5, MYSQLI_ASSOC);
*/
$sql1 = $conn->prepare("SELECT * FROM calendar WHERE cal_start > ?");
$sql1->bind_param("s", $date);
$sql1->execute();
$result1 = $sql1->get_result()->fetch_all(MYSQLI_ASSOC);

$sql2 = $conn->prepare("SELECT * FROM orderwoo");
$sql2->execute();
$result2 = $sql2->get_result()->fetch_all(MYSQLI_ASSOC);

$sql3 = $conn->prepare("SELECT * FROM requestappoint");
$sql3->execute();
$result3 = $sql3->get_result()->fetch_all(MYSQLI_ASSOC);

$sql4 = $conn->prepare("SELECT * FROM appointwoo");
$sql4->execute();
$result4 = $sql4->get_result()->fetch_all(MYSQLI_ASSOC);

$sql5 = $conn->prepare("SELECT * FROM packagewoo");
$sql5->execute();
$result5 = $sql5->get_result()->fetch_all(MYSQLI_ASSOC);
/*

$sql2 = $conn->prepare("SELECT * FROM orderwoo");
$sql2->execute();
$result2 = $sql2->get_result()->fetch_all(MYSQLI_ASSOC);

$sql3 = $conn->prepare("SELECT * FROM requestappoint");
$sql3->execute();
$result3 = $sql3->get_result()->fetch_all(MYSQLI_ASSOC);

$sql4 = $conn->prepare("SELECT * FROM appointwoo");
$sql4->execute();
$result4 = $sql4->get_result()->fetch_all(MYSQLI_ASSOC);

$sql5 = $conn->prepare("SELECT * FROM packagewoo");
$sql5->execute();
$result5 = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
*/

if (isset($_POST['updatepms'])) {
    $name = $_POST['calcustomer'];
    $package = $_POST['calname'];
    $time = $_POST['calstart'];
    $newtime = $_POST['caldate']." ".date('H:i', strtotime($_POST['calstart']));
    $newtime2 = $_POST['caldate']." ".date('H:i', strtotime($_POST['calstart'])+3600);
    $pmsid = $_POST['pmsid'];

    $query = "UPDATE requestappoint SET req_custname = '$name', req_apptime = '$time' WHERE request_id = '$pmsid'";
    if (mysqli_query($conn, $query)) {
        $query2 = "UPDATE calendar SET cal_start = '$newtime', cal_end = '$newtime2' WHERE cal_id = '$pmsid'";
        if (mysqli_query($conn, $query2)) {
            header("Location: appoint-calendar.php");
        }
    }
}

$query = mysqli_query($conn,"SELECT package_name FROM packagewoo ORDER BY package_id DESC");
$data = mysqli_fetch_all($query,MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />

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
                //editable:true,
                header:{
                    left:'title',
                    center:'',
                    right:'prev,next today'
                    //right:'agendaWeek,month,agendaDay'
                },
                events: 'loadhealtopedia.php',
                selectable:true,
                selectHelper:true,
                eventClick:function(event){
                    var id = event.id;
                    $('#detailinfo'+id).modal('show');
                },
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
                                <?php foreach ($result1 as $row) { ?>
                                <div class="modal fade" id="detailinfo<?php echo $row['cal_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailinfo">Event Details</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php foreach ($result2 as $row2) {
                                                    if ($row['cal_orderid'] == $row2['order_id']) {?>
                                                        <b>Name : </b><?php echo $row2['firstname']." ".$row2['lastname'];?><br>
                                                        <?php foreach ($result4 as $row4) {
                                                            if ($row['cal_id'] == $row4['appoint_id']) {
                                                                foreach ($result5 as $row5) {
                                                                    if ($row4['prod_id'] == $row5['package_id']) {?>
                                                                        <b>Package : </b><?php echo $row5['package_name'];?><br>
                                                                    
                                                        <?php } }?>
                                                        <b>Time : </b><?php echo date('h:i A',$row4['start_appoint']-28800);?>
                                                <?php } } } }?>
                                                <?php foreach ($result3 as $row3) {
                                                    if ($row['cal_id'] == $row3['request_id']) {?>
                                                        <form method="POST">
                                                            <input type="text" name="pmsid" value="<?php echo $row3['request_id'];?>" style="display: none;">
                                                            <b>Name : </b><input type="text" name="calcustomer" class="form-control" value="<?php echo $row3['req_custname'];?>"><br>
                                                            <b>Package : </b>
                                                            <select class="choices form-select" name="packname" required>
                                                                <option value="<?php echo $row3['req_packname'];?>"><?php echo $row3['req_packname'];?></option>
                                                                <?php foreach($data as $key){ ?>
                                                                    <option value="<?php echo $key['package_name'];?>"><?php echo $key['package_name'];?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                            <b>Time : </b><input type="text" name="calstart" class="form-control" value="<?php echo date('h:iA',strtotime($row['cal_start']));?>">
                                                            <input type="text" name="caldate" class="form-control" value="<?php echo date('Y-m-d',strtotime($row['cal_start']));?>" style="display: none;">
                                                <?php } }?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" name="updatepms" class="btn btn-primary">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Update</span>
                                                </button>
                                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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
