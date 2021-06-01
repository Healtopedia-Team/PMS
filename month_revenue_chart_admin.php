<?php
//count the appointments number per month
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');
session_start();
$hosp = $_SESSION['hospital'];
$data = array();
if ($sel_month == 1) { //print last year december information
    $sql = "SELECT SUM(c.package_price) AS Jan,
                        FROM `orderwoo` a 
                        LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
                        WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ? 
                        AND MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 1";
    $res = $conn->prepare($sql);
    $res->bind_param("ss", $hosp, $sel_year);
    $res->execute();
    $gross_revenue_jan = $res->get_result()->fetch();

    $prev =
        "SELECT SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 2 , c.package_price, 0)) AS Feb,
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
                WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ? 
                ";
    $prev_y = $conn->prepare($prev);
    $prev_y->bind_param("ss", $hosp, $sel_year - 1);
    $prev_y->execute();
    $gross_revenue_prev = $prev_y->get_result()->fetch();
} else {
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
                                WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ? 
                                AND MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ?";
    $res = $conn->prepare($sql);
    $res->bind_param("sss", $hosp, $sel_year, $sel_month);
    $res->execute();
    $result = $res->fetch();
}


echo json_encode($result);

?>