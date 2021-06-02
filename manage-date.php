<?php
$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}

if (isset($_POST['submit'])) {

    $date = $_POST['ddate'];
    $date1 = $_POST['ddate1'];
    $date2 = $_POST['ddate2'];
    $date3 = $_POST['ddate3'];
    $date4 = $_POST['ddate4'];

    /*
    $sql = "INSERT INTO xdate(datedisable) VALUES('$date'),('$date1'),('$date2'),('$date3'),('$date4')";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Successfully close date");</script>';
    }
    */

    $sql = $conn->prepare("INSERT INTO xdate(datedisable) VALUES(?),(?),(?),(?),(?) ");
    $sql->bind_param("sssss", $date, $date1, $date2, $date3, $date4);
    if ($sql->execute()) {
        echo '<script>alert("Successfully close date");</script>';
    }
}

if (isset($_POST['deletedate'])) {

    $deletedate = $_POST['deletedate'];
    /*
    $sql = "DELETE FROM xdate WHERE id = '$deletedate'";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Success delete closed data");</script>';
    }
    */
    $sql = $conn->prepare("DELETE FROM xdate WHERE id = ? ");
    $sql->bind_param("i", $deletedate);
    if ($sql->execute()) {
        echo '<script>alert("Success delete closed data");</script>';
    }
}
/*
$result=mysqli_query($conn, "SELECT * FROM xdate WHERE datedisable != ''");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);
*/
$result = $conn->prepare("SELECT * FROM xdate WHERE datedisable != ''");
$result->execute();
$user = $result->get_result()->fetch_all(MYSQLI_ASSOC);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                                    <li class="breadcrumb-item active" aria-current="page">Request Appointment</li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Date</li>
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
                                                <?php foreach ($user as $row) : ?>
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
    <script src="assets/js/main.js"></script>
</body>
<?php
/*
$result=mysqli_query($conn, "SELECT datedisable FROM xdate");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);
*/
$result = $conn->prepare("SELECT datedisable FROM xdate");
$result->execute();
$user = $result->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<script type="text/javascript">
    var disableDates = [<?php foreach ($user as $row) {
                            echo "'" . $row['datedisable'] . "'" . ",";
                        } ?>];

    $('.datepicker').datepicker({
        startDate: new Date(),
        format: 'd-m-yyyy',
        daysOfWeekDisabled: [0, 6],
        beforeShowDay: function(date) {
            dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
            if (disableDates.indexOf(dmy) != -1) {
                return false;
            } else {
                return true;
            }
        }
    });
</script>

</html>