<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$yesterday = json_decode(date('Y-m-d',strtotime("-1 days")));

$query = "SELECT * FROM appointwoo WHERE statusapp = 'complete' OR statusapp = 'paid' AND start_appoint > '$yesterday' ORDER BY order_id DESC";

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
