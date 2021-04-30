<?php
include 'request-appointment-header.php';

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'postponed' ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['reqpostpone'])) {
    $requestid = $_POST['requestid'];
    $sql = "UPDATE requestappoint SET req_status = 'postponed' WHERE request_id = '$requestid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Request postponed.");</script>';
        echo '<script>window.location.href = "request-appointment-all.php";</script>';
    }
}
?>

                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['req_custname']; ?></td>
                                            <td><?php echo $row['req_packname']; ?></td>
                                            <td><?php echo $row['req_appdate']; ?></td>
                                            <td><?php echo $row['req_apptime']; ?></td>
                                            <td><?php echo $row['req_status']; ?></td>
                                            <td>
                                                <form method="POST">
                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">

                                                        <input type="text" name="requestid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                </form>
                                                         <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#postpone<?php echo $row['request_id']; ?>"><i class="bi bi-calendar3-week"></i></button>

                                                         <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#patient<?php echo $row['request_id']; ?>"><i class="bi bi-search"></i></button>
                                                    </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade text-left" id="patient<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Request Information</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label><b>Package Name</b>     : <?php echo $row['req_packname']; ?></label>
                                                        <br>
                                                        <label><b>Client Name</b>      : <?php echo $row['req_custname']; ?></label>
                                                        <br>
                                                        <label><b>IC/Passport</b>      : <?php echo $row['req_custid']; ?></label>
                                                        <br>
                                                        <label><b>No Phone</b>         : <?php echo $row['req_custphone']; ?></label>
                                                        <br>
                                                        <label><b>Address</b>          : <?php echo $row['req_custaddress']; ?></label>
                                                        <br>
                                                        <label><b>Nationalities</b>    : <?php echo $row['req_custnational']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Date</b> : <?php echo $row['req_appdate']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Time</b> : <?php echo $row['req_apptime']; ?></label>
                                                        <br>
                                                        <label><b>Status</b>           : <?php echo $row['req_status']; ?></label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        <!--=================================================================================-->
                                        <div class="modal fade text-left" id="postpone<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Request Information</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h1>Yeeehhaaaaa !!</h1>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Healtopedia Digital</p>
                    </div>
                    <!--div class="float-end">
                        <p>Powered By Atiq hehehe ;)<span class="text-danger"><i class="bi bi-heart"></i></span></p>
                    </div-->
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
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
