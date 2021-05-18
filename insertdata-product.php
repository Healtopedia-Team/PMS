<?php
        
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
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
            <?php foreach ($data2 as $row) { ?>
                <tr>
                    <td><?php echo $id = $row['id'];?></td>
                    <td><?php echo $name = $row['name'];?></td>
                    <td><?php echo $price = $row['price'];?></td>
                </tr>
            <?php
                $sql = mysqli_query($conn, "SELECT COUNT(package_id) as total FROM packagewoo WHERE package_id = '$id'");
                $result = mysqli_fetch_all($sql2, MYSQLI_ASSOC);

                foreach ($result as $row) {
                    if ($row['total'] < 1) {
                        $sql2 = "INSERT INTO packagewoo SET package_id = '$id', package_name = '$name', package_price = '$price'";
                        mysqli_query($conn, $sql2);
                    }
                }
            } ?>
        </tbody>
    </table>
</body>
</html>
