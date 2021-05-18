<?php
        
    $data2 = file_get_contents('https://pms.healtopedia.com/productjson.php');
    $data2 = json_decode($data2, true);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
        
    $sql = mysqli_query($conn, "SELECT prod_id FROM appointwoo ORDER BY order_id DESC");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    foreach ($result as $row) {
        foreach ($data2 as $row2) {
            if ($row2['id'] == "21135") {
                echo $prodid = $row['prod_id'];
                echo $prodname = $row2['name'];
                echo $prodprice = $row2['price'];

                $sql2 = "INSERT INTO packagewoo SET package_id = '$prodid', package_name = '$prodname', package_price = '$prodprice'";

                mysqli_query($conn, $sql2);

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
