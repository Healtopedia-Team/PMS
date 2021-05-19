<?php
//load.php
$connect = new PDO('mysql:host=localhost;dbname=db_pms', 'myhealtopedia', 'Healit20.');

$data = array();

$query = "SELECT * FROM orderwoo ORDER BY order_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["order_id"]
        //'title'   => $row["hosp_name"],
        //'start'   => date('Y-m-d H:i',$row['start_appoint']),
        //'end'   => date('Y-m-d H:i',$row['end_appoint'])
    );
}

echo json_encode($data);

?>
