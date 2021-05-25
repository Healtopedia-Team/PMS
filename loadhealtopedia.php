<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$date = date('Y-m-d',strtotime("-1 days"));
$yesterday = strtotime($date);

$query = "SELECT * FROM calendar WHERE cal_start > '$date'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["cal_id"],
        'title'   => $row["cal_name"],
        'start'   => $row["cal_start"],
        'end'   => $row["cal_end"]
    );
}

echo json_encode($data);

?>
