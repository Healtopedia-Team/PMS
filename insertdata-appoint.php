<?php
    
    header("refresh: 60");

    $data = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slotjson.php');
    $data = json_decode($data, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    foreach ($data as $row){
        $orderid = $row['order_id'];
        $appointid = $row['id'];
        $startappoint = $row['start'];
        $statusapp = $row['status'];
  
        $result=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            foreach ($user as $key) {
                if ($key['Total'] < 1) {
                    $sql = "INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid',start_appoint = '$startappoint',statusapp = '$statusapp'";
                    mysqli_query($conn, $sql);
                }
            
        }
    }
?>
