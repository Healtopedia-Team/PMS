<?php
        
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT appoint_id, prod_id FROM appointwoo ORDER BY order_id DESC");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

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
            <?php foreach ($data2 as $row2) { ?>
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
