<?php
include 'request-appointment-header.php';
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'pending' ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['reqaccept'])) {
    $confirmid = $_POST['confirmid'];
    $sql = "UPDATE requestappoint SET req_status = 'approved' WHERE request_id = '$confirmid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>window.location.href = "request-appointment-pending.php";</script>';
    }
}

if (isset($_POST['reqreject'])) {
    $confirmid = $_POST['confirmid'];
    $sql = "UPDATE requestappoint SET req_status = 'rejected' WHERE request_id = '$confirmid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>window.location.href = "request-appointment-pending.php";</script>';
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
                                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accept<?php echo $row['request_id']; ?>"><i class="bi bi-plus-circle"></i></button>

                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject<?php echo $row['request_id']; ?>"><i class="bi bi-x-circle"></i></button>

                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#patient<?php echo $row['request_id']; ?>"><i class="bi bi-search"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                            <!--========================================== M O D A L == I N F O =====================================-->
                                        <div class="modal fade text-left" id="patient<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel17">Request Appointment Detail</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label><b>Package Name</b>: <?php echo $row['req_packname']; ?></label>
                                                        <br>
                                                        <label><b>Client Name</b>: <?php echo $row['req_custname']; ?></label>
                                                        <br>
                                                        <label><b>IC/Passport</b>: <?php echo $row['req_custid']; ?></label>
                                                        <br>
                                                        <label><b>No Phone</b>: <?php echo $row['req_custphone']; ?></label>
                                                        <br>
                                                        <label><b>Address</b>: <?php echo $row['req_custaddress']; ?></label>
                                                        <br>
                                                        <label><b>Nationalities</b>: <?php echo $row['req_custnational']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Date</b>: <?php echo $row['req_appdate']; ?></label>
                                                        <br>
                                                        <label><b>Appointment Time</b>: <?php echo $row['req_apptime']; ?></label>
                                                        <br>
                                                        <label><b>Status</b>: <?php echo $row['req_status']; ?></label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <!--========================================== A C C E P T == M O D A L =====================================-->
                                        <div class="modal fade text-left" id="accept<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title white" id="myModalLabel140">
                                                            Confirm accepting the request?
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body" style="text-align: center;">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST">
                                                                <button type="submit" name="reqaccept" class="btn btn-warning ml-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Confirm</span>
                                                                </button>
                                                                <input type="text" name="confirmid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                            </form>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            <!--========================================== R E J E C T == M O D A L =====================================-->
                                        <div class="modal fade text-left" id="reject<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title white" id="myModalLabel140">
                                                            Confirm rejecting the request?
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body" style="text-align: center;">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <form method="POST">
                                                                <button type="submit" name="reqreject" class="btn btn-warning ml-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Confirm</span>
                                                                </button>
                                                                <input type="text" name="confirmid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                            </form>
                                                        </div>
                                                    </form>
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
            <?php include 'request-appointment-footer.php';?>
