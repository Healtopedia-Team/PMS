<!DOCTYPE html>
<html lang="en">
<?php
include 'dbconnect.php';

//$result = mysqli_query($conn, "SELECT * FROM hospital");
//$hospital = mysqli_fetch_all($result, MYSQLI_ASSOC);

$result = $conn->prepare("SELECT * FROM hospital");
$result->execute();
$hospital = $result->get_result()->fetch_all(MYSQLI_ASSOC);

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
        <div id="main" style="margin-top: -50px;">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Hospital List</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Hospital List</li>
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
                                        <th>Company</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($hospital as $rows) : ?>
                                        <tr>
                                            <td><?php echo $rows["hosp_name"]; ?></td>
                                            <td><?php echo $rows["hosp_company"]; ?></td>
                                            <td><?php echo $rows["hosp_phone"]; ?></td>
                                            <td><?php echo $rows["hosp_address"]; ?></td>
                                            <td>
                                                <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm<?php echo $count; ?>"><i class=" bi bi-pencil-square"></i></button>
                                                    <a href="function.php?id=<?php echo $rows['hosp_id']; ?>&command=DELETE_HOSP" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hospital?')"><i class="bi bi-x-octagon"></i></a>

                                                </div>
                                                <div class="modal fade text-left" id="inlineForm<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel33">Hospital Form </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="function.php" method="POST">
                                                                <input type="hidden" name="command" value="UPDATE_HOSP">
                                                                <input type="hidden" name="id" value="<?php echo $rows["hosp_id"]; ?>">
                                                                <div class="modal-body">
                                                                    <label>Hospital Name: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" value="<?php echo $rows["hosp_name"]; ?>" class="form-control" name="hospname">
                                                                    </div>
                                                                    <label>Hospital Company: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" value="<?php echo $rows["hosp_company"]; ?>" class="form-control" name="hospcomp">
                                                                    </div>
                                                                    <label>Phone No: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" value="<?php echo $rows["hosp_phone"]; ?>" class="form-control" name="hospphone">
                                                                    </div>
                                                                    <label>Hospital Address: </label>
                                                                    <div class="form-group">
                                                                        <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="hospadd"><?php echo $rows["hosp_address"]; ?></textarea>
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
                                            </td>
                                        </tr>
                                    <?php
                                        $count++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary mb-3" style="position: relative;float: right;margin-top: 8px;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Add Hospital
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
                                            <input type="hidden" name="command" value="ADD_HOSP">
                                            <div class="modal-body">
                                                <label>Hospital Name: </label>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Hospital Name" class="form-control" name="hospname">
                                                </div>
                                                <label>Hospital Company: </label>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Company Name" class="form-control" name="hospcomp">
                                                </div>
                                                <label>Phone No: </label>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Phone No." class="form-control" name="hospphone">
                                                </div>
                                                <label>Hospital Address: </label>
                                                <div class="form-group">
                                                    <textarea type="text" placeholder="Address" class="form-control" id="exampleFormControlTextarea1" rows="3" name="hospadd"></textarea>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
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
