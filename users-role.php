<!DOCTYPE html>
<html lang="en">
<?php
include 'dbconnect.php';

$result = mysqli_query($conn, "SELECT * FROM hospital");
$hospital = mysqli_fetch_all($result, MYSQLI_ASSOC);
session_start();
$hosp = $_SESSION['hospital'];
$query = "SELECT * FROM roles WHERE hospital='$hosp'";
$result = mysqli_query($conn, $query);
$roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($user);

?>

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
        <div id="main" style="margin-top: -50px;">
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
                                    <li class="breadcrumb-item active" aria-current="page">Role List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Hospital</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $count = 0;
                                    foreach ($roles as $rows) :

                                    ?>
                                        <tr>
                                            <td><?php echo $rows["role_name"]; ?></td>
                                            <td><?php echo $rows["hospital"]; ?></td>
                                            <td>
                                                <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm<?php echo $count; ?>"><i class=" bi bi-pencil-square"></i></button>
                                                    <a href="function.php?role_id=<?php echo $rows['role_id']; ?>&command=DELETE_ROLE" 
                                                    class="btn btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                                    <i class="bi bi-x-octagon"></i></a>

                                                </div>

                                                <div class="modal fade text-left" id="inlineForm<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content" style="overflow: scroll;">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel55">Role Update</h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="function.php" method="POST">
                                                                <input type="hidden" name="command" value="UPDATE_ROLE">
                                                                <input type="hidden" name="id" value="<?php echo $rows['role_id']; ?>">
                                                                <div class="modal-body">
                                                                    <div class="form-group card-header">
                                                                        <h4 class="card-title">Role Name</h4>
                                                                        <input type="text" placeholder="Role Name" class="form-control" name="rolename" value="<?php echo $rows['role_name']; ?>">
                                                                    </div>
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
                                                                </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cancel</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Submit</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                    <?php
                                        $count++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <a href="add-users-role.php">
                            <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;margin-top: 8px;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Add Role
                            </button>
                            </a>
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