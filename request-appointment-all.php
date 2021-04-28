<?php
include 'request-appointment-header.php';

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status != ''  ORDER BY request_id");
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['reqaccept'])) {
    $requestid = $_POST['requestid'];
    $sql = "UPDATE requestappoint SET req_status = 'approved' WHERE request_id = '$requestid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Request accepted.");</script>';
        echo '<script>window.location.href = "request-appointment-all.php";</script>';
    }
}

if (isset($_POST['reqreject'])) {
    $requestid = $_POST['requestid'];
    $sql = "UPDATE requestappoint SET req_status = 'rejected' WHERE request_id = '$requestid'";
    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Request rejected.");</script>';
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
                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="submit" name="reqaccept" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "pending") {?>
                                                            <button type="submit" name="reqreject" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                        <?php } ?>

                                                        <?php if ($row['req_status'] == "approved" || $row['req_status'] == "postponed") {?>
                                                            <button type="submit" name="reqpostpone" class="btn btn-warning"><i class="bi bi-calendar3-week"></i></button>
                                                        <?php } ?>

                                                        <input type="text" name="requestid" value="<?php echo $row['request_id']; ?>" style="display: none;">
                                                </form>
                                                        <a href="request-info.php" class="btn btn-info"><input type="button" class="bi bi-search"></a>
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
