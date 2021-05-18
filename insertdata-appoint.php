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
                                
                $query=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
                $result=mysqli_fetch_all($query, MYSQLI_ASSOC);

                foreach ($result as $key) {
                    if ($key['Total'] < 1) {
                        $sql = "INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid', statusapp = '$statusapp', start_appoint = '$startappoint', end_appoint = '$endappoint', prod_id = '$prodid'";

                        if (mysqli_query($conn, $sql)) {
                            $query2 = mysqli_query($conn, "SELECT * FROM appointwoo");
                            $result2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);

                            foreach ($result2 as $key2) {
                                $rowid = $key2['order_id'];
                                $sql2 = "UPDATE appointwoo SET pack_name = '$packagename' WHERE order_id' = '$rowid'";
                                mysqli_query($conn, $sql2);
                            }
                        }else{
                            $query2 = mysqli_query($conn, "SELECT * FROM appointwoo");
                            $result2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);

                            foreach ($result2 as $key2) {
                                $rowid = $key2['order_id'];
                                $sql2 = "UPDATE appointwoo SET pack_name = '$packagename' WHERE order_id' = '$rowid'";
                                mysqli_query($conn, $sql2);
                            }
                        }
                    }
                }
            }
        }
    }
?>
