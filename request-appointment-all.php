<?php
include 'request-appointment-header.php';
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
$result=mysqli_query($conn, "SELECT * FROM requestappoint ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['reqaccept'])) {
    $confirmid = mysqli_real_escape_string($conn, $_POST['confirmid']);
    $sql = "UPDATE requestappoint SET req_status = 'approved' WHERE request_id = '$confirmid'";
    if (mysqli_query($conn,$sql)) {
        $sql2 = "UPDATE calendar SET cal_status = 'approved' WHERE cal_id = '$confirmid'";
        if (mysqli_query($conn,$sql2)) {
            echo '<script>window.location.href = "request-appointment-all.php";</script>';
        }
    }
}

if (isset($_POST['reqreject'])) {
    $confirmid = mysqli_real_escape_string($conn, $_POST['confirmid']);
    $sql = "DELETE FROM requestappoint WHERE request_id = '$confirmid'";
    if (mysqli_query($conn,$sql)) {
        $sql2 = "DELETE FROM calendar WHERE cal_id = '$confirmid'";
        if (mysqli_query($conn,$sql2)) {
            echo '<script>window.location.href = "request-appointment-all.php";</script>';
        }
    }
}
if (isset($_POST['updatedate'])) {
    $postponedate = mysqli_real_escape_string($conn, $_POST['postponedate']);
    $postponeid = mysqli_real_escape_string($conn, $_POST['postponeid']);
    $sql = "UPDATE requestappoint SET req_appdate = '$postponedate', req_status = 'postponed' WHERE request_id = '$postponeid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Request date postponed.");</script>';
        echo '<script>window.location.href = "request-appointment-all.php";</script>';
    }
}

if (isset($_POST['reqcomplete'])) {
    $confirmid = mysqli_real_escape_string($conn, $_POST['confirmid']);
    $sql = "UPDATE requestappoint SET req_status = 'completed' WHERE request_id = '$confirmid'";
    if (mysqli_query($conn,$sql)) {
        $sql2 = "UPDATE calendar SET cal_status = 'completed' WHERE cal_id = '$confirmid'";
        if (mysqli_query($conn,$sql2)) {
            echo '<script>window.location.href = "request-appointment-all.php";</script>';
        }
    }
}

if (isset($_POST['updatedate'])) {
    $postponedate = mysqli_real_escape_string($conn, $_POST['postponedate']);
    $postponeid = mysqli_real_escape_string($conn, $_POST['postponeid']);

    $sql = "UPDATE requestappoint SET req_appdate = '$postponedate' WHERE request_id = '$postponeid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Request date postponed.");</script>';
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
                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accept<?php echo $row['request_id']; ?>"><i class="bi bi-plus-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject<?php echo $row['request_id']; ?>"><i class="bi bi-x-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "approved") {?>
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#complete<?php echo $row['request_id']; ?>"><i class="bi bi-check2-circle"></i></button>
                                                        <?php } ?>

                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#postpone<?php echo $row['request_id']; ?>"><i class="bi bi-calendar3-week"></i></button>

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#patient<?php echo $row['request_id']; ?>"><i class="bi bi-search"></i></button>
                                                    </div>
                                            </td>
                                        </tr>
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
                            <!--========================================== M O D A L == D A T E =====================================-->
                                        <div class="modal fade text-left" id="postpone<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Postpone Request</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <label>Select Date :</label>
                                                            <input type="text" name="postponedate" class="form-control datepicker" autocomplete="off">
                                                            <input type="text" name="postponeid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Close</span>
                                                            </button>
                                                            <button type="submit" name="updatedate" class="btn btn-primary ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Submit</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            <!--========================================== C O M P L E T E  == M O D A L =====================================-->
                                        <div class="modal fade text-left" id="complete<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title white" id="myModalLabel140">
                                                            Confirm complete the appointment?
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
                                                                <button type="submit" name="reqcomplete" class="btn btn-warning ml-1">
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
                            <!--========================================== E N D == O F == M O D A L =====================================-->
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--========================================== M O D A L == I N F O =====================================-->
                            <?php foreach ($data as $row) { ?>
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
                                            <table class="table table-borderless mb-0">
                                                <colgroup>
                                                    <col span="1" style="width: 25%;">
                                                    <col span="1" style="width: 75%;">
                                                </colgroup>
                                                <tbody>
                                                    <tr>
                                                        <td><b>Package Name</b></td>
                                                        <td>: <?php echo $row['req_packname']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Client Name</b></td>
                                                        <td>: <?php echo $row['req_custname']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>IC/Passport</b></td>
                                                        <td>: <?php echo $row['req_custid']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No Phone</b></td>
                                                        <td>: <?php echo $row['req_custphone']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Address</b></td>
                                                        <td>: <?php echo $row['req_custaddress']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nationalities</b></td>
                                                        <td>: <?php echo $row['req_custnational']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Appointment Date</b></td>
                                                        <td>: <?php echo $row['req_appdate']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Appointment Time</b></td>
                                                        <td>: <?php echo $row['req_apptime']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Status</b></td>
                                                        <td>: <?php echo $row['req_status']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                            <?php } ?>
                            <!--========================================== E N D == O F == M O D A L =====================================-->
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'request-appointment-footer.php';?>
