<?php include 'dbconnect.php';
//include('database/ChatUser.php');


session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
  header("location: auth-login.php");
  exit;
}
// Load the data for chat_user once logged in and then saved into session
/*
if ($_SESSION["loggedin"] === true) {
    $user_object = new ChatUser;
    $user_object->setUserEmail($_SESSION['email']);
    $user_data = $user_object->get_user_data_by_email();
    //print_r($user_data);
    if (is_array($user_data) && count($user_data) > 0) {
        if ($user_data['password'] == $_POST['password']) {
            $user_object->setUserId($user_data['user_id']);
            $user_object->setUserStatus("online");
            $user_object->setUserLoginStatus('Login');
            $user_token = md5(uniqid());
            //print_r($user_token);
            $user_object->setUserToken($user_token);
            if ($user_object->update_user_login_data()) {
                //echo '<script>alert("Session data is inserted here")</script>';
                //print_r($user_data);
                $_SESSION['user_data'][$user_data['user_id']] = [
                    'id'    =>  $user_data['user_id'],
                    'name'  =>  $user_data['username'],
                    'first_name' => $user_data['first_name'],
                    'last_name' => $user_data['last_name'],
                    'profile'   =>  $user_data['user_profile'],
                    'token' =>  $user_token,
                ];
                //header('location:privatechat.php');
            } else {
                //echo "update is wrong";
                //echo '<script>console.log("Session data is not inserted here")</script>';
            }
        } 
    } 
}
*/

$timestamp = strtotime('today midnight +8 hour');
$timestamp2 = strtotime('tomorrow midnight +8 hour');

$result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,appointwoo.appoint_id,appointwoo.prod_id,FROM_UNIXTIME(appointwoo.start_appoint) AS start_appoint,appointwoo.statusapp,appointwoo.order_id FROM orderwoo LEFT JOIN appointwoo ON orderwoo.order_id=appointwoo.order_id WHERE appointwoo.start_appoint BETWEEN '$timestamp' AND '$timestamp2'");
$appointment = mysqli_fetch_all($result, MYSQLI_ASSOC);
/*
$hosp = $_SESSION["hospital"];
$result2 = mysqli_query($conn, "SELECT prod_id, COUNT(*) FROM appointwoo GROUP BY prod_id ORDER BY 2 DESC");
$hospital_list = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$result3 = mysqli_query($conn, "SELECT * FROM packagewoo");
$hospital_list2 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
$result = $conn->prepare("SELECT orderwoo.firstname,orderwoo.lastname,appointwoo.appoint_id,
    FROM_UNIXTIME(appointwoo.start_appoint) AS start_appoint,appointwoo.statusapp,appointwoo.order_id 
    FROM orderwoo LEFT JOIN appointwoo ON orderwoo.order_id=appointwoo.order_id 
    WHERE appointwoo.start_appoint BETWEEN ? AND ? ");
$result->bind_param("ss", $timestamp, $timestamp2);
$result->execute();
$appointment = $result->get_result()->fetch_all(MYSQLI_ASSOC);
*/
$hosp = $_SESSION["hospital"];
$heal = "Healtopedia";
if(strpos($hosp, $heal) !== false){
  
  $result2 = $conn->prepare("SELECT prod_id, COUNT(*) FROM appointwoo GROUP BY prod_id ORDER BY 2 DESC");
  $result2->execute();
  $hospital_list = $result2->get_result()->fetch_all(MYSQLI_ASSOC);
  
  $result3 = $conn->prepare("SELECT * FROM packagewoo");
  $result3->execute();
  $hospital_list2 = $result3->get_result()->fetch_all(MYSQLI_ASSOC);
}
else{
  $result2 = $conn->prepare("SELECT prod_id, COUNT(*) FROM appointwoo WHERE hosp_name=? GROUP BY prod_id ORDER BY 2 DESC");
  $result2->bind_param("s", $hosp);
  $result2->execute();
  $hospital_list = $result2->get_result()->fetch_all(MYSQLI_ASSOC);
  
  $result3 = $conn->prepare("SELECT * FROM packagewoo");
  $result3->execute();
  $hospital_list2 = $result3->get_result()->fetch_all(MYSQLI_ASSOC);
}


$sql = "SELECT SUM(c.package_price) AS month_rev
  FROM `orderwoo` a 
  LEFT JOIN appointwoo b ON a.order_id=b.order_id LEFT JOIN packagewoo c ON b.prod_id=c.package_id  
  WHERE b.hosp_name=? AND a.status='completed' AND YEAR(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = YEAR(CURDATE()) 
  AND MONTH(FROM_UNIXTIME(start_appoint, '%Y-%m-%d')) = MONTH(CURDATE())";
$res = $conn->prepare($sql);
$res->bind_param("s", $hosp);
$res->execute();
$month_gross_revenue = $res->get_result()->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Patient Management System</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Added for the notification system use-->

  <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
  <div id="app">
    <?php include 'sidebar.php'; ?>

    <div id="main" style="margin-top: -90px;">

      <div class="page-heading">
        <h3>Dashboard</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="section">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <div class="card">
                  <div class="card-body px-3 py-4-5">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="stats-icon purple">
                          <i class="iconly-boldShow"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Request In-Waiting</h6>
                        <h6 class="font-extrabold mb-0">
                          <?php
                          /*
                                                    $res = mysqli_query($conn, "SELECT COUNT(request_id) as 'cnt' FROM requestappoint WHERE req_status='pending'");
                                                    $req_in_wait = mysqli_fetch_assoc($res);
                                                    echo $req_in_wait['cnt'];
                                                    */
                          $res = $conn->prepare("SELECT COUNT(request_id) as 'cnt' FROM requestappoint WHERE req_status='pending'");
                          $res->execute();
                          $req_in_wait = $res->get_result()->fetch_assoc();
                          echo $req_in_wait['cnt'];
                          ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="card">
                  <div class="card-body px-3 py-4-5">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="stats-icon blue">
                          <i class="iconly-boldProfile"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Appointments This Week</h6>
                        <h6 class="font-extrabold mb-0">
                          <?php
                          /*
                                                    $query = "SELECT req_appdate, COUNT(*) AS this_week_cnt FROM requestappoint WHERE req_status='approved' OR req_status='completed' AND WEEK(FROM_UNIXTIME(req_appdate, '%m/%d/%Y')) BETWEEN WEEK(CURDATE())-1 AND WEEK(CURDATE())+1";
                                                    $res1 = mysqli_query($conn, $query);
                                                    $appointment_this_week = mysqli_fetch_assoc($res1);
                                                    echo $appointment_this_week['this_week_cnt'];
                                                    //print_r($conn->error_list);
                                                    */
                          $res1 = $conn->prepare("SELECT req_appdate, COUNT(*) AS this_week_cnt FROM requestappoint WHERE req_status='approved' OR req_status='completed' AND WEEK(FROM_UNIXTIME(req_appdate, '%m/%d/%Y')) BETWEEN WEEK(CURDATE())-1 AND WEEK(CURDATE())+1");
                          $res1->execute();
                          $appointment_this_week = $res1->get_result()->fetch_assoc();
                          echo $appointment_this_week['this_week_cnt'];
                          ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="card">
                  <div class="card-body px-3 py-4-5">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="stats-icon green">
                          <i class="iconly-boldAdd-User"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Completed Appointments</h6>
                        <h6 class="font-extrabold mb-0">
                          <?php
                          /*
                                                    $res2 = mysqli_query($conn, "SELECT COUNT(id) as 'cnt' FROM appointwoo WHERE statusapp='complete' AND hosp_name='$hosp'");
                                                    $complete_appointments = mysqli_fetch_assoc($res2);
                                                    echo  $complete_appointments['cnt'];
                                                    //print_r($conn->error);
                                                    */
                          $res2 = $conn->prepare("SELECT COUNT(id) as 'cnt' FROM appointwoo WHERE statusapp='complete' AND hosp_name=?");
                          $res2->bind_param("s", $hosp);
                          $res2->execute();
                          $complete_appointments = $res2->get_result()->fetch_assoc();
                          echo $complete_appointments['cnt'];
                          ?>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="card">
                  <div class="card-body px-3 py-4-5">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="stats-icon red">
                          <i class="iconly-boldBookmark"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Monthly Gross Revenue</h6>
                        <h6 class="font-extrabold mb-0">RM <?php echo $month_gross_revenue['month_rev'];?>.00</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-content">
                    <img src="doc.jpg" class="card-img-top img-fluid" alt="singleminded">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="table-responsive" style="overflow-y:auto; height:310px;">
                    <table class="table table-lg">
                      <thead>
                        <tr>
                          <th>Today's Appointment &nbsp;<a href="appointment-list-all.php" class="btn rounded-pill btn-sm btn-outline-primary">View
                              All</a> </th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                          foreach ($appointment as $rows) : ?>
                            <tr>
                              <td class="text-bold-500">
                                <strong>#<?php echo $rows['appoint_id']; ?> <?php echo $rows['firstname']; ?> <?php echo $rows['lastname']; ?></strong><br>
                                <?php
                                $p_name =  $rows['prod_id'];
                                $r1 = mysqli_query($conn, "SELECT packagewoo.package_name FROM packagewoo WHERE packagewoo.package_id='$p_name'");
                                $r2 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
                                echo  $r2['package_name']; ?><br>
                                <?php echo $rows['start_appoint']; ?><br>
                                <?php
                                $status = $rows['statusapp'];
                                if ($status == "paid") {
                                ?>
                                  <span class="badge bg-primary">Booked</span>
                              </td>
                              <td class="text-bold-500"> <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                  Check-In
                                </button></td>
                            <?php } elseif ($status == "complete") {
                            ?>
                              <span class="badge bg-success">Checked-In</span>
                              </td>
                              <td class="text-bold-500"><button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                  Check-In
                                </button></td>
                            <?php
                                } elseif ($status == "cancelled") { ?>
                              <span class="badge bg-danger">Canceled</span>
                              </td>
                              <td class="text-bold-500"></td>
                            <?php
                                } else { ?>
                              <span class="badge bg-warning">Waiting Payment</span>
                              </td>
                              <td class="text-bold-500"> <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                  Pay Now
                                </button></td>
                            <?php
                                }
                            ?>
                            </tr>
                          <?php endforeach;
                        } else { ?>
                          <tr>
                            <td>No appointments today</td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <section class="section">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Monthly Appointment List</h4>
                  </div>
                  <div class="card-body">
                    <div id="chart-profile-visit"></div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Product Overview</h4>
                  </div>
                  <div class="table-responsive" style="overflow-y:auto; height:338px;">
                    <table class="table table-lg">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Count</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($hospital_list as $rows) {
                          $id = $rows['prod_id']; ?>
                          <tr>
                            <?php foreach ($hospital_list2 as $rows2) {
                              $id2 = $rows2['package_id'];
                              if ($id2 == $id) { ?>
                                <?php $package_name = preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/', '', $rows2['package_name']); ?>
                                <td class="text-bold-500"><?php echo $package_name; ?></td>
                            <?php }
                            } ?>
                            <td class="text-bold-500"><?php echo $rows['COUNT(*)']; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--==================== M O D A L == C H E C K == I N ====================-->
          <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title white" id="myModalLabel160">
                    Patient Check-In Authorization
                  </h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                  </button>
                </div>
                <form action="function.php" method="POST">
                  <div class="modal-body">
                    <label>Enter Patient I/C : </label>
                    <div class="form-group">
                      <input type="text" placeholder="I/C Number" class="form-control" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                      <i class="bx bx-x d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-toggle="modal">
                      <i class="bx bx-check d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Check-In</span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--=======================================================================-->

      </div>

      </section>
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

  <script src="assets/vendors/apexcharts/apexcharts.js"></script>
  <!-- <script src="assets/js/pages/dashboard.js"></script> -->
  <script>
    var month_cnt = []
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
    var optionsProfileVisit = {
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
      plotOptions: {},
      series: [{
        name: 'Appointments',
        data: month_cnt
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

    var chartProfileVisit = new ApexCharts(
      document.querySelector('#chart-profile-visit'),
      optionsProfileVisit
    )
    chartProfileVisit.render()

    $.getJSON('month_app_chart.php', function(jsonObject) {
      let i = 0
      for (let x in months) {
        if (i < 12) {
          month_cnt.push(parseInt(jsonObject[x]))
        }
        i += 1
      }
      chartProfileVisit.updateSeries([{
        name: 'Appointments',
        data: month_cnt
      }])
      window.dispatchEvent(new Event('resize'))

    })

    //setTimeout(load_chart(), 500)
    //window.onload = load_chart()
    //console.log(month_cnt)
    /*
    $(document).ready(function() {
        load_chart()
    });
    */
  </script>
  <script src="assets/js/main.js"></script>

</body>

</html>
