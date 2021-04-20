<?php

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Appointment - Healtopedia Digital</title>
    
    <link rel="stylesheet" type="text/css" href="modalstyle.css">
    
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
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-title">Forms &amp; Tables</li>
                      
                        <li class="sidebar-item active ">
                            <a href="request-appointment.php" class='sidebar-link'>
                                <i class="bi bi-person-check-fill"></i>
                                <span>Request Appointment</span>
                            </a>
                        </li>
                
                        <li class="sidebar-item">
                            <a href="appointment-list-all.php" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Appointment List</span>
                            </a>
                        </li>
                
                        <li class="sidebar-item">
                            <a href="setting.php" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Setting</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

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
                            <input type='button' class='modal-trigger btn btn-success' data-modal-id='modal1' value='NEXT'>
                            <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;z-index: 597;" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                Add Request
                            </button>

                    <!--=================================== S E L E C T == D A T E ===============================-->
                    <form method="POST" name="forminfo">
                                        <div class="modal-wrapper">
                            <section class="modal-window" id="modal1" style="width: 400px;">
                                                <header class="modal-header">
                                                    <h3>CHOOSE DATE</h3>
                                                    <button type="button" class="close-modal-button" aria-label="Close modal window">X</button>
                                                </header>
                                                <div>
                                                    <input type="text" id="date" name="date" class="form-control datepicker" autocomplete="off" placeholder="click here.." required>
                                                    <br>
                                                    <button type="submit" name="submitdate" class="btn btn-info" onclick="myValid()">CHECK TIME SLOT AVAILABILITIES ></button>
                                                    <br><br>
                                                    <?php
                                                    if (isset($_POST['submitdate'])) {
                                                        $appdate=$_POST['date'];

                                                        $result = mysqli_query($conn,"SELECT COUNT(req_appdate) as totalappdate FROM requestappoint WHERE req_appdate = '$appdate'");
                                                        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

                                                        foreach ($data as $row){
                                                            if ($row['totalappdate'] < 50) {?>
                                                                <script type="text/javascript">
                                                                    $(document).ready(function(){
                                                                        $("#modal1").modal("show");
                                                                    });
                                                                </script>
                                                                <?php print "<input type='button' class='modal-trigger btn btn-success' data-modal-id='modal2' value='NEXT'>";
                                                            }else{
                                                                echo "Sorry, the slot for this date is already full";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <br />
                                            </section>
                                        </form>

                    <!--=================================== S E L E C T == T I M E ===============================-->
                                        <form method="POST">   
                                            <section class="modal-window" id="modal2">
                                                <header class="modal-header">
                                                  <h3>PICK TIME</h3>
                                                  <button type="button" class="close-modal-button" aria-label="Close modal window">X</button>
                                                </header>
                                                <div>
                                                  <label>Select Time:</label>
                                                  <p id="demoss"></p>
                                                  <p id="demo"></p>
                                                  <input type="text" id="apptime" name="apptime" class="form-control" style="display: none;">
                                                  <table>
                                                    <thead>
                                                      <tr>
                                                        <th>&nbsp; MORNING &nbsp;<br><br></th>
                                                        <th>&nbsp; AFTERNOON &nbsp;<br><br></th>
                                                        <th>&nbsp; EVENING  &nbsp;<br><br></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <td align="center">
                                                          <input type="button" id="time" class="btn btn-success" value="09:00AM" onclick="myTime()" 
                                                          <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '09:00AM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                          <input type="button" id="time3" class="btn btn-success" value="12:00PM" onclick="myTime3()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '12:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                          <input type="button" id="time10" class="btn btn-success" value="07:00PM" onclick="myTime10()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '07:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td align="center">
                                                            <input type="button" id="time1" class="btn btn-success" value="10:00AM" onclick="myTime1()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '10:00AM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                            <input type="button" id="time4" class="btn btn-success" value="01:00PM" onclick="myTime4()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '01:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                            <input type="button" id="time11" class="btn btn-success" value="08:00PM" onclick="myTime11()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '08:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td align="center">
                                                            <input type="button" id="time2" class="btn btn-success" value="11:00AM" onclick="myTime2()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '11:00AM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                            <input type="button" id="time5" class="btn btn-success" value="02:00PM" onclick="myTime5()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '02:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td align="center">
                                                            <input type="button" id="time12" class="btn btn-success" value="09:00PM" onclick="myTime12()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '09:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td></td>
                                                        <td align="center">
                                                            <input type="button" id="time6" class="btn btn-success" value="03:00PM" onclick="myTime6()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '03:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td></td>
                                                      </tr>
                                                      <tr>
                                                        <td></td>
                                                        <td align="center">
                                                            <input type="button" id="time7" class="btn btn-success" value="04:00PM" onclick="myTime7()"
                                                            <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '04:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td></td>
                                                      </tr>
                                                      <tr>
                                                        <td></td>
                                                        <td align="center">
                                                            <input type="button" id="time8" class="btn btn-success" value="05:00PM" onclick="myTime8()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '05:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td></td>
                                                      </tr>
                                                      <tr>
                                                        <td></td>
                                                        <td align="center">
                                                            <input type="button" id="time9" class="btn btn-success" value="06:00PM" onclick="myTime9()" <?php
                                                            $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '06:00PM'");
                                                            $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            foreach($user as $row){
                                                                if ($row['timeonoff'] == "Off"){ ?>
                                                                disabled
                                                            <?php }} ?>>
                                                        </td>
                                                        <td></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                <br />
                                                <input type="button" class="modal-trigger btn btn-primary" data-modal-id="modal3" value="NEXT">
                                              </section>

                                        <!--=================================== P A T I E N T == I N F O ===============================-->

                                              <section class="modal-window" id="modal3" style="width: 400px;">
                                                <header class="modal-header">
                                                    <h3>YOUR INFORMATION</h3>
                                                    <button type="button" class="close-modal-button" aria-label="Close modal window">X</button>
                                                </header>
                                                <div>
                                                    <input type="text" name="latestid" class="form-control" value="<?php echo $last_id ?>" style="display: none;">

                                                    <label>Full Name:</label>
                                                    <input type="text" name="pname" class="form-control" placeholder="Full name like in IC..." required>

                                                    <label>IC/Passport:</label>
                                                    <input type="text" name="passport" class="form-control" placeholder="IC or passport number..." required>

                                                    <label>Address:</label>
                                                    <input type="text" name="address" class="form-control" placeholder="Your current address..." required>

                                                    <label>Phone No:</label>
                                                    <input type="text" name="phoneno" class="form-control" placeholder="Your phone number..." required>

                                                    <label>Gender:</label>
                                                    <select name="gender" class="custom-select">
                                                        <option value="">Select...</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>

                                                    <label>Birthday Date:</label>
                                                    <input type="date" id="dob" name="dob" class="form-control" autocomplete="off" placeholder="Select date of birth..." required>

                                                    <label>Nationality:</label>
                                                    <select name="national" class="custom-select">
                                                        <option value="">Select...</option>
                                                        <option value="Malaysian">Malaysian</option>
                                                        <option value="Non-Malaysian">Non-Malaysian</option>
                                                    </select>
                                                </div>
                                                <br />
                                                <button type="submit" name="submitbooking" class="btn btn-warning">BOOK NOW</button>
                                            </section>
                                        </div>
                                    </form>

                    <!--============================================ M O D A L == F O R == A D D == R E Q U E S T ==================================================-->

                            <!--div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Request</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form method="POST" action="function.php">
                                            <input type="hidden" name="command" value="REQ_APPOINT">
                                            <div class="modal-body">
                                                <label>Package Name :</label>
                                                <select class="choices form-select" name="reqpackname">
                                                    <option value="">Select package...</option>
                                                    <?php foreach ($data as $row){ ?>
                                                        <option value="<?php echo $row['package_name'];?>">
                                                            <?php echo $row['package_name'];?>
                                                        </option>
                                                    <?php } ?>
                                                </select><br>
                                    
                                                <label>Customer Name :</label>
                                                <input type="text" class="form-control" name="custname"><br>
                                                
                                                <label>Customer ID/Passport :</label>
                                                <input type="text" class="form-control" name="custpassport"><br>
                                                    
                                                <label>Customer Phone :</label>
                                                <input type="text" class="form-control" name="custphone"><br>
                                                    
                                                <label>Customer Address :</label>
                                                <input type="text" class="form-control" name="custaddress"><br>
                                                    
                                                <label>Appointment Date :</label>
                                                <input type="text" class="form-control" name="appdate"><br>
                                                    
                                                <label>Appointment Time :</label>
                                                <input type="text" class="form-control" name="apptime"><br>
                                                    
                                                <label>Status :</label>
                                                <select class="form-select" id="basicSelect" name="reqstatus">
                                                    <option value="pending">Pending</option>
                                                    <option value="complete">Complete</option>
                                                </select><br>
                                                
                                                <button type="submit" name="submitrequest" class="btn btn-primary ml-1" style="position: relative;float: right;z-index: 597;">Submit</button><br><br>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div-->
                    <!--==========================================================================================-->
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
    <script src="scripttime.js"></script>
    <script src='scriptmodal.js'></script>
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
    <?php

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
