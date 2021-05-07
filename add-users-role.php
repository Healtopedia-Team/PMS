<?php session_start();
$username = $_SESSION['name'];
$role = $_SESSION['role']; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role List- Patient Management System</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php' ?>
        <div id="main">

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Role List</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Role</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-4">
                                        <label>Display Name</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="first-name" class="form-control" name="fname" placeholder="Display Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Role Name</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email-id" class="form-control" name="email-id" placeholder="Role Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Appointment</h4>
                                    <label><strong>View</strong> Appointment List</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-list" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-list" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>View</strong> Appointment Calendar</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-calendar" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-calendar" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Approve</strong> Appointment Attendance</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="approve-appointment-attendance" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="approve-appointment-attendance" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <br>
                                    <h4 class="card-title">Appointment Request</h4>
                                    <label><strong>View</strong> Appointment Request</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-request" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-appointment-request" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Add</strong> Appointment Request</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="add-appointment-request" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="add-appointment-request" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Postpone</strong> Appointment Request</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="postpone-appointment-request" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="postpone-appointment-request" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Reject</strong> Appointment Request</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reject-appointment-request" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reject-appointment-request" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Management Settings</h4>
                                    <label><strong>Manage</strong> Time</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-time" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-time" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Manage</strong> Date</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-date" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-date" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Manage</strong> User</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-user" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-user" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Manage</strong> User Role</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-user-role" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-user-role" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <label><strong>Manage</strong> Hospital</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-hospital" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="manage-hospital" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                    <br>
                                    <h4 class="card-title">Finance Management</h4>
                                    <label><strong>View/Download</strong> Financial Report</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-financial-report" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="view-financial-report" id="flexRadioDefault2" checked value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>


                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by Hajar</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>