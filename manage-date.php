<?php
$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "AppsOnsite");

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
<!DOCTYPE html>
<html lang="en">

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
                            <h3>Manage Date</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Date</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
				<div class="row">
					<div class="col-sm">
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
							<button type="submit" name="submit" class="btn btn-warning">Submit</button>
						</form>
					</div>
					<div class="col-sm">
						<table class="table table-bordered" style="text-align: center;">
							<tr class="table-info">
								<th>DISABLED DATE</th>
								<th>DELETE</th>
							</tr>
							<?php foreach($user as $row): ?>
								<form method="POST">
								<tr>
									<td><?php echo $row['datedisable']; ?></td>
									<td>
										<button type="submit" name="deletedate" class="btn btn-danger">
											<i class="icon-trash"></i>
											<input type="text" name="deletedate" value="<?php echo $row['id']; ?>" style="display: none;">
										</button>
									</td>
								</tr>
								</form>
							<?php endforeach; ?>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
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
<?php

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "AppsOnsite");

$result=mysqli_query($conn, "SELECT datedisable FROM xdate");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<script type="text/javascript">
    var disableDates = [<?php foreach ($user as $row){echo "'".$row['datedisable']."'".",";}?>];
      
    $('.datepicker').datepicker({
    	startDate: new Date(),
        format: 'd-m-yyyy',
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
