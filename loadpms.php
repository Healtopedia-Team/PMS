<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$date = date('Y-m-d',strtotime("-1 days"));
$yesterday = strtotime($date);

$query = "SELECT * FROM requestappoint WHERE req_appdate > '$date' AND (req_status = 'approved' OR req_status = 'postponed') ORDER BY request_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["request_id"],
        'title'   => $row["req_custname"],
        'start'   => date('Y-m-d H:i',1621969200),
        'end'   => date('Y-m-d H:i',1621972800)
    );
}

echo json_encode($data);

?>
