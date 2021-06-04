<?php

    header("refresh: 60");

    $data = file_get_contents('https://pms.healtopedia.com/json-order.php');
    $data = json_decode($data, true);
    $data2 = file_get_contents('https://pms.healtopedia.com/slotjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    foreach ($data as $row ){
        if ($row['status'] == "completed" || $row['status'] == "processing") {

            $firstname = $row['billing']['first_name'];
            $lastname = $row['billing']['last_name'];
            $orderid = $row['number'];
            $status = $row['status'];
            $orderdate = $row['date_created'];

            foreach ($data2 as $row2) {
                if ($row2['order_id'] == $row['number']) {
                    $custid = $row2['id'];
                }
            }

            //$result=mysqli_query($conn, "SELECT COUNT(cust_id) as Total FROM orderwoo WHERE cust_id = '$custid'");
            //$user=mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result = $conn->prepare("SELECT COUNT(cust_id) as Total FROM orderwoo WHERE cust_id =? ");
            $result->bind_param("i", $custid);
            $result->execute();
            $user = $result->get_result()->fetch_all(MYSQLI_ASSOC);

            foreach ($user as $key) {
                if ($key['Total'] < 1) {
                    //$sql = "INSERT INTO orderwoo SET firstname = '$firstname', lastname = '$lastname', order_id = '$orderid', cust_id = '$custid', status = '$status', order_date = '$orderdate'";
                    //mysqli_query($conn, $sql);

                    $sql = $conn->prepare("INSERT INTO orderwoo SET firstname = ?, lastname = ?, order_id = ?, cust_id = ?, status = ?, order_date = ? ");
                    $sql->bind_param("ssiiss", $firstname, $lastname, $orderid, $custid, $status, $orderdate);
                    $sql->execute();
                }
            }
        }
    }
?>
