<?php
//count the appointments number per month
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');
session_start();
$hosp = $_SESSION['hospital'];
$data = array();

$date = date('Y-m-d',strtotime("-1 days"));
$yesterday = strtotime($date);
//This will return an array with month name as key
$query = "SELECT 
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 1 , 1 , 0)) AS Jan,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 2 , 1 , 0)) AS Feb,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 3 , 1 , 0)) AS Mar,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 4 , 1 , 0)) AS Apr,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 5 , 1 , 0)) AS May,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 6 , 1 , 0)) AS Jun,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 7 , 1 , 0)) AS Jul,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 8 , 1 , 0)) AS Aug,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 9 , 1 , 0)) AS Sep,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 10 , 1 , 0)) AS 'Oct',
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 11 , 1 , 0)) AS Nov,
    SUM(IF(MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = 12 , 1 , 0)) AS 'Dec'
FROM `appointwoo` WHERE YEAR(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = YEAR(CURDATE()) AND NOT statusapp='cancelled' AND hosp_name=?";


$statement = $connect->prepare($query);
$statement->bindParam("s", $hosp);
$statement->execute();

$result = $statement->fetch();

echo json_encode($result);

?>