<?php
$connect = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$data = array();

$query = mysqli_query($connect, "SELECT * FROM appointwoo WHERE statusapp = 'complete' OR statusapp = 'paid' ORDER BY order_id DESC");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

foreach($result as $row) {
    $data['id'] = $row['appoint_id'];
    $data['title'] = $row['hosp_name'];
    $data['start'] = date('Y-m-d H:i',$row['start_appoint']-28800);
    $data['end'] = date('Y-m-d H:i',$row['end_appoint']-28800);
}

echo json_encode($data);
