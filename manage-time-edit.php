<?php

error_reporting(0);
$edittime = $_GET['date'];

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "AppsOnsite");

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

	$sql = "DELETE FROM xtime WHERE timedisdate = '$date'";

	if (mysqli_query($conn,$sql)) {

		$sql2 = "INSERT INTO xtime(timedisdate,timedisable,timeonoff) VALUES('$date','$time','$dtime'),('$date','$time1','$dtime1'),('$date','$time2','$dtime2'),('$date','$time3','$dtime3'),('$date','$time4','$dtime4'),('$date','$time5','$dtime5'),('$date','$time6','$dtime6'),('$date','$time7','$dtime7'),('$date','$time8','$dtime8'),('$date','$time9','$dtime9'),('$date','$time10','$dtime10'),('$date','$time11','$dtime11'),('$date','$time12','$dtime12')";

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
	<title>Edit Time Slot</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
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

<!--=================================== S E L E C T == D A T E ===============================-->
  	
  	<input type="text" id="validate" name="validate" value="<?php echo $userid?>" style="display: none;">
  	<form method="POST" name="formdate">
	    <div class="content" style="width: 650px;">
	    	<div class="alert alert-info" role="alert">
			  <h3>Edit Time - <?php echo $edittime;?></h3>
			</div>
			<form method="POST">
				<input type="text" id="date" name="date" class="form-control datepicker" autocomplete="off" placeholder="click here.." value="<?php echo $_GET['date'];?>" style="display: none;">
				<br>
				<table>
					<tbody>
						<tr>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
						    			<div class="input-group-text">
								      		<input type="checkbox" name="time" checked="true" value="09:00AM">&nbsp;09:00AM
								    	</div>
									</div>
								  	<select name="dtime" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
											<input type="checkbox" name="time3" checked="true" value="12:00PM">&nbsp;12:00PM
								    	</div>
								  	</div>
									<select name="dtime3" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
											<input type="checkbox" name="time10" checked="true" value="07:00PM">&nbsp;07:00PM
								    	</div>
								  	</div>
									<select name="dtime10" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
											<input type="checkbox" name="time1" checked="true" value="10:00AM">&nbsp;10:00AM
								    	</div>
								  	</div>
									<select name="dtime1" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
								      		<input type="checkbox" name="time4" checked="true" value="01:00PM">&nbsp;01:00PM
										</div>
								  	</div>
								  	<select name="dtime4" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
								      		<input type="checkbox" name="time11" checked="true" value="08:00PM">&nbsp;08:00PM
										</div>
								  	</div>
								  	<select name="dtime11" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
											<input type="checkbox" name="time2" checked="true" value="11:00AM">&nbsp;11:00AM
								    	</div>
								  	</div>
									<select name="dtime2" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								    	<div class="input-group-text">
											<input type="checkbox" name="time5" checked="true" value="02:00PM">&nbsp;02:00PM
								    	</div>
								  	</div>
									<select name="dtime5" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text">
								      		<input type="checkbox" name="time12" checked="true" value="09:00PM">&nbsp;09:00PM
										</div>
								  	</div>
								  	<select name="dtime12" class="custom-select">
										<option value="on">On</option>
										<option value="off">Off</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
						<td></td>
						<td>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<div class="input-group-text">
							      		<input type="checkbox" name="time6" checked="true" value="03:00PM">&nbsp;03:00PM
									</div>
							  	</div>
								<select name="dtime6" class="custom-select">
									<option value="on">On</option>
									<option value="off">Off</option>
								</select>
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
							      		<input type="checkbox" name="time7" checked="true"value="04:00PM">&nbsp;04:00PM
									</div>
								</div>
								<select name="dtime7" class="custom-select">
									<option value="on">On</option>
									<option value="off">Off</option>
								</select>
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
										<input type="checkbox" name="time8" checked="true" value="05:00PM">&nbsp;05:00PM
							    	</div>
								</div>
							  	<select name="dtime8" class="custom-select">
									<option value="on">On</option>
									<option value="off">Off</option>
								</select>
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
							      		<input type="checkbox" name="time9" checked="true" value="06:00PM">&nbsp;06:00PM
									</div>
							  	</div>
							 	<select name="dtime9" class="custom-select">
									<option value="on">On</option>
									<option value="off">Off</option>
								</select>
							</div>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<button type="submit" name="submit" class="btn btn-warning">Update</button>
		</form>
	</div>

	<script>
	    if ( window.history.replaceState ) {
  			window.history.replaceState( null, null, window.location.href );
		}
	</script>
	</form>

<script src="scripttime.js"></script>

</body>
</html>
