<?php
include 'request-appointment-header.php';
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'completed' ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                            <!--========================================== E N D == O F == M O D A L =====================================-->
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'request-appointment-footer.php';?>
