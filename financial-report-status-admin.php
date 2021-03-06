<?php

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
session_start();
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php");
$hosp = $_SESSION['hospital'];
$cur_month = substr(date("F"), 0, 3);
$prev_month = substr(date('F', strtotime(date('Y-m') . " -1 month")), 0, 3);
$sel_year =  date("Y");
$sel_month = date("M");
$sel_hosp = $hosp;
$_SESSION['sel_year'] = date("Y");
$_SESSION['sel_month'] = date("M");
$_SESSION['sel_hosp'] = $sel_hosp;

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}
//$result = mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'completed' ORDER BY request_id");
//$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result = $conn->prepare("SELECT * FROM requestappoint WHERE req_status = 'completed' ORDER BY request_id");
$result->execute();
$data = $result->get_result()->fetch_assoc();

if (isset($_POST['sel_year']) or isset($_POST['sel_month']) or isset($_POST['sel_hosp'])) {

    $_SESSION['sel_year'] = ($_POST['sel_year'] != '') ? $_POST['sel_year'] : $_SESSION['sel_year'];
    $_SESSION['sel_month'] = ($_POST['sel_month'] != '') ? $_POST['sel_month'] : $_SESSION['sel_month'];
    $_SESSION['sel_hosp'] = ($_POST['sel_hosp'] != '') ? $_POST['sel_hosp'] : $_SESSION['sel_hosp'];
    $sel_year = ($_POST['sel_year'] != '') ? $_POST['sel_year'] : $_SESSION['sel_year'];
    $sel_month = ($_POST['sel_month'] != '') ? $_POST['sel_month'] : $_SESSION['sel_month'];
    $sel_hosp = ($_POST['sel_hosp'] != '') ? $_POST['sel_hosp'] : $_SESSION['sel_hosp'];

    if ($sel_month == 1) {
        $decsql = "SELECT SUM(c.package_price) AS 'Dec' 
                                FROM `orderwoo` a 
                                LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
                                WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ?
                                AND MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 12
                                ";
        $prev_year = (int)$sel_year - 1;
        $res1 = $conn->prepare($decsql);
        $res1->bind_param("ss", $sel_hosp, $prev_year);
        $res1->execute();
        $gross_revenue_prev = $res1->get_result()->fetch_assoc();
    }
    $sql = "SELECT SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 1, c.package_price, 0)) AS Jan,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 2 , c.package_price, 0)) AS Feb,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 3 , c.package_price, 0)) AS Mar,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 4 , c.package_price, 0)) AS Apr,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 5 , c.package_price, 0)) AS May,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 6 , c.package_price, 0)) AS Jun,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 7 , c.package_price, 0)) AS Jul,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 8 , c.package_price, 0)) AS Aug,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 9 , c.package_price, 0)) AS Sep,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 10 , c.package_price, 0)) AS 'Oct',
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 11, c.package_price, 0)) AS Nov,
                            SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 12 , c.package_price, 0)) AS 'Dec' 
                            FROM `orderwoo` a 
                            LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
                            WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = ? 
                            ";
    $res = $conn->prepare($sql);
    $res->bind_param("ss", $sel_hosp, $sel_year);
    $res->execute();
    $gross_revenue = $res->get_result()->fetch_all(MYSQLI_ASSOC);



    $sql2 = "SELECT
            SUBSTRING('Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ', (MONTH(FROM_UNIXTIME(b.end_appoint, '%Y-%m-%d')) * 4) - 3, 3) AS Month,
            SUM(c.package_price) AS Gross_revenue,
            COUNT(b.order_id) AS Appointments_per_mth
            FROM `orderwoo` a 
            LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
            WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(b.start_appoint, '%Y-%m-%d')) = ?  
            GROUP BY MONTH(FROM_UNIXTIME(b.end_appoint, '%Y-%m-%d'))";
    $res2 = $conn->prepare($sql2);
    $res2->bind_param("ss", $sel_hosp, $sel_year);
    $res2->execute();
    $monthly_revenue = $res2->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $sql = "SELECT SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 1, c.package_price, 0)) AS Jan,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 2 , c.package_price, 0)) AS Feb,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 3 , c.package_price, 0)) AS Mar,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 4 , c.package_price, 0)) AS Apr,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 5 , c.package_price, 0)) AS May,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 6 , c.package_price, 0)) AS Jun,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 7 , c.package_price, 0)) AS Jul,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 8 , c.package_price, 0)) AS Aug,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 9 , c.package_price, 0)) AS Sep,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 10 , c.package_price, 0)) AS 'Oct',
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 11, c.package_price, 0)) AS Nov,
                                SUM(IF(MONTH(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = 12 , c.package_price, 0)) AS 'Dec' 
                                FROM `orderwoo` a 
                                LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
                                WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d')) = YEAR(CURDATE())
                                ";
    $res = $conn->prepare($sql);
    $res->bind_param("s", $hosp);
    $res->execute();
    $gross_revenue = $res->get_result()->fetch_all(MYSQLI_ASSOC);

    $sql2 = "SELECT
            SUBSTRING('Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ', (MONTH(FROM_UNIXTIME(b.end_appoint, '%Y-%m-%d')) * 4) - 3, 3) AS Month,
            SUM(c.package_price) AS Gross_revenue,
            COUNT(b.order_id) AS Appointments_per_mth
            FROM `orderwoo` a 
            LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
            WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(b.start_appoint, '%Y-%m-%d')) = YEAR(CURDATE())
            GROUP BY MONTH(FROM_UNIXTIME(b.end_appoint, '%Y-%m-%d'))";
    $res2 = $conn->prepare($sql2);
    $res2->bind_param("s", $hosp);
    $res2->execute();
    $monthly_revenue = $res2->get_result()->fetch_all(MYSQLI_ASSOC);
}




//For Year and month filter here
$cur_year = date("Y");
$a_year = $conn->prepare("SELECT DISTINCT(YEAR(FROM_UNIXTIME(end_appoint, '%Y-%m-%d'))) AS year FROM appointwoo");
$a_year->execute();
$available_year = $a_year->get_result()->fetch_all(MYSQLI_ASSOC);

$monthArray = range(1, 12);
$cur_mth = date("n");
$formattedMonthArray = array(
    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report - Healtopedia Digital</title>

    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main" style="margin-top: -50px;">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last" style="padding: 10px;">
                            <h3>Financial Report</h3>
                            <h6><?php echo $formattedMonthArray[$sel_month] . " " . $sel_year . " at " . $sel_hosp ?></h6>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Financial Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <?php
                        $hosps = $conn->prepare("SELECT hosp_name FROM hospital");
                        $hosps->execute();
                        $hosp_list = $hosps->get_result()->fetch_all(MYSQLI_ASSOC);


                        ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body px-3 py-3">
                                    <h6>Please select from month to hospital</h6>
                                    <div class="row">
                                        <form method="post" action="" style="display: flex;" id="hosp_form">
                                            <div class="col">
                                                <select name="sel_month" class="form-select" onchange=selectChange1(this.value)>
                                                    <option value="">Select Month</option>
                                                    <?php
                                                    foreach ($monthArray as $month) {
                                                        // if you want to select a particular month
                                                        //$selected = ($month == $cur_mth) ? 'selected' : '';
                                                        // if you want to add extra 0 before the month uncomment the line below
                                                        //$month = str_pad($month, 2, "0", STR_PAD_LEFT);
                                                        //echo '<option ' . $selected . ' value="' . $month . '">' . $formattedMonthArray[$month] . '</option>';
                                                        echo '<option value="' . $month . '">' . $formattedMonthArray[$month] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="sel_year" class="form-select" onchange=selectChange(this.value)>
                                                    <option value="">Select Year</option>
                                                    <?php
                                                    foreach ($available_year as $year) {
                                                        // if you want to select a particular month
                                                        //$selected = ($year['year'] == $cur_year) ? 'selected' : '';
                                                        // if you want to add extra 0 before the month uncomment the line below
                                                        //$month = str_pad($month, 2, "0", STR_PAD_LEFT);
                                                        //echo '<option ' . $selected . ' value="' . $year['year'] . '">' . $year['year'] . '</option>';
                                                        echo '<option value="' . $year['year'] . '">' . $year['year'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col">
                                                <select name="sel_hosp" class="form-select" style="width:100%" onchange=selectChange2(this.value)>
                                                    <option value="">Select Hospital</option>
                                                    <?php foreach ($hosp_list as $hospital) { ?>
                                                        <option value="<?php echo $hospital['hosp_name'] ?>"><?php echo $hospital['hosp_name'] ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </form>


                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=" row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-3">
                                    <div class="row align-items-center">
                                        <?php foreach ($gross_revenue as $month => $value) : ?>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <h5 class="text-muted font-semibold" style="font-size: 1.1rem;">Gross Revenue</h5>
                                                </div>
                                                <?php
                                                $current_month = ($sel_month != '') ? substr($formattedMonthArray[$sel_month], 0, 3) : $cur_month;
                                                if ($sel_month == 1) {
                                                    $previous_month = 'Dec';
                                                    //var_dump($gross_revenue_prev[$previous_month]);
                                                    $prev_month_gross = $gross_revenue_prev[$previous_month];
                                                } else {
                                                    $previous_month = ($sel_month != '') ? substr($formattedMonthArray[$sel_month - 1], 0, 3) : $prev_month;
                                                    $prev_month_gross = $value[$previous_month];
                                                }
                                                //print_r($previous_month);


                                                ?>
                                                <div class="row">
                                                    <h5 class="font-bold" style="font-size: 1.1rem;">RM <?php echo $value[$current_month] ?>.00</h5>
                                                </div>
                                                <div class="row">
                                                    <h6 class="text-muted font-semibold">Previous Month</h6>
                                                </div>
                                                <div class="row">
                                                    <h6 class="font-bold">RM <?php echo $prev_month_gross ?>.00</h6>
                                                </div>

                                            </div>
                                            <?php
                                            $up_or_down = $value[$current_month] / (int)$prev_month_gross;
                                            if ($up_or_down >= 1) {
                                                $res = '+' .  sprintf('%.2f', $up_or_down * 100 - 100) . '%';
                                                $style = "color:green; font-weight:900; font-size:1.4rem;";
                                                $arrow = "up";
                                            } else {
                                                $res = '-' .  sprintf('%.2f', 1 / $up_or_down * 100) . '%';
                                                $style = "color:red; font-weight:900; font-size:1.4rem;";
                                                $arrow = "down";
                                            }
                                            ?>
                                        <?php endforeach ?>
                                        <div class="col-md-5" style="text-align: center;">
                                            <i class="fa-4x bi bi-graph-<?php echo $arrow; ?>" style="<?php echo $style; ?>">

                                            </i>
                                            <span style="margin:0; font-style: normal; <?php echo $style; ?>"><?php echo $res; ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <h5 class="text-muted font-semibold" style="font-size: 1.1rem;">Refunds</h5>
                                            </div>
                                            <div class="row">
                                                <h5 class="font-bold" style="font-size: 1.1rem;">RM 0.00</h5>
                                            </div>
                                            <div class="row">
                                                <h6 class="text-muted font-semibold">Previous Month</h6>
                                            </div>
                                            <div class="row">
                                                <h6 class="font-bold">RM 102.00</h6>
                                            </div>

                                        </div>
                                        <div class="col-md-5">
                                            <i class="bi bi-graph-up">
                                                <span style="margin:0; font-style: normal;">+102.00%</span>
                                            </i>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <h5 class="text-muted font-semibold" style="font-size: 1.1rem;">Net Revenue</h5>
                                            </div>
                                            <div class="row">
                                                <h5 class="font-bold" style="font-size: 1.1rem;">RM 19023.00</h5>
                                            </div>
                                            <div class="row">
                                                <h6 class="text-muted font-semibold">Previous Month</h6>
                                            </div>
                                            <div class="row">
                                                <h6 class="font-bold">RM 16302.00</h6>
                                            </div>

                                        </div>
                                        <div class="col-md-5">
                                            <i class="bi bi-graph-up">
                                                <span style="margin:0; font-style: normal;">+16.69%</span>
                                            </i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="font-bold" style="font-size: 1.1rem;"> Monthly Chart</h5>
                                </div>
                                <div class="card-body">
                                    <div id="chart-monthly-revenue"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-header">
                                <div class="card-header" style="border-bottom: none; padding: 1.0rem;">
                                    <h5 class="font-bold">Monthly Revenue</h5>
                                </div>
                                <div class="card-body" style="overflow: auto; padding: 0rem;  max-height:360px;">
                                    <table id="report_table" cellspacing="0" class="table table-striped table-sm" style="font-size: 1rem;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Month</th>
                                                <th scope="col">Gross Revenue</th>
                                                <th scope="col">Refund</th>
                                                <th scope="col">Net Revenue</th>
                                                <th scope="col">Appointment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($monthly_revenue as $value) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $value['Month'] ?></th>
                                                    <td>RM <?php echo $value['Gross_revenue'] ?>.00</td>
                                                    <td>RM 0</td>
                                                    <td>RM 500.00</td>
                                                    <td><?php echo $value['Appointments_per_mth'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
            <script src="assets/vendors/apexcharts/apexcharts.js"></script>
            <script>
                var month_revenue = []
                var months = [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
                var MonthlyRevenue = {
                    annotations: {
                        position: 'back'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    chart: {
                        type: 'bar',
                        height: 300
                    },
                    fill: {
                        opacity: 1
                    },
                    plotOptions: {
                        /*
                        Uncomment this line if want horizontal bar
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                        }
                        */
                    },
                    series: [{
                        name: 'Gross Revenue(RM)',
                        data: month_revenue
                    }],
                    colors: '#435ebe',
                    xaxis: {
                        categories: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec'
                        ]
                    }

                }

                var ChartMonthlyRevenue = new ApexCharts(
                    document.querySelector('#chart-monthly-revenue'),
                    MonthlyRevenue
                )
                ChartMonthlyRevenue.render()

                $.getJSON('month_revenue_chart_admin.php', function(jsonObject) {
                    let i = 0
                    for (let x in months) {
                        if (i < 12) {
                            month_revenue.push(parseInt(jsonObject[x]))
                        }
                        i += 1
                    }
                    ChartMonthlyRevenue.updateSeries([{
                        name: 'Gross Revenue(RM)',
                        data: month_revenue
                    }])
                    console.log(month_revenue);
                    window.dispatchEvent(new Event('resize'))
                })

                //setTimeout(load_chart(), 500)
                //window.onload = load_chart()
                //console.log(month_revenue)
                /*
                $(document).ready(function() {
                    load_chart()
                });
                */
            </script>
            <?php

            $result = $conn->prepare("SELECT datedisable FROM xdate");
            $result->execute();
            $user = $result->get_result()->fetch_all(MYSQLI_ASSOC);
            ?>
            <script>
                function selectChange(val) {
                    //Set the value of action in action attribute of form element.
                    //Submit the form
                    $('#year_form').submit();

                }

                function selectChange1(val) {
                    //Set the value of action in action attribute of form element.
                    //Submit the form
                    $('#month_form').submit();

                }

                function selectChange2(val) {
                    //Set the value of action in action attribute of form element.
                    //Submit the form
                    $('#hosp_form').submit();

                }
            </script>
            <script src="assets/vendors/choices.js/choices.min.js"></script>
            <script src="assets/js/main.js"></script>
            <?php include 'request-appointment-footer.php'; ?>