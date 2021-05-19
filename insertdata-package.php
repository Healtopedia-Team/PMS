<?php include 'dbconnect.php';

$product = file_get_contents('https://pms.healtopedia.com/productjson.php');
$product = json_decode($product, true);

$validate = mysqli_query($conn, "SELECT  FROM packagewoo");
$validate = mysqli_fetch_all($validate, MYSQLI_ASSOC);

foreach ($product as $row) {
    $prodid = $row['id'];

    $validate = mysqli_query($conn, "SELECT COUNT(package_id) as Total FROM packagewoo WHERE package_id = '$prodid'");
    $validate = mysqli_fetch_all($validate, MYSQLI_ASSOC);

    foreach ($validate as $row2) {
        if ($row2['Total'] < 1) {
            $sql = "INSERT INTO packagewoo SET package_id = '$prodid'";
            mysqli_query($conn, $sql);
        }
    }
    $sql = "INSERT INTO packagewoo SET package_id = '$prodid'";
    mysqli_query($conn, $sql);
}

?>
