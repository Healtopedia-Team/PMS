<?php

$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
session_start();
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php");
$hosp = $_SESSION['hospital'];
session_start();
$current_month = substr(date("F"), 0, 3);
$previous_month = substr(date('F', strtotime(date('Y-m') . " -1 month")), 0, 3);
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
    WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = YEAR(CURDATE())";
$res = $conn->prepare($sql);
$res->bind_param("s", $hosp);
$res->execute();
$gross_revenue = $res->get_result()->fetch_all(MYSQLI_ASSOC);
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
                    <?php foreach ($gross_revenue as $month) : ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <h5 class="text-muted font-semibold" style="font-size: 1.1rem;">Gross Revenue</h5>
                                                </div>
                                                <div class="row">
                                                    <h5 class="font-bold" style="font-size: 1.1rem;">RM <?php echo $month[$current_month] ?>.00</h5>
                                                </div>
                                                <div class="row">
                                                    <h6 class="text-muted font-semibold">Previous Month</h6>
                                                </div>
                                                <div class="row">
                                                    <h6 class="font-bold">RM <?php echo $month[$previous_month] ?>.00</h6>
                                                </div>

                                            </div>
                                            <?php
                                            $up_or_down = sprintf('%.2f', $month[$current_month] / $month[$previous_month]);
                                            if ($up_or_down >= 1) {
                                                $res = '+' . $up_or_down * 100 . '%';
                                                $style = "color:green;";
                                                $arrow = "up";
                                            } else {
                                                $res = '-' . $up_or_down * 100 . '%';
                                                $style = "color:red;";
                                                $arrow = "down";
                                            }
                                            ?>
                                            <div class="col-md-5">
                                                <i class="bi bi-graph-<?php echo $arrow; ?>" style="<?php echo $style; ?>">
                                                    <span style="margin:0; font-style: normal;"><?php echo $res; ?></span>
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
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-4 py-3">
                                        <div class="row">
                                            <h5 class="font-bold" style="font-size: 1.1rem;">Chart</h6>
                                        </div>
                                        <div class="row"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body px-4 py-3">
                                        <div class="row">
                                            <h5 class="font-bold">Daily Revenue</h6>
                                        </div>
                                        <div class="row px-4 py-1" style="position: relative; height: 380px; overflow: auto; display: block;">
                                            <table id="report_table" cellspacing="0" class="table table-striped table-sm" style="font-size: 0.9rem;padding: 0.5rem;">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Gross Revenue</th>
                                                        <th scope="col">Refund</th>
                                                        <th scope="col">Net Revenue</th>
                                                        <th scope="col">Appointment</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">22nd</th>
                                                        <td>RM 500.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 500.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">23rd</th>
                                                        <td>RM 1000.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 1000.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">24th</th>
                                                        <td>RM 500.00</td>
                                                        <td>RM 100</td>
                                                        <td>RM 400.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">25th</th>
                                                        <td>RM 1500.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 1500.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">22nd</th>
                                                        <td>RM 500.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 500.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">23rd</th>
                                                        <td>RM 1000.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 1000.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">24th</th>
                                                        <td>RM 500.00</td>
                                                        <td>RM 100</td>
                                                        <td>RM 400.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">25th</th>
                                                        <td>RM 1500.00</td>
                                                        <td>RM 0</td>
                                                        <td>RM 1500.00</td>
                                                        <td>4</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </section>
            </div>

            <?php include 'request-appointment-footer.php'; ?>