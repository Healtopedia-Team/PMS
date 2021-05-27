<?php include 'dbconnect.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}
/*
$data = mysqli_query($conn, "SELECT * FROM packagewoo");
$data = mysqli_fetch_all($data, MYSQLI_ASSOC);
*/
$res = $conn->prepare("SELECT * FROM packagewoo");
$res->execute();
$data = $res->get_result()->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['updateprice'])) {
    $newprice = $_POST['newprice'];
    $packageid = $_POST['packageid'];
    /*
    $sql = "UPDATE packagewoo SET package_price = '$newprice' WHERE package_id = '$packageid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>window.location.href = "package-list.php";</script>';
    }
    */
    $sql = $conn->prepare("UPDATE packagewoo SET package_price = ? WHERE package_id = ?");
    $sql->bind_param("ii", $newprice, $packageid);
    if ($sql->execute()) {
        echo '<script>window.location.href = "package-list.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package List - Healtopedia Digital</title>

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
        <?php include 'sidebar.php'; ?>
        <div id="main" style="margin-top: -50px;">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Package List</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Package List</li>
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
                                        <th>No</th>
                                        <th>Package ID</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data as $row) {?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['package_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['package_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo "RM ".$row['package_price']; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#package<?php echo $row['package_id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <?php foreach ($data as $row) {?>
            <div class="modal fade text-left" id="package<?php echo $row['package_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1"><?php echo $row['package_name'];?></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <label>Price :</label>
                                <input type="text" name="newprice" class="form-control" value="<?php echo $row['package_price']; ?>">
                                <input type="text" name="packageid" class="form-control" value="<?php echo $row['package_id']; ?>" style="display: none;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-sm-block d-none">Close</span>
                                </button>
                                <button type="submit" name="updateprice" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-sm-block d-none">Update</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Healtopedia Digital</p>
                    </div>
                    <div class="float-end">
                        <p>Powered By Atiq hehehe ;)<span class="text-danger"><i class="bi bi-heart"></i></span></p>
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
