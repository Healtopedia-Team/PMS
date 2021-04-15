<?php
    
    header("refresh: 60");

    $data = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slotjson.php');
    $data = json_decode($data, true);
    
    $data2 = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    foreach ($data as $row){
        $orderid = $row['order_id'];
        $appointid = $row['id'];
        $startappoint = $row['start'];
        $statusapp = $row['status'];
        $productid = $row['product_id'];
        
        foreach ($data2 as $row2){
            if ($row2['id'] == $row['product_id']){
                $hospname = $row2['categories'][0]['name'];
            }
        }
  
        $result=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        foreach ($user as $key) {
            if ($key['Total'] < 1) {
                //$sql = "INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid',start_appoint = '$startappoint',statusapp = '$statusapp',hospname = '$hospname'";
                mysqli_query($conn, $sql);
            }
        }
    }
?>
