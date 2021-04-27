<?php

$custid = $_GET['custid'];
$orderid = $_GET['orderid'];
$prodid = $_GET['prodid'];
$appid = $_GET['appid'];
$namecust = $_GET['namecust'];
$icpass = $_GET['icpass'];

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc/v3/orders/$orderid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25221ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D; xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522219.92.24.236%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25221ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Petaling%2520Jaya%2522%252C%2522region%2522%253A%2522Selangor%2522%252C%2522regionCode%2522%253A%252210%2522%252C%2522regionName%2522%253A%2522Selangor%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.1071%2522%252C%2522longitude%2522%253A%2522101.6139%2522%252C%2522locationAccuracyRadius%2522%253A%252210%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.043%257D; xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522219.92.24.236%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25220ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Petaling%2520Jaya%2522%252C%2522region%2522%253A%2522Selangor%2522%252C%2522regionCode%2522%253A%252210%2522%252C%2522regionName%2522%253A%2522Selangor%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.1071%2522%252C%2522longitude%2522%253A%2522101.6139%2522%252C%2522locationAccuracyRadius%2522%253A%252210%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.043%257D; wordpress_test_cookie=WP%2520Cookie%2520check; _lscache_vary=f1cd6236943d530d286e26ed5d4b34af",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl2 = curl_init();

curl_setopt_array($curl2, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/$custid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl3 = curl_init();

curl_setopt_array($curl3, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc/v3/products/$prodid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25221ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D; xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522219.92.24.236%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25221ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Petaling%2520Jaya%2522%252C%2522region%2522%253A%2522Selangor%2522%252C%2522regionCode%2522%253A%252210%2522%252C%2522regionName%2522%253A%2522Selangor%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.1071%2522%252C%2522longitude%2522%253A%2522101.6139%2522%252C%2522locationAccuracyRadius%2522%253A%252210%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.043%257D; xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522219.92.24.236%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25220ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Petaling%2520Jaya%2522%252C%2522region%2522%253A%2522Selangor%2522%252C%2522regionCode%2522%253A%252210%2522%252C%2522regionName%2522%253A%2522Selangor%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.1071%2522%252C%2522longitude%2522%253A%2522101.6139%2522%252C%2522locationAccuracyRadius%2522%253A%252210%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.043%257D; wordpress_test_cookie=WP%2520Cookie%2520check",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$response2 = curl_exec($curl2);
$response3 = curl_exec($curl3);

$err = curl_error($curl);
$err2 = curl_error($curl2);
$err3 = curl_error($curl3);

curl_close($curl);
curl_close($curl2);
curl_close($curl3);

if (!$err) {
  $data = json_decode("[".$response."]", true);
  echo "<script>window.print();</script>";
} else {
  echo "cURL Error #:" . $err;
}

if (!$err2) {
  $data2 = json_decode("[".$response2."]", true);
} else {
  echo "cURL Error #:" . $err2;
}

if (!$err3) {
  $data3 = json_decode("[".$response3."]", true);
} else {
  echo "cURL Error #:" . $err3;
}

?>
<html>
   <head>
    <title>Order Ticket</title>
      <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link href="style.css" rel="stylesheet">
      <script type="text/javascript" src="26cc8070-9139-11eb-8b25-0cc47a792c0a_id_26cc8070-9139-11eb-8b25-0cc47a792c0a_files/wz_jsgraphics.js"></script>
   </head>
   <body>
      <div style="position:absolute;left:50%;margin-left:-306px;top:0px;width:625px;height:197px;border-style:outset;overflow:hidden">
         <div style="position:absolute;left:0px;top:0px">
            <img src="background1.png" width=625 height=197>
         </div>
         <div style="position:absolute;left:441px;top:10px;text-align: center;width: 180px;" class="cls_006">
            <span class="cls_006" style="text-align: center;">
              <?php foreach ($data3 as $key3) {
                echo $key3['name'];
              }
              ?>
            </span>
         </div>
         <div style="position:absolute;left:85px;top:39.61px" class="cls_004">
            <span class="cls_004">BOOKING CONFIRMATION</span>
         </div>
         <div style="position:absolute;left:84.58px;top:68px" class="cls_002">
            <span class="cls_002">Name:</span>
            <span class="cls_006">
              <?php echo $namecust;?>
            </span>
         </div>
         <div style="position:absolute;left:86.18px;top:82.88px" class="cls_002">
            <span class="cls_002">ID No:</span>
            <span class="cls_006">
              <?php echo $icpass;?>
            </span>
         </div>
         <div style="position:absolute;left:492px;top:70px" class="cls_005">
            <span class="cls_005">PAID</span>
         </div>
         <div style="position:absolute;left:84.58px;top:97.26px" class="cls_002">
            <span class="cls_002">Appointment Date:</span>
            <span class="cls_006">
              <?php foreach ($data2 as $key2) {
                  echo date("d-m-Y", $key2['start']-28800);?>
            </span>
         </div>
         <div style="position:absolute;left:131px;top:112.26px" class="cls_002">
            <span class="cls_002">Time Slot:</span>
            <span class="cls_006">
              <?php 
                date("H:i", $key2['start']-28800);
                ob_start();
                $date = date("H:i", $key2['start']-28800);
                ob_end_clean();
                if ($date > 12) {
                  error_reporting(0);
                  $newdate = date("H:i", $key2['start']-72000);
                  echo $newdate." PM";
                }else if ($date == "12:00") {
                  echo $date." PM";
                }else{
                  echo $date." AM";
                }
              } ?>
            </span>
         </div>
         <div style="position:absolute;left:458px;top:122.11px;text-align: center;" class="cls_007">
            <span class="cls_007">Order No:</span>
            <span class="cls_008">
              <?php
              foreach ($data3 as $key3){
                if ($key3['categories'][2]['name'] == "Kuala Lumpur"){
                  $state = "KL";
                }elseif ($key3['categories'][2]['name'] == "Johor Bahru") {
                  $state = "JB";
                }else{
                  $state = strtoupper($key3['categories'][2]['name']);
                }

                if ($key3['categories'][1]['name'] != "COVID-19 Test") {
                  echo "HS / ".$state." / ".$appid;
                }else{
                  echo "CV19 / ".$state." / ".$appid;
                }
              }
              ?>
            </span>
         </div>
         <div style="position:absolute;left:10.80px;top:137.27px" class="cls_009">
            <span class="cls_009">IMPORTANT</span><span class="cls_010">: AT ALL TIMES HAVE THIS BOOKING CONFIRMATION AND</span>
         </div>
         <div style="position:absolute;left:479px;top:140px" class="cls_014">
            <span class="cls_014">*Individual Booking</span>
         </div>
         <div style="position:absolute;left:10.80px;top:149.27px" class="cls_010">
            <span class="cls_010">BRING IT WITH YOU ON YOUR TRIP ALONG WITH VALID GOVERNMENT ID</span>
         </div>
         <div style="position:absolute;left:10.80px;top:163.47px" class="cls_012">
            <span class="cls_012">CUSTOMER SERVICE :</span>
         </div>
         <div style="position:absolute;left:356px;top:178px" class="cls_012">
            <span class="cls_012">+6014- 204 4287</span>
         </div>
         <div style="position:absolute;left:520px;top:170px" class="cls_002">
            <span class="cls_002">Healtopedia</span>
         </div>
         <div style="position:absolute;left:30px;top:175.74px" class="cls_012">
            <span class="cls_012">LIVE CHAT on my.HEALTOPEDIA.com</span>
         </div>
         <div style="position:absolute;left:202.86px;top:176.33px" class="cls_012">
            <span class="cls_012">booking@healtopedia.com</span>
         </div>
      </div>
   </body>
</html>
