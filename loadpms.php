<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$data2 = array();

$date = date('Y-m-d',strtotime("-1 days"));
$yesterday = strtotime($date);

$query = "SELECT * FROM requestappoint WHERE req_appdate > '$date' AND (req_status = 'approved' OR req_status = 'postponed') ORDER BY request_id DESC";

$query2 = "SELECT * FROM appointwoo WHERE start_appoint > '$yesterday' AND (statusapp = 'paid' OR statusapp = 'complete') ORDER BY order_id DESC";

$statement = $connect->prepare($query);

$statement2 = $connect->prepare($query2);

$statement->execute();

$statement2->execute();

$result = $statement->fetchAll();

$result2 = $statement2->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["request_id"],
        'title'   => $row["req_custname"],
        'start'   => $row["req_appdate"],
        'end'   => $row["req_appdate"]
    );
}

foreach($result2 as $row2)
{
    $data2[] = array(
        'id'   => $row2["appoint_id"],
        'title'   => $row2["hosp_name"],
        'start'   => date('Y-m-d H:i',$row2['start_appoint']-28800),
        'end'   => date('Y-m-d H:i',$row2['end_appoint']-28800)
    );
}

echo json_encode($data);

echo json_encode($data2);

?>
