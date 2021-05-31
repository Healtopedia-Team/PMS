<?php

$custid = $_GET['custid'];
$orderid = $_GET['orderid'];

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

$response = curl_exec($curl);
$response2 = curl_exec($curl2);

$err = curl_error($curl);
$err2 = curl_error($curl2);

curl_close($curl);
curl_close($curl2);

if (!$err) {
    $data = json_decode("[" . $response . "]", true);
} else {
    echo "cURL Error #:" . $err;
}

if (!$err2) {
    $data2 = json_decode("[" . $response2 . "]", true);
} else {
    echo "cURL Error #:" . $err2;
}

$data3 = file_get_contents('https://pms.healtopedia.com/appointmentjson.php');
$data3 = json_decode($data3, true);

if (isset($_POST['refund'])) {
    $price = $_POST['refprice'];
    $refid = $_POST['refid'];
    $refname = $_POST['refname'];

    $sql = "INSERT INTO refund SET order_id = '$order_id', prod_id = '$refid', prod_name = '$refname', prod_price = '$refprice'";
    mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Healtopedia Digital</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <style>
        div.quest {
            float: left;
            width: 30%;
            font-weight: bold;
        }

        div.ans {
            float: right;
            width: 70%;

        }
    </style>
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main" style="margin-top: -70px;">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Order Details for #<?php echo $orderid ?></h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Setting</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <?php foreach ($data as $key) { ?>
                        <h3>
                            <?php echo $key['billing']['first_name'] . " ";
                            echo $key['billing']['last_name'] . " - ";
                            echo $key['status'];
                            $count = 0;
                            for ($i = 0; $i < 100; $i++) {
                                if (count($key['line_items'][$count]['meta_data'][0]['value']) != "") {
                                    $total = $count + count($key['line_items'][$i]['meta_data'][0]['value']);
                                    $count++;
                                }
                            } ?>
                        </h3>
                        <br>
                        <div class="row">
                            <?php foreach ($data as $key) {
                                for ($q = 0; $q < 1; $q++) { ?>
                                    <div class="row match-height">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Personal Details</h4>
                                                    <hr>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body" style="margin-top: -40px;">
                                                        <div class="quest">Phone No :</div>
                                                        <div class="ans"><?php echo $key['billing']['phone']; ?></div>

                                                        <div class="quest">IC/Passport :</div>
                                                        <div class="ans">
                                                            <?php
                                                            if ($key['meta_data'][0]['key'] == "_billing_ic_passport_no") {
                                                                echo $key['meta_data'][$q]['value'];
                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_ic_passport_no") {
                                                                echo $key['meta_data'][1]['value'];
                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_ic_passport_no") {
                                                                echo $key['meta_data'][2]['value'];
                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_ic_passport_no") {
                                                                echo $key['meta_data'][3]['value'];
                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_ic_passport_no") {
                                                                echo $key['meta_data'][4]['value'];
                                                            } else {
                                                                echo "No Data";
                                                            } ?>
                                                        </div>

                                                        <div class="quest">Nationality :</div>
                                                        <div class="ans">
                                                            <?php
                                                            if ($key['meta_data'][0]['key'] == "_billing_nationality_") {
                                                                echo $key['meta_data'][$q]['value'];
                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_nationality_") {
                                                                echo $key['meta_data'][1]['value'];
                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_nationality_") {
                                                                echo $key['meta_data'][2]['value'];
                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_nationality_") {
                                                                echo $key['meta_data'][3]['value'];
                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_nationality_") {
                                                                echo $key['meta_data'][4]['value'];
                                                            } else {
                                                                echo "No Data";
                                                            } ?>
                                                        </div>

                                                        <div class="quest">Gender :</div>
                                                        <div class="ans">
                                                            <?php
                                                            if ($key['meta_data'][0]['key'] == "_billing_gender") {
                                                                echo $key['meta_data'][$q]['value'];
                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_gender") {
                                                                echo $key['meta_data'][1]['value'];
                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_gender") {
                                                                echo $key['meta_data'][2]['value'];
                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_gender") {
                                                                echo $key['meta_data'][3]['value'];
                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_gender") {
                                                                echo $key['meta_data'][4]['value'];
                                                            } else {
                                                                echo "No Data";
                                                            } ?>
                                                        </div>

                                                        <div class="quest">Birthdate :</div>
                                                        <div class="ans">
                                                            <?php
                                                            if ($key['meta_data'][0]['key'] == "_billing_date_of_birth") {
                                                                echo $key['meta_data'][$q]['value'];
                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_date_of_birth") {
                                                                echo $key['meta_data'][1]['value'];
                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_date_of_birth") {
                                                                echo $key['meta_data'][2]['value'];
                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_date_of_birth") {
                                                                echo $key['meta_data'][3]['value'];
                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_date_of_birth") {
                                                                echo $key['meta_data'][4]['value'];
                                                            } else {
                                                                echo "No Data";
                                                            } ?>
                                                        </div>

                                                        <div class="quest">Email :</div>
                                                        <div class="ans"><?php echo $key['billing']['email']; ?></div>

                                                        <div class="quest">Billing Address :</div>
                                                        <div class="ans">
                                                            <?php echo $key['billing']['address_1'] . ", ";
                                                            echo $key['billing']['address_2'] . ", ";
                                                            echo $key['billing']['postcode'] . ", ";
                                                            echo $key['billing']['city']; ?>
                                                            <br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }} ?>
                            </div>
                            <?php foreach ($data as $key) {
                                for ($q = 0; $q < 10; $q++) {
                                    if ($key['line_items'][$q]['name'] != "") { ?>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Appointment(s) Details</h4>
                                                <hr>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body" style="margin-top: -40px;">

                                                    <div>
                                                        <h5><span class="badge bg-light-primary"><?php echo $prodname = $key['line_items'][$q]['name']; ?></span><br></h5>
                                                    </div>

                                                    <div class="quest">Package Fee :</div>
                                                    <div class="ans"><?php $totalori = $key['line_items'][$q]['subtotal'];
                                                    echo "RM " . $totalori; ?></div>

                                                    <div class="quest">Payment via :</div>
                                                    <div class="ans"><?php echo $key['payment_method_title']; ?></div>

                                                    <?php foreach ($data2 as $key2) { ?>
                                                        <div class="quest">Appointment Date:</div>
                                                        <div class="ans"><?php echo date("d-m-Y", $key2['start'] - 28800); ?></div>

                                                        <div class="quest">Appointment Time :</div>
                                                        <div class="ans">
                                                            <?php echo date("h:i A", $key2['start'] - 28800);
                                                            $prodid = $key2['product_id'];
                                                            } ?>
                                                                
                                                        </div>

                                                        <ul class="list-group" style="width: fit-content; margin-top: 30px;">
                                                            <li class="list-group-item" style="margin-top: 20px;">
                                                                <?php 
                                                                    if ($key['line_items'][$q]['id']) {
                                                                        if ($key['line_items'][$q]['meta_data'][0]['key'] == "Full Name") {
                                                                            $tickname = $key['line_items'][$q]['meta_data'][0]['value']; ?>
                                                                            <div class="quest">Attendee Name :</div>
                                                                            <div class="ans"><?php echo $tickname; ?></div>
                                                                <?php   } else { 
                                                                            $tickname = $key['billing']['first_name']." ".$key['billing']['last_name']; ?>
                                                                    <div class="quest">Attendee Name :</div>
                                                                            <div class="ans"><?php echo $tickname; ?></div>
                                                                <?php   }
                                                                    foreach ($data3 as $key3) {
                                                                        if ($key3['order_id'] == $orderid && $key3['order_item_id'] == $key['line_items'][$q]['id']) {
                                                                            $appid = $key3['id'];
                                                                        }
                                                                    } ?>
                                                                    <div class="quest">IC/ Passport :</div>
                                                                    <div class="ans">
                                                                        <?php if ($key['line_items'][$q]['meta_data'][1]['key'] == "IC / Passport No.") {
                                                                            $icpass = $key['line_items'][$q]['meta_data'][1]['value'];
                                                                            echo $icpass;
                                                                        } else {
                                                                            if ($key['meta_data'][0]['key'] == "_billing_ic_passport_no") {
                                                                                $icpass = $key['meta_data'][$q]['value'];
                                                                                echo $icpass;
                                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_ic_passport_no") {
                                                                                $icpass = $key['meta_data'][1]['value'];
                                                                                echo $icpass;
                                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_ic_passport_no") {
                                                                                $icpass = $key['meta_data'][2]['value'];
                                                                                echo $icpass;
                                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_ic_passport_no") {
                                                                                $icpass = $key['meta_data'][3]['value'];
                                                                                echo $icpass;
                                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_ic_passport_no") {
                                                                                $icpass = $key['meta_data'][4]['value'];
                                                                                echo $icpass;
                                                                            } else {
                                                                                echo "No Data";
                                                                            }
                                                                        } ?>
                                                                    </div>
                                                                    <div class="quest">Gender :</div>
                                                                    <div class="ans">
                                                                        <?php if ($key['line_items'][$q]['meta_data'][2]['key'] == "Gender") {
                                                                            echo $key['line_items'][$q]['meta_data'][2]['value'];
                                                                        } else {
                                                                            if ($key['meta_data'][0]['key'] == "_billing_gender") {
                                                                                echo $key['meta_data'][$q]['value'];
                                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_gender") {
                                                                                echo $key['meta_data'][1]['value'];
                                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_gender") {
                                                                                echo $key['meta_data'][2]['value'];
                                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_gender") {
                                                                                echo $key['meta_data'][3]['value'];
                                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_gender") {
                                                                                echo $key['meta_data'][4]['value'];
                                                                            } else {
                                                                                echo "No Data";
                                                                            }
                                                                        } ?>
                                                                    </div>
                                                                    <div class="quest">Birth Date :</div>
                                                                    <div class="ans">
                                                                        <?php if ($key['line_items'][$q]['meta_data'][3]['key'] == "Date of Birth") {
                                                                            echo $key['line_items'][$q]['meta_data'][3]['value'];
                                                                        } else {
                                                                            if ($key['meta_data'][0]['key'] == "_billing_date_of_birth") {
                                                                                echo $key['meta_data'][$q]['value'];
                                                                            } elseif ($key['meta_data'][1]['key'] == "_billing_date_of_birth") {
                                                                                echo $key['meta_data'][1]['value'];
                                                                            } elseif ($key['meta_data'][2]['key'] == "_billing_date_of_birth") {
                                                                                echo $key['meta_data'][2]['value'];
                                                                            } elseif ($key['meta_data'][3]['key'] == "_billing_date_of_birth") {
                                                                                echo $key['meta_data'][3]['value'];
                                                                            } elseif ($key['meta_data'][4]['key'] == "_billing_date_of_birth") {
                                                                                echo $key['meta_data'][4]['value'];
                                                                            } else {
                                                                                echo "No Data";
                                                                            }
                                                                        } ?>
                                                                    </div>
                                                                    <div class="quest">Nationality :</div>
                                                                    <div class="ans">
                                                                        <?php if ($key['line_items'][$q]['meta_data'][4]['key'] == "Nationality") {
                                                                            echo $key['line_items'][$q]['meta_data'][4]['value'];
                                                                        } else {
                                                                            if ($key['meta_data'][0]['key'] == "_billing_nationality_") {
                                                                            echo $key['meta_data'][$q]['value'];
                                                                        } elseif ($key['meta_data'][1]['key'] == "_billing_nationality_") {
                                                                            echo $key['meta_data'][1]['value'];
                                                                        } elseif ($key['meta_data'][2]['key'] == "_billing_nationality_") {
                                                                            echo $key['meta_data'][2]['value'];
                                                                        } elseif ($key['meta_data'][3]['key'] == "_billing_nationality_") {
                                                                            echo $key['meta_data'][3]['value'];
                                                                        } elseif ($key['meta_data'][4]['key'] == "_billing_nationality_") {
                                                                            echo $key['meta_data'][4]['value'];
                                                                        } else {
                                                                            echo "No Data";
                                                                        }
                                                                        } ?>
                                                                    </div>
                                                                    <div class="quest">Method :</div>
                                                                    <div class="ans">
                                                                        <?php if ($key['line_items'][$q]['meta_data'][5]['key'] == "Appointment Method") {
                                                                            echo $key['line_items'][$q]['meta_data'][5]['value'];
                                                                        } else echo "None";
                                                                    } ?>
                                                                    </div>
                                                                    <?php
                                                                    $appdate = date("Y-m-d", $key2['start'] - 28800);
                                                                    $currdate = date("Y-m-d");
                                                                    $yesterday = date('Y-m-d',strtotime("-1 days"));
                                                                    if ($appdate > $yesterday) { ?>
                                                                    <a href="ticket.php?orderid=<?php echo $orderid ?>&custid=<?php echo $custid ?>&prodid=<?php echo $prodid ?>&namecust=<?php echo $tickname ?>&icpass=<?php echo $icpass ?>" target="_blank"><button class="btn rounded-pill btn-primary" style="margin-top: 10px; float: left;">Get Ticket</button></a>
                                                                    <?php } ?>
                                                                    <form method="POST">
                                                                        <button type="submit" class="btn rounded-pill btn-warning" name="refund" style="margin-top: 10px; float: left;color: black">Request Refund</button>
                                                                        <input type="text" name="refprice" value="<?php echo $totalori;?>">
                                                                        <input type="text" name="refid" value="<?php echo $prodid;?>">
                                                                        <input type="text" name="refname" value="<?php echo $prodname;?>">
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                        <footer>
                            <div class="footer clearfix mb-0 text-muted">
                                <div class="float-start">
                                    <p>2021 &copy; Mazer</p>
                                </div>
                                <div class="float-end">
                                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
                <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
                <script src="assets/js/bootstrap.bundle.min.js"></script>
                <script src="assets/js/main.js"></script>
</body>
</html>
