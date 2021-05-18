<?php
    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    $data = file_get_contents('https://pms.healtopedia.com/slotjson.php');
    $data = json_decode($data, true);

    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    foreach ( $data as $row ) {
        foreach ( $data2 as $row2 ) {
            if ($row2['id'] == $row['product_id']) {
                $orderid = $row['order_id'];
                $appointid = $row['id'];
                $statusapp = $row['status'];
                $prodid = $row2['id'];
                $packagename = $row2['name'];
                $startappoint = $row['start'];
                $endappoint = $row['end'];
                                
                $result=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
                $user=mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($user as $key) {
                    if ($key['Total'] < 1) {
                        $sql = " INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid', statusapp = '$statusapp', start_appoint = '$startappoint', end_appoint = '$endappoint', prod_id = '$prodid'";

                        mysqli_query($conn, $sql);
                    }
                }

                $start = date('Y-m-d H:i',$row['start']);
                $end = date('Y-m-d H:i',$row['end']);
                $sql2 = "INSERT INTO calendar SET event_title = '$packagename', start_event = '$start', end_event = '$end'";

                mysqli_query($conn, $sql2);
            }
        }
    }
?>
