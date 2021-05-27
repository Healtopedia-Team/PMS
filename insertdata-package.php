<?php include 'dbconnect.php';

$product = file_get_contents('https://pms.healtopedia.com/productjson.php');
$product = json_decode($product, true);

foreach ($product as $row) {
    $prodid = $row['id'];
    $price = $row['price'];
    $name = $row['name'];
    
    //$validate = mysqli_query($conn, "SELECT COUNT(package_id) as Total FROM packagewoo WHERE package_id = '$prodid'");
    //$validate = mysqli_fetch_all($validate, MYSQLI_ASSOC);

    $result = $conn->prepare("SELECT COUNT(package_id) as Total FROM packagewoo WHERE package_id = ?");
    $result->bind_param("i", $prodid);
    $result->execute();
    $validate = $result->get_result()->fetch_all(MYSQLI_ASSOC);

    foreach ($validate as $row2) {
        if ($row2['Total'] < 1) {
            /*
            $sql = "INSERT INTO packagewoo SET package_id = '$prodid', package_price = '$price'";
            if (mysqli_query($conn, $sql)){
                $sql2 = "UPDATE packagewoo SET package_name = '$name' WHERE package_id = '$prodid'";
                mysqli_query($conn, $sql2);
            }
            */

            $sql = $conn->prepare("INSERT INTO packagewoo SET package_id = ?, package_price = ? ");
            $sql->bind_param("ii", $prodid, $price);
            if ($sql->execute()) {
                $sql2 = $conn->prepare("UPDATE packagewoo SET package_name = ? WHERE package_id = ? ");
                $sql2->bind_param("si", $prodid, $price);
                $sql2->execute();
            }
        }

        //$sql3 = "UPDATE packagewoo SET package_name = '$name' WHERE package_id = '$prodid'";
        //mysqli_query($conn, $sql3);

        $sql3 = $conn->prepare("UPDATE packagewoo SET package_name = ? WHERE package_id = ? ");
        $sql3->bind_param("si", $prodid, $price);
        $sql3->execute();
    }
}

?>
