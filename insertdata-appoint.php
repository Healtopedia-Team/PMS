<?php
    header("refresh: 60");
    error_reporting(0);

    $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

    $data = file_get_contents('https://pms.healtopedia.com/json-product.php');
    $data = json_decode($data, true);

    $data2 = file_get_contents('https://pms.healtopedia.com/json-appointment.php');
    $data2 = json_decode($data2, true);

    $data3 = file_get_contents('https://pms.healtopedia.com/json-order.php');
    $data3 = json_decode($data3, true);

    foreach ( $data2 as $row2 ) :
        foreach ( $data as $row ) :
            if ($row['id'] == $row2['product_id']){
                if ($row2['status'] == "paid" || $row2['status'] == "complete" || $row2['status'] == "confirmed") {
                    $orderid = $row2['order_id'];
                    $appointid = $row2['id'];
                    $statusapp = $row2['status'];
                    $prodid = $row['id'];

                    if (strpos("'".$row['categories'][5]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Sunway') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][5]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][5]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][5]['name'];

                    }elseif (strpos("'".$row['categories'][4]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Sunway') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][4]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][4]['name'];

                    }elseif (strpos("'".$row['categories'][3]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Sunway') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][3]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][4]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][3]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][3]['name'];

                    }elseif (strpos("'".$row['categories'][2]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Sunway') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][2]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][2]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][2]['name'];

                    }elseif (strpos("'".$row['categories'][1]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Sunway') != false ||
                        strpos("'".$row['categories'][1]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][1]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][1]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][1]['name'];

                    }elseif (strpos("'".$row['categories'][0]['name']."'",'KPJ') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Sunway') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Healtopedia') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Disinfection') != false ||
                        strpos("'".$row['categories'][0]['name']."'",'Klinik') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Wellness') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Medicare') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Clinic') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'BeLive') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'BENPHYSIO') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'CryoFit') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'International') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Regen') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Soul') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'ALPS') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Home') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Dokter4U') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Thomson') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Prince') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Timberland') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Imperial') != false || 
                        strpos("'".$row['categories'][0]['name']."'",'Walk-In') != false) {
                        $hospname = $row['categories'][0]['name'];
                    } 

                    $packagename = $row['name'];
                    $startappoint = $row2['start'];
                    $endappoint = $row2['end'];

                    //$result=mysqli_query($conn, "SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id = '$appointid'");
                    //$user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $result = $conn->prepare("SELECT COUNT(appoint_id) as Total FROM appointwoo WHERE appoint_id =? ");
                    $result->bind_param("i", $appointid);
                    $result->execute();
                    $user = $result->get_result()->fetch_all(MYSQLI_ASSOC);

                    foreach ($user as $key) {
                    if ($key['Total'] < 1) {
                        //$sql = "INSERT INTO appointwoo SET order_id = '$orderid', appoint_id = '$appointid', statusapp = '$statusapp', start_appoint = '$startappoint', end_appoint = '$endappoint', prod_id = '$prodid', hosp_name = '$hospname'";
                        //mysqli_query($conn, $sql);
                        $query = $conn->prepare("INSERT INTO appointwoo SET order_id = ?, appoint_id = ?, statusapp = ?, 
                            start_appoint = ?, end_appoint = ?, prod_id = ?, hosp_name = ?");
                        $query->bind_param("iisiiis", $orderid, $appointid, $statusapp, $startappoint, $endappoint, $prodid, $hospname);
                        $query->execute();

                    }
                }
            }
        }
        endforeach;
    endforeach;

    foreach ($data3 as $row3 ){
        if ($row3['status'] == "completed" || $row3['status'] == "processing") {

            $firstname = $row3['billing']['first_name'];
            $lastname = $row3['billing']['last_name'];
            $orderid = $row3['number'];
            $status = $row3['status'];
            $orderdate = $row3['date_created'];

            foreach ($data2 as $row2) {
                if ($row4['order_id'] == $row3['number']) {
                    $custid = $row2['id'];
                }
            }

            //$result=mysqli_query($conn, "SELECT COUNT(cust_id) as Total FROM orderwoo WHERE cust_id = '$custid'");
            //$user=mysqli_fetch_all($result, MYSQLI_ASSOC);
            $result2 = $conn->prepare("SELECT COUNT(cust_id) as Total FROM orderwoo WHERE cust_id =? ");
            $result2->bind_param("i", $custid);
            $result2->execute();
            $user2 = $result2->get_result()->fetch_all(MYSQLI_ASSOC);

            foreach ($user2 as $key2) {
                if ($key2['Total'] < 1) {
                    //$sql = "INSERT INTO orderwoo SET firstname = '$firstname', lastname = '$lastname', order_id = '$orderid', cust_id = '$custid', status = '$status', order_date = '$orderdate'";
                    //mysqli_query($conn, $sql);

                    $query2 = $conn->prepare("INSERT INTO orderwoo SET firstname = ?, lastname = ?, order_id = ?, cust_id = ?, status = ?, order_date = ? ");
                    $query2->bind_param("ssiiss", $firstname, $lastname, $orderid, $custid, $status, $orderdate);
                    if ($query2->execute()) {

                        $data4 = $conn->prepare("SELECT * FROM appointwoo");
                        $data4->execute();
                        $result4 = $data4->get_result()->fetch_all(MYSQLI_ASSOC);

                        $data5 = $conn->prepare("SELECT * FROM requestappoint");
                        $data5->execute();
                        $result5 = $data5->get_result()->fetch_all(MYSQLI_ASSOC);

                        foreach ($result4 as $row4) {
                            $appointid = $row4['appoint_id'];
                            $orderid = $row4['order_id'];
                            $hospname = $row4['hosp_name'];
                            $startapp = date('Y-m-d H:i',$row4['start_appoint']-28800);
                            $endapp = date('Y-m-d H:i',$row4['end_appoint']-28800);
                            $statusapp = $row4['statusapp'];

                            //$valid = mysqli_query($conn, "SELECT COUNT(*) as Total FROM calendar WHERE cal_id = '$appointid'");
                            //$ans = mysqli_fetch_all($valid, MYSQLI_ASSOC);

                            $valid = $conn->prepare("SELECT COUNT(*) as Total FROM calendar WHERE cal_id =? ");
                            $valid->bind_param("i", $appointid);
                            $valid->execute();
                            $ans = $valid->get_result()->fetch_all(MYSQLI_ASSOC);

                            foreach ($ans as $key3) {
                                if ($key3['Total'] < 1) {
                                    //$sql = "INSERT INTO calendar SET cal_id = '$appointid', cal_name = '$hospname', cal_start = '$startapp', cal_end = '$endapp', cal_status = '$statusapp'";
                                    //mysqli_query($conn, $sql);
                                    $query3 = $conn->prepare("INSERT INTO calendar SET cal_id = ?, cal_orderid = ?, cal_name =?, cal_start = ?, cal_end = ?, cal_status = ?");
                                    $query3->bind_param("isssss", $appointid, $orderid, $hospname, $startapp, $endapp, $statusapp);
                                    $query3->execute();
                                }
                            }
                        }

                        foreach ($result5 as $row5) {
                            $reqid = $row5['request_id'];
                            $reqorder = $row5['request_id'];
                            $packname = $row5['req_packname'];
                            $appdate = $row5['req_appdate'];
                            $status = $row5['req_status'];

                            if ($row5['req_apptime'] == "09:00AM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('09:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('10:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "10:00AM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('10:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('11:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "11:00AM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('11:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('12:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "12:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('12:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('13:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "01:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('13:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('14:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "02:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('14:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('15:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "03:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('15:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('16:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "04:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('16:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('17:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "05:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('17:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('18:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "06:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('18:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('19:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "07:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('19:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('20:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "08:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('20:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('21:00:00'));
                            }
                            elseif ($row2['req_apptime'] == "09:00PM")
                            {
                                $start = $appdate." ".date('H:i', strtotime('21:00:00'));
                                $end = $appdate." ".date('H:i', strtotime('22:00:00'));
                            }

                            //$valid2 = mysqli_query($conn, "SELECT COUNT(*) as Total FROM calendar WHERE cal_id = '$reqid'");
                            //$ans2 = mysqli_fetch_all($valid2, MYSQLI_ASSOC);

                            $valid2 = $conn->prepare("SELECT COUNT(*) as Total FROM calendar WHERE cal_id =? ");
                            $valid2->bind_param("i", $reqid);
                            $valid2->execute();
                            $ans2 = $valid2->get_result()->fetch_all(MYSQLI_ASSOC);

                            foreach ($ans2 as $key4) {
                                if ($key4['Total'] < 1) {
                                    //$sql2 = "INSERT INTO calendar SET cal_id = '$reqid', cal_name = '$packname', cal_start = '$start', cal_end = '$end', cal_status = '$status'";
                                    //mysqli_query($conn, $sql2);
                                    $query4 = $conn->prepare("INSERT INTO calendar SET cal_id = ?, cal_orderid = ?, cal_name =?, cal_start = ?, cal_end = ?, cal_status = ?");
                                    $query4->bind_param("isssss", $reqid, $reqorder, $packname, $start, $end, $status);
                                    $query4->execute();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>
