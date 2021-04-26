<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true){
    header("location: auth-login.php");
    exit;
}

error_reporting(0);
$edittime = $_GET['date'];

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

    //=========================== S T A T U S    O N / O F F ==============================//
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

    $sql = "DELETE FROM xtime WHERE timedisdate = '$date'";

    if (mysqli_query($conn,$sql)) {

        $sql2 = "INSERT INTO xtime(timedisdate,timedisable,timeonoff,totalappoint,limitapp) VALUES('$date','$time','$dtime','0','$limit'),('$date','$time1','$dtime1','0','$limit1'),('$date','$time2','$dtime2','0','$limit2'),('$date','$time3','$dtime3','0','$limit4'),('$date','$time4','$dtime4','0','$limit4'),('$date','$time5','$dtime5','0','$limit5'),('$date','$time6','$dtime6','0','$limit6'),('$date','$time7','$dtime7','0','$limit7'),('$date','$time8','$dtime8','0','$limit8'),('$date','$time9','$dtime9','0','$limit9'),('$date','$time10','$dtime10','0','$limit10'),('$date','$time11','$dtime11','0','$limit11'),('$date','$time12','$dtime12','0','$limit12')";

        if(mysqli_query($conn,$sql2)){
            echo "<script>
            alert('Successfully update closed time slot');
            window.location.href='manage-time.php';
            </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting - Patient Management System</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <!--========================== S C R I P T == F O R == D A T E P I C K ==========================-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

    <style>
        body {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
          }
    </style>
</head>

<body>
    <div id="app" style="display: none;">
        <header class="mb-3">
            <nav class="navbar navbar-expand navbar-light ">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600"><?php echo $_SESSION["name"]?></h6>
                                        <p class="mb-0 text-sm text-gray-600"><?php echo $_SESSION["role"]?></p>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Hello, <?php echo $_SESSION["name"]?>!</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

<!--=================================== S E L E C T == D A T E ===============================-->
    <input type="text" id="validate" name="validate" value="<?php echo $userid?>" style="display: none;">
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="card">
                <div class="card-content">
                    <div class="card-body" style="text-align: center;">
                        <div class="content" style="width: 650px;">
                            <div class="alert alert-info" role="alert">
                                <h3>Edit Time - <?php echo $edittime;?></h3>
                            </div>
                            <form method="POST">
                                <input type="text" id="date" name="date" class="form-control datepicker" autocomplete="off" placeholder="click here.." value="<?php echo $_GET['date'];?>" style="display: none;">
                                    <label>Select Date:</label><br />
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
        </div>
    </section>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    </form>

<script src="scripttime.js"></script>

</body>
</html>
