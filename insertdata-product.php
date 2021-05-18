<?php
    
    header("refresh: 60");
    
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT prod_id FROM appointwoo");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <?php foreach ($result as $row) {
        echo $row['prod_id']; ?><br>
    <?php } ?>
</body>
</html>
