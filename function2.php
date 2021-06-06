<?php
$servername = "localhost";
$username = "myhealtopedia";
$password = "Healit20.";
$dbname = "AppsOnsite";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$name = str_replace("'", '', $name);
$ic = $_POST['ic'];
$oldbod = $_POST['bod'];
$bod = date("dd/mm/yyyy", strtotime($oldbod));
$gender = $_POST['gender'];
$nation = $_POST['nation'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['current_address'];
$app_date = date("d/m/Y");
$method = $_POST['test_method'];
$type = $_POST['test_type'];
$app_time = date("h:i A");
$payment_m = $_POST['payment_method'];
$orderno = '12345';
$price = 0;
$location = $_POST['location'];
if ($type == 'RTK-Antigen') {
    $price = "90";
} else if ($type == 'RT-PCR') {
    $price = "210";
} else if ($type == 'STATPCR') {
    $price = "310";
} else {
    $price = "350";
}
$order_date = date("d/m/Y h:i:s A");

$queryc = mysqli_query($conn, "select count(1) FROM book_list") or die(mysqli_error($connection));
$rowc = mysqli_fetch_array($queryc);

$total = $rowc[0];
$code = 'APPS';
$mt = mt_rand(0001, 9990);
$orderno=$code.$total.$mt;

//Queue number generator
$number = 1;
$count = 000;

if($name !=='DUMMY'){
$query = mysqli_query($conn, "SELECT count(1) FROM book_list WHERE location='$location' AND app_date='$app_date' AND name !='DUMMY'");
$rowq = mysqli_fetch_array($query);
if ($rowq[0]==0) {
    $count =1;
 }
else{
   
    $count=$rowq[0]+1;

}}



$location_det = array('Perumahan Awam Seri Sabah 3A'=>'A', 'Perumahan Awam Seri Sabah 3B'=>'B', 'Perumahan Awam Seri Pulau Pinang'=>'C', 'Perumahan Awam Seri Kota'=>'D');
//$queue_num = $location_det['Pulse Grande Hotel']. sprintf('%04d',$number); eg
//echo $queue_num; this will print "A0001"
$queue_num = $location_det[$_POST['location']]. sprintf('%04d',$count);

//This is with the queue_num insertion
$sqlresult = mysqli_query($conn, "INSERT INTO book_list (name,ic,bod,gender,nation,phone,email,address,app_date,method,type,app_time,risk,payment_method,order_no,location,company,price,ref_no,status,order_date,temp,checkin,staff,result, queue_num, current_cnt) VALUES
('$name','$ic','$bod','$gender','$nation','$phone','$email', '$address','$app_date','$method','$type','$app_time','No Risk', '$payment_m','$orderno', '$location','N/A','$price', 'N/A','Paid','$order_date','N/A','Check-In','None','', '$queue_num','$count')") or die(mysqli_error($conn));

/*
$sqlresult = mysqli_query($conn, "INSERT INTO book_list (name,ic,bod,gender,nation,phone,email,address,app_date,method,type,app_time,risk,payment_method,order_no,location,company,price,ref_no,status,order_date,temp,checkin,staff,result) VALUES
('$name','$ic','$bod','$gender','$nation','$phone','$email', '$address','$app_date','$method','$type','$app_time','No Risk', '$payment_m','$orderno', '$location','N/A','$price', 'N/A','Paid','$order_date','N/A','Check-In','None','')") or die(mysqli_error($conn));
*/

if ($sqlresult) {
   
    header('location:https://pms.healtopedia.com/ticket2.php?name='.$name.'&ic='.$ic.'&gender='.$gender.'&queue='.$queue_num);
    echo '<script>alert("Registration Successful!")</script>';
}

session_start();
