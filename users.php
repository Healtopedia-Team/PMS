<!DOCTYPE html>
<html lang="en">
<?php
include 'dbconnect.php';

$result = mysqli_query($conn, "SELECT hosp_id, hosp_name FROM hospital");
$hospital = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result2 = mysqli_query($conn,"SELECT * FROM user");
$user = mysqli_fetch_all($result2, MYSQLI_ASSOC);

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Patient Management System</title>

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
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Users List</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Hospital</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach ($user as $rows) : ?>
                                        <tr>
                                            <td><?php echo $rows["first_name"]; ?> <?php echo $rows["last_name"]; ?></td>
                                            <td><?php echo $rows["username"]; ?></td>
                                            <td><?php echo $rows["email"]; ?></td>
                                            <td><?php echo $rows["role"]; ?></td>
                                            <td><?php echo $rows["hospital"]; ?></td>
                                        </tr>
                                            <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;margin-top: 8px;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Add Users
                            </button>
                            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Hospital Form </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="function.php" method="POST">
                                    <input type="hidden" name="command" value="ADD_USER">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" placeholder="First Name" class="form-control" name="firstname">
                                        </div>
                                         <div class="form-group">
                                            <input type="text" placeholder="Last Name" class="form-control" name="lastname">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Email" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                        <select class="choices form-select" name="role" required>
                                            <option value="">Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="receptionist">Receptionist</option>
                                            <option value="financial manager">Financial Manager</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="choices form-select" name="hospital" required>
                                            <option value="">Select Hospital</option>
                                            <?php foreach ($hospital as $rows) : ?>
                                                <option value="<?php echo $rows["hosp_name"]; ?>"><?php echo $rows["hosp_name"]; ?></option>


                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <p data-bs-toggle="modal" data-bs-target="#inlineForm" class="font-bold">Hospital Not Listed? Please Register the hospital first</p>
                                        <div class="form-group">
                                            <input type="password" placeholder="Password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
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