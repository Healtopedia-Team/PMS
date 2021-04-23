<?php

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");

if (isset($_POST['submit'])) {

    //=========================== D A T E ================================//
    $date = date('m/d/Y', strtotime($_POST['date']));

    //=========================== T I M E ================================//
    $time = $_POST['time'];
    $time1 = $_POST['time1'];
    $time2 = $_POST['time2'];
    $time3 = $_POST['time3'];
    $time4 = $_POST['time4'];
    $time5 = $_POST['time5'];
    $time6 = $_POST['time6'];
    $time7 = $_POST['time7'];
    $time8 = $_POST['time8'];
    $time9 = $_POST['time9'];
    $time10 = $_POST['time10'];
    $time11 = $_POST['time11'];
    $time12 = $_POST['time12'];

    //=========================== S T A T U S ==============================//
    $dtime = $_POST['dtime'];
    $dtime1 = $_POST['dtime1'];
    $dtime2 = $_POST['dtime2'];
    $dtime3 = $_POST['dtime3'];
    $dtime4 = $_POST['dtime4'];
    $dtime5 = $_POST['dtime5'];
    $dtime6 = $_POST['dtime6'];
    $dtime7 = $_POST['dtime7'];
    $dtime8 = $_POST['dtime8'];
    $dtime9 = $_POST['dtime9'];
    $dtime10 = $_POST['dtime10'];
    $dtime11 = $_POST['dtime11'];
    $dtime12 = $_POST['dtime12'];

    //=========================== L I M I T ==============================//
    $limit = $_POST['limit'];
    $limit1 = $_POST['limit1'];
    $limit2 = $_POST['limit2'];
    $limit3 = $_POST['limit3'];
    $limit4 = $_POST['limit4'];
    $limit5 = $_POST['limit5'];
    $limit6 = $_POST['limit6'];
    $limit7 = $_POST['limit7'];
    $limit8 = $_POST['limit8'];
    $limit9 = $_POST['limit9'];
    $limit10 = $_POST['limit10'];
    $limit11 = $_POST['limit11'];
    $limit12 = $_POST['limit12'];

    $sql = "INSERT INTO xtime(timedisdate,timedisable,timeonoff,totalappoint,limitapp) VALUES('$date','$time','$dtime','0','$limit'),('$date','$time1','$dtime1','0','$limit1'),('$date','$time2','$dtime2','0','$limit2'),('$date','$time3','$dtime3','0','$limit4'),('$date','$time4','$dtime4','0','$limit4'),('$date','$time5','$dtime5','0','$limit5'),('$date','$time6','$dtime6','0','$limit6'),('$date','$time7','$dtime7','0','$limit7'),('$date','$time8','$dtime8','0','$limit8'),('$date','$time9','$dtime9','0','$limit9'),('$date','$time10','$dtime10','0','$limit10'),('$date','$time11','$dtime11','0','$limit11'),('$date','$time12','$dtime12','0','$limit12')";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Successfully close time slot");</script>';
    }
}

if (isset($_POST['deletetime'])) {
    
    $deletetime = $_POST['deletetime'];

    $sql = "DELETE FROM xtime WHERE timedisdate = '$deletetime'";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Success delete closed time");</script>';
    }
}

//=============================== C A L L === D A T A === S L O T === O F F ================================//
$result=mysqli_query($conn, "SELECT id,timedisdate, GROUP_CONCAT(timedisable SEPARATOR ' | ') AS timedisable FROM xtime WHERE timeonoff = 'off' GROUP BY timedisdate");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

//=============================== C A L L === D A T A === S L O T === O N ================================//
$result1=mysqli_query($conn, "SELECT id,timedisdate,GROUP_CONCAT(totalappoint SEPARATOR '<br>') AS totalappoint,GROUP_CONCAT(limitapp SEPARATOR '<br>') AS limitapp, GROUP_CONCAT(timedisable SEPARATOR '<br>') AS timedisable FROM xtime WHERE timeonoff = 'on' GROUP BY timedisdate");
$user1=mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
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
                            <h3>Close Slot</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Appointment List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form method="POST" style="width: 650px;text-align: center;">
                                        <label>Select Date:</label><br />
                                        <input type="text" id="date" name="date" class="form-control datepicker" autocomplete="off" placeholder="click here.." required>
                                        <br>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time" checked="true" value="09:00AM" style="display: none;">&nbsp;09:00AM
                                                                </div>
                                                            </div>
                                                            <select name="dtime" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time3" checked="true" value="12:00PM" style="display: none;">&nbsp;12:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime3" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit3" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time10" checked="true" value="07:00PM" style="display: none;">&nbsp;07:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime10" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit10" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time1" checked="true" value="10:00AM" style="display: none;">&nbsp;10:00AM
                                                                </div>
                                                            </div>
                                                            <select name="dtime1" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit1" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time4" checked="true" value="01:00PM" style="display: none;">&nbsp;01:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime4" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit4" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time11" checked="true" value="08:00PM" style="display: none;">&nbsp;08:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime11" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit11" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time2" checked="true" value="11:00AM" style="display: none;">&nbsp;11:00AM
                                                                </div>
                                                            </div>
                                                            <select name="dtime2" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit2" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time5" checked="true" value="02:00PM" style="display: none;">&nbsp;02:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime5" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit5" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time12" checked="true" value="09:00PM" style="display: none;">&nbsp;09:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime12" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit12" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time6" checked="true" value="03:00PM" style="display: none;">&nbsp;03:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime6" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit6" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time7" checked="true" value="04:00PM" style="display: none;">&nbsp;04:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime7" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit7" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time8" checked="true" value="05:00PM" style="display: none;">&nbsp;05:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime8" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                            <input type="text" name="limit8" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="time9" checked="true" value="06:00PM" style="display: none;">&nbsp;06:00PM
                                                                </div>
                                                            </div>
                                                            <select name="dtime9" class="custom-select">
                                                                <option value="On">On</option>
                                                                <option value="Off">Off</option>
                                                            </select>
                                                        <input type="text" name="limit9" class="form-control" value="100">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary">Close Slot</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-bordered" style="text-align: center;">
                                        <tr class="table-info">
                                            <th>DATE</th>
                                            <th>DISABLED TIME</th>
                                            <th>EDIT/DELETE</th>
                                        </tr>
                                        <?php foreach($user as $row): ?>
                                            <form method="POST">
                                                <tr>
                                                    <td><?php echo $row['timedisdate']; ?></td>
                                                    <td><?php echo $row['timedisable']; ?></td>
                                                    <td>
                                                        <button type="submit" name="deletetime" class="btn btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                            <input type="text" name="deletetime" value="<?php echo $row['timedisdate']; ?>" style="display: none;">
                                                        </button>
                                            </form>
                                                        <a href='manage-time-edit.php?date=<?php echo $row['timedisdate']; ?>'><button class="btn btn-info"><i class="bi bi-pencil-square"></i></button></a>
                                                    </td>
                                                </tr>
                                        <?php endforeach; ?>
                                    </table>
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

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");

$result=mysqli_query($conn, "SELECT datedisable FROM xdate");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<script>
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
</script>

</html>
