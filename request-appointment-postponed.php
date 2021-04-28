<?php
include 'request-appointment-header.php';
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE status = 'postponed' ORDER BY request_id");
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
                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="submit" name="reqaccept" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="submit" name="reqreject" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "approved" || $row['req_status'] == "postponed") {?>
                                                            <button type="submit" name="reqpostpone" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="bi bi-calendar3-week"></i></button>
                                                        <?php } ?>

                                                        <input type="text" name="requestid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                </form>
                                                        <a href="request-info.php" class="btn btn-info"><i class="bi bi-search"></i></a>
                                                    </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
                   
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Vertically
                                                            Centered
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Croissant jelly-o halvah chocolate sesame snaps. Brownie
                                                            caramels candy
                                                            canes chocolate cake
                                                            marshmallow icing lollipop I love. Gummies macaroon donut
                                                            caramels
                                                            biscuit topping danish.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary ml-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Accept</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
