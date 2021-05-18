<?php
        
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT prod_id FROM appointwoo ORDER BY order_id DESC");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    foreach ($result as $row) {
        foreach ($data2 as $row2) {
            if ($row['prod_id'] == $row2['id']) {
                $prodid = $row['prod_id'];
                $prodname = $row2['name'];
                $prodprice = $row2['price'];

                /*$query=mysqli_query($conn, "SELECT COUNT(package_id) as Total FROM packagewoo WHERE package_id = '$prodid'");
                $user=mysqli_fetch_all($query, MYSQLI_ASSOC);

                foreach ($user as $key) {
                    if ($key['Total'] < 1) {
                        $sql2 = "INSERT INTO packagewoo SET package_id = '$prodid', package_name = '$prodname', package_price = '$prodprice'";

                        mysqli_query($conn, $sql2);
                    }
                }*/
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
            <th>ID</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $prodid?></td>
                <td><?php echo $prodname?></td>
                <td><?php echo $prodprice?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
