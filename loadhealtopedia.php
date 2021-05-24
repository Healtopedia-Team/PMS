<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$date = date('Y-m-d',strtotime("-1 days"));
$yesterday = strtotime($date);

$query = "SELECT * FROM appointwoo WHERE start_appoint > '$yesterday' AND (statusapp = 'paid' OR statusapp = 'complete') ORDER BY order_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["appoint_id"],
        'title'   => $row["hosp_name"],
        'start'   => date('Y-m-d H:i',$row['start_appoint']-28800),
        'end'   => date('Y-m-d H:i',$row['end_appoint']-28800)
    );
}

echo json_encode($data);

?>
