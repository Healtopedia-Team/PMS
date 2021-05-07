<?php
$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "AppsOnsite");
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true){
    header("location: auth-login.php");
    exit;
}

if (isset($_POST['submit'])) {
    
    $date = $_POST['ddate'];
    $date1 = $_POST['ddate1'];
    $date2 = $_POST['ddate2'];
    $date3 = $_POST['ddate3'];
    $date4 = $_POST['ddate4'];

    $sql = "INSERT INTO xdate(datedisable) VALUES('$date'),('$date1'),('$date2'),('$date3'),('$date4')";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Successfully close date");</script>';
    }
}

if (isset($_POST['deletedate'])) {
    
    $deletedate = $_POST['deletedate'];

    $sql = "DELETE FROM xdate WHERE id = '$deletedate'";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Success delete closed data");</script>';
    }
}

$result=mysqli_query($conn, "SELECT * FROM xdate WHERE datedisable != ''");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Patient Management System</title>

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
        <?php include 'sidebar.php'; ?>
        <div id="main" style="margin-top: -50px;">
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
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST">
                                            <label>Date to close :</label>
                                            <input type="text" name="ddate" class="form-control datepicker" autocomplete="off">
                                            <br>
                                            <label>Date to close :</label>
                                            <input type="text" name="ddate1" class="form-control datepicker" autocomplete="off">
                                            <br>
                                            <label>Date to close :</label>
                                            <input type="text" name="ddate2" class="form-control datepicker" autocomplete="off">
                                            <br>
                                            <label>Date to close :</label>
                                            <input type="text" name="ddate3" class="form-control datepicker" autocomplete="off">
                                            <br>
                                            <label>Date to close :</label>
                                            <input type="text" name="ddate4" class="form-control datepicker" autocomplete="off">
                                            <br>
                                            <button type="submit" name="submit" class="btn btn-primary">Close Date</button>
                                        </form>                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table class="table table-striped" style="text-align: center;">
                                            <thead>
                                                <tr class="table-info">
                                                    <th>DISABLED DATE</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($user as $row): ?>
                                                <form method="POST">
                                                <tr>
                                                    <td><?php echo $row['datedisable']; ?></td>
                                                    <td>
                                                        <button type="submit" name="deletedate" class="btn btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                            <input type="text" name="deletedate" value="<?php echo $row['id']; ?>" style="display: none;">
                                                        </button>
                                                    </td>
                                                </tr>
                                                </form>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Launch Modal</button>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="myModalLabel">Modal 1</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form" role="form" id="myForm">
                                    <div class="form-row">
                                        <label for="input1" class="col-lg-2 control-label">URL</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="remoteUrl" name="remoteUrl" value="/render/gPp78HigHH">
                                        </div>
                                    </div>
                                    <div class="form-row py-2">
                                        <div class="col-lg-12 text-right">
                                            <button type="submit" class="btn btn-secondary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="myModalLabel">Modal 2</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                Some other modal here...
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                    </div>
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
<!--====================================== F O R == D A T E == P I C K E R ======================================-->
<?php

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");

$result=mysqli_query($conn, "SELECT datedisable FROM xdate");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<script type="text/javascript">
    var disableDates = [<?php foreach ($user as $row){echo "'".$row['datedisable']."'".",";}?>];
      
    $('.datepicker').datepicker({
        startDate: new Date(),
        format: 'd-m-yyyy',
        daysOfWeekDisabled: [0,6],
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
<!--====================================== S U B M I T ==  M O D A L ======================================-->
<script>
$(function() {
    $("#myForm").on('submit',function(e){
        
        $("#myModal").modal("hide");
        e.preventDefault();
        
        //submit the form
        $.ajax({
            type: "POST",
            url: '/echo',
            data: $(this).serialize(),
            success: function (data) {
                console.log(data.body.remoteUrl);
                
                // add content from another url
                $("#myModal2 .modal-body").load(data.body.remoteUrl);
                
                // open the other modal
                $("#myModal2").modal("show");
            }
      });
        
    });
});
</script>

</html>
