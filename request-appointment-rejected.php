<?php
include 'request-appointment-header.php';
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
$result=mysqli_query($conn, "SELECT * FROM requestappoint WHERE req_status = 'rejected' ORDER BY request_id");
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
                                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                     <a href="request-info.php?id=<?php echo $row['request_id']; ?>" class="btn btn-info"><i class="bi bi-search"></i></a>
                                                     <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default"><i class="bi bi-search"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Bonbon caramels muffin. Chocolate bar oat cake cookie pastry
                                                        dragée pastry.
                                                        Carrot cake
                                                        chocolate tootsie roll chocolate bar candy canes biscuit.

                                                        Gummies bonbon apple pie fruitcake icing biscuit apple pie
                                                        jelly-o sweet
                                                        roll. Toffee sugar
                                                        plum sugar plum jelly-o jujubes bonbon dessert carrot cake.
                                                        Cookie dessert
                                                        tart muffin topping
                                                        donut icing fruitcake. Sweet roll cotton candy dragée danish
                                                        Candy canes
                                                        chocolate bar cookie.
                                                        Gingerbread apple pie oat cake. Carrot cake fruitcake bear claw.
                                                        Pastry
                                                        gummi bears
                                                        marshmallow jelly-o.
                                                    </p>
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
