<?php include 'dbconnect.php';

$product = file_get_contents('https://pms.healtopedia.com/productjson.php');
$product = json_decode($product, true);

foreach ($product as $row) {
    $prodid = $row['id'];

    $sql = "INSERT INTO packagewoo SET package_id = '$prodid'";
    mysqli_query($conn, $sql);
}

?>
