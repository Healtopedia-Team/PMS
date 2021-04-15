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
                if (strpos("'".$row['categories'][5]['name']."'",'KPJ') != false || strpos("'".$row['categories'][5]['name']."'",'Sunway') != false || strpos("'".$row['categories'][5]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][5]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][5]['name']."'",'Klinik') != false || strpos("'".$row['categories'][5]['name']."'",'Wellness') != false || strpos("'".$row['categories'][5]['name']."'",'Medicare') != false || strpos("'".$row['categories'][5]['name']."'",'Clinic') != false || strpos("'".$row['categories'][5]['name']."'",'BeLive') != false || strpos("'".$row['categories'][5]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][5]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][5]['name']."'",'International') != false || strpos("'".$row['categories'][5]['name']."'",'Regen') != false || strpos("'".$row['categories'][5]['name']."'",'Soul') != false || strpos("'".$row['categories'][5]['name']."'",'ALPS') != false || strpos("'".$row['categories'][5]['name']."'",'Home') != false || strpos("'".$row['categories'][5]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][5]['name']."'",'Thomson') != false || strpos("'".$row['categories'][5]['name']."'",'Prince') != false || strpos("'".$row['categories'][5]['name']."'",'Timberland') != false || strpos("'".$row['categories'][5]['name']."'",'Imperial') != false) {
                         $hospname = $row['categories'][5]['name'];

                }elseif (strpos("'".$row['categories'][4]['name']."'",'KPJ') != false || strpos("'".$row['categories'][4]['name']."'",'Sunway') != false || strpos("'".$row['categories'][4]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][4]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][4]['name']."'",'Klinik') != false || strpos("'".$row['categories'][4]['name']."'",'Wellness') != false || strpos("'".$row['categories'][4]['name']."'",'Medicare') != false || strpos("'".$row['categories'][4]['name']."'",'Clinic') != false || strpos("'".$row['categories'][4]['name']."'",'BeLive') != false || strpos("'".$row['categories'][4]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][4]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][4]['name']."'",'International') != false || strpos("'".$row['categories'][4]['name']."'",'Regen') != false || strpos("'".$row['categories'][4]['name']."'",'Soul') != false || strpos("'".$row['categories'][4]['name']."'",'ALPS') != false || strpos("'".$row['categories'][4]['name']."'",'Home') != false || strpos("'".$row['categories'][4]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][4]['name']."'",'Thomson') != false || strpos("'".$row['categories'][4]['name']."'",'Prince') != false || strpos("'".$row['categories'][4]['name']."'",'Timberland') != false || strpos("'".$row['categories'][4]['name']."'",'Imperial') != false) {
                        $hospname = $row['categories'][4]['name'];

                }elseif (strpos("'".$row['categories'][3]['name']."'",'KPJ') != false || strpos("'".$row['categories'][3]['name']."'",'Sunway') != false || strpos("'".$row['categories'][3]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][3]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][3]['name']."'",'Klinik') != false || strpos("'".$row['categories'][3]['name']."'",'Wellness') != false || strpos("'".$row['categories'][3]['name']."'",'Medicare') != false || strpos("'".$row['categories'][3]['name']."'",'Clinic') != false || strpos("'".$row['categories'][3]['name']."'",'BeLive') != false || strpos("'".$row['categories'][3]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][3]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][3]['name']."'",'International') != false || strpos("'".$row['categories'][3]['name']."'",'Regen') != false || strpos("'".$row['categories'][3]['name']."'",'Soul') != false || strpos("'".$row['categories'][3]['name']."'",'ALPS') != false || strpos("'".$row['categories'][3]['name']."'",'Home') != false || strpos("'".$row['categories'][3]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][3]['name']."'",'Thomson') != false || strpos("'".$row['categories'][3]['name']."'",'Prince') != false || strpos("'".$row['categories'][4]['name']."'",'Timberland') != false || strpos("'".$row['categories'][3]['name']."'",'Imperial') != false) {
                        $hospname = $row['categories'][3]['name'];

                }elseif (strpos("'".$row['categories'][2]['name']."'",'KPJ') != false || strpos("'".$row['categories'][2]['name']."'",'Sunway') != false || strpos("'".$row['categories'][2]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][2]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][2]['name']."'",'Klinik') != false || strpos("'".$row['categories'][2]['name']."'",'Wellness') != false || strpos("'".$row['categories'][2]['name']."'",'Medicare') != false || strpos("'".$row['categories'][2]['name']."'",'Clinic') != false || strpos("'".$row['categories'][2]['name']."'",'BeLive') != false || strpos("'".$row['categories'][2]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][2]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][2]['name']."'",'International') != false || strpos("'".$row['categories'][2]['name']."'",'Regen') != false || strpos("'".$row['categories'][2]['name']."'",'Soul') != false || strpos("'".$row['categories'][2]['name']."'",'ALPS') != false || strpos("'".$row['categories'][2]['name']."'",'Home') != false || strpos("'".$row['categories'][2]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][2]['name']."'",'Thomson') != false || strpos("'".$row['categories'][2]['name']."'",'Prince') != false || strpos("'".$row['categories'][2]['name']."'",'Timberland') != false || strpos("'".$row['categories'][2]['name']."'",'Imperial') != false) {
                        $hospname = $row['categories'][2]['name'];

                }elseif (strpos("'".$row['categories'][1]['name']."'",'KPJ') != false || strpos("'".$row['categories'][1]['name']."'",'Sunway') != false || strpos("'".$row['categories'][1]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][1]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][1]['name']."'",'Klinik') != false || strpos("'".$row['categories'][1]['name']."'",'Wellness') != false || strpos("'".$row['categories'][1]['name']."'",'Medicare') != false || strpos("'".$row['categories'][1]['name']."'",'Clinic') != false || strpos("'".$row['categories'][1]['name']."'",'BeLive') != false || strpos("'".$row['categories'][1]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][1]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][1]['name']."'",'International') != false || strpos("'".$row['categories'][1]['name']."'",'Regen') != false || strpos("'".$row['categories'][1]['name']."'",'Soul') != false || strpos("'".$row['categories'][1]['name']."'",'ALPS') != false || strpos("'".$row['categories'][1]['name']."'",'Home') != false || strpos("'".$row['categories'][1]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][1]['name']."'",'Thomson') != false || strpos("'".$row['categories'][1]['name']."'",'Prince') != false || strpos("'".$row['categories'][1]['name']."'",'Timberland') != false || strpos("'".$row['categories'][1]['name']."'",'Imperial') != false) {
                        $hospname = $row['categories'][1]['name'];

                }elseif (strpos("'".$row['categories'][0]['name']."'",'KPJ') != false || strpos("'".$row['categories'][0]['name']."'",'Sunway') != false || strpos("'".$row['categories'][0]['name']."'",'Healtopedia') != false || strpos("'".$row['categories'][0]['name']."'",'Disinfection') != false || strpos("'".$row['categories'][0]['name']."'",'Klinik') != false || strpos("'".$row['categories'][0]['name']."'",'Wellness') != false || strpos("'".$row['categories'][0]['name']."'",'Medicare') != false || strpos("'".$row['categories'][0]['name']."'",'Clinic') != false || strpos("'".$row['categories'][0]['name']."'",'BeLive') != false || strpos("'".$row['categories'][0]['name']."'",'BENPHYSIO') != false || strpos("'".$row['categories'][0]['name']."'",'CryoFit') != false || strpos("'".$row['categories'][0]['name']."'",'International') != false || strpos("'".$row['categories'][0]['name']."'",'Regen') != false || strpos("'".$row['categories'][0]['name']."'",'Soul') != false || strpos("'".$row['categories'][0]['name']."'",'ALPS') != false || strpos("'".$row['categories'][0]['name']."'",'Home') != false || strpos("'".$row['categories'][0]['name']."'",'Dokter4U') != false || strpos("'".$row['categories'][0]['name']."'",'Thomson') != false || strpos("'".$row['categories'][0]['name']."'",'Prince') != false || strpos("'".$row['categories'][0]['name']."'",'Timberland') != false || strpos("'".$row['categories'][0]['name']."'",'Imperial') != false) {
                        $hospname = $row['categories'][0]['name'];
                }
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
