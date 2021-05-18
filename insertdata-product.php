<?php
        
    $data = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data = json_decode($data, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    foreach ($data as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];

        $sql = mysqli_query($conn, "SELECT COUNT(package_id) as total FROM packagewoo WHERE package_id = '$id'");
        $result = mysqli_fetch_all($sql2, MYSQLI_ASSOC);

        foreach ($result as $row2) {
            if ($row2['total'] < 1) {
                $sql2 = "INSERT INTO packagewoo SET package_id = '$id', package_name = '$name', package_price = '$price'";
                mysqli_query($conn, $sql2);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <table>
        <thead>
            <th>PRODUCT ID</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
        </thead>
        <tbody>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['price'];?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
