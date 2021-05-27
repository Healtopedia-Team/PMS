<?php
header("refresh: 60");

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$data = mysqli_query($conn, "SELECT * FROM appointwoo");
$result = mysqli_fetch_all($data, MYSQLI_ASSOC);

$data2 = mysqli_query($conn, "SELECT * FROM requestappoint");
$result2 = mysqli_fetch_all($data2, MYSQLI_ASSOC);

foreach ($result as $row) {
    $appointid = $row['appoint_id'];
    $hospname = $row['hosp_name'];
    $startapp = date('Y-m-d H:i',$row['start_appoint']-28800);
    $endapp = date('Y-m-d H:i',$row['end_appoint']-28800);
    $statusapp = $row['statusapp'];

    $valid = mysqli_query($conn, "SELECT COUNT(*) as Total FROM calendar WHERE cal_id = '$appointid'");
    $ans = mysqli_fetch_all($valid, MYSQLI_ASSOC);

    foreach ($ans as $key) {
        if ($key['Total'] < 1) {
            $sql = "INSERT INTO calendar SET cal_id = '$appointid', cal_name = '$hospname', cal_start = '$startapp', cal_end = '$endapp', cal_status = '$statusapp'";
            mysqli_query($conn, $sql);
        }
    }
}

foreach ($result2 as $row2) {
    $reqid = $row2['request_id'];
    $packname = $row2['req_packname'];
    $appdate = $row2['req_appdate'];
    $status = $row2['req_status'];

    if ($row2['req_apptime'] == "09:00AM")
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

    $valid2 = mysqli_query($conn, "SELECT COUNT(*) as Total FROM calendar WHERE cal_id = '$reqid'");
    $ans2 = mysqli_fetch_all($valid2, MYSQLI_ASSOC);

    foreach ($ans2 as $key2) {
        if ($key2['Total'] < 1) {
            $sql2 = "INSERT INTO calendar SET cal_id = '$reqid', cal_name = '$packname', cal_start = '$start', cal_end = '$end', cal_status = '$status'";
            mysqli_query($conn, $sql2);
        }
    }
}
?>
