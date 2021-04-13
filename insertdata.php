<?php
	
	header("refresh: 60");

	$data = file_get_contents('https://digital.healtopedia.com/ATIQ/MigrateWoo/slot2json.php');
	$data = json_decode($data, true);
	$data2 = file_get_contents('https://digital.healtopedia.com/ATIQ/MigrateWoo/slotjson.php');
	$data2 = json_decode($data2, true);

  	$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

  	foreach ($data as $row ){
    	if ($row['status'] == "completed" || $row['status'] == "processing") {

      	$firstname = $row['billing']['first_name'];
      	$lastname = $row['billing']['last_name'];
      	$orderid = $row['number'];
      	$status = $row['status'];

      	foreach ($data2 as $row2) {
        	if ($row2['order_id'] == $row['number']) {
          		$custid = $row2['id'];
          		$custidno = count($row2['id']);
          	}
        }

        if ($custidno < 2) {
        	//$sql = "INSERT INTO orderwoo SET firstname = '$firstname', lastname = '$lastname', order_id = '$orderid', cust_id = '$custid', status = '$status'";

      		mysqli_query($conn, $sql);
        }
    	}
  	}
?>
