<?php
    
    header("refresh: 60");
    
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT prod_id FROM appointwoo ORDER BY order_id DESC");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <?php foreach ($result as $row) {
        foreach ($data2 as $row2) {
            if ($row2['id'] == $row['prod_id']) {
                echo $row['prod_id'];." - ".echo $row2['name'];." - ".echo $row2['price']; ?><br>
    <?php }}} ?>
</body>
</html>
