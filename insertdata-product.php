<?php
        
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT appoint_id, prod_id FROM appointwoo ORDER BY order_id DESC");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    foreach ($result as $row) {
        foreach ($data2 as $row2) {
            if ($row['prod_id'] == $row2['id']) {
                $prodid = $row['prod_id'];
                $name = $row2['name'];
                $price = $row2['price'];
                $appointid = $row['appoint_id'];

                $sql2 = mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM packagewoo WHERE appoint_id = '$appointid'");
                $result2 = mysqli_fetch_all($sql2, MYSQLI_ASSOC);

                foreach ($result2 as $key) {
                    if ($key['Total'] < 1) {
                        $query = "INSERT INTO packagewoo SET package_id = '$prodid', package_name = '$name', package_price = '$price', appoint_id = '$appointid'";
                        mysqli_query($conn, $query);
                    }
                }

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
            <th>APPOINT ID</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
        </thead>
        <tbody>
            <?php foreach ($result as $row) {
                foreach ($data2 as $row2) {
                    if ($row['prod_id'] == $row2['id']) { ?>
                        <tr>
                            <td><?php echo $row['prod_id'];?></td>
                            <td><?php echo $row['appoint_id'];?></td>
                            <td><?php echo $row2['name'];?></td>
                            <td><?php echo $row2['price'];?></td>
                        </tr>
                    <?php }
                }
            }?>
        </tbody>
    </table>
</body>
</html>
