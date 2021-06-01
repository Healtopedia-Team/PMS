<?php
//count the appointments number per month
$conn = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');
session_start();
$hosp = ($_SESSION['sel_hosp'] != '') ? $_SESSION['sel_hosp'] : $_SESSION['hospital'];
$sel_year = ($_SESSION['sel_year'] != '') ? $_SESSION['sel_year']: date("Y");

$sql = "SELECT SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 1, c.package_price, 0)) AS Jan,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 2 , c.package_price, 0)) AS Feb,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 3 , c.package_price, 0)) AS Mar,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 4 , c.package_price, 0)) AS Apr,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 5 , c.package_price, 0)) AS May,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 6 , c.package_price, 0)) AS Jun,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 7 , c.package_price, 0)) AS Jul,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 8 , c.package_price, 0)) AS Aug,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 9 , c.package_price, 0)) AS Sep,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 10 , c.package_price, 0)) AS 'Oct',
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 11, c.package_price, 0)) AS Nov,
    SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 12 , c.package_price, 0)) AS 'Dec' 
    FROM `orderwoo` a 
    LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
    WHERE b.hosp_name=:hosp AND a.status='completed' AND YEAR(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = :sel_year";

$res = $conn->prepare($sql);
$res->bindParam(":hosp", $hosp);
$res->bindParam(":sel_year", $sel_year);
$res->execute();
$result = $res->fetch();
echo json_encode($result);





?>