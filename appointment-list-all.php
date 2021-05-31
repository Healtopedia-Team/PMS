                <?php
                include 'appointment-list-header.php';
                $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
                /*
                $result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,orderwoo.order_id,orderwoo.status,orderwoo.cust_id,SUBSTRING(orderwoo.order_date,1,10) AS order_date,appointwoo.appoint_id,appointwoo.start_appoint 
                FROM orderwoo INNER JOIN appointwoo ON orderwoo.order_id = appointwoo.order_id GROUP BY order_id ORDER BY orderwoo.order_id DESC");
                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                */

                $result = $conn->prepare("SELECT orderwoo.firstname,orderwoo.lastname,orderwoo.order_id,orderwoo.status,orderwoo.cust_id,SUBSTRING(orderwoo.order_date,1,10) AS order_date,appointwoo.appoint_id,appointwoo.start_appoint 
                FROM orderwoo INNER JOIN appointwoo ON orderwoo.order_id = appointwoo.order_id GROUP BY order_id ORDER BY orderwoo.order_id DESC");
                $result->execute();
                $user = $result->get_result()->fetch_all(MYSQLI_ASSOC);
                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary active" onclick="listall()">All</button>
                                <button type="button" class="btn btn-outline-primary" onclick="listtoday()">Today</button>
                                <button type="button" class="btn btn-outline-primary" onclick="listupcoming()">Upcoming</button>
                                <button type="button" class="btn btn-outline-primary" onclick="listpending()">Pending</button>
                            </div>
                            <script>
                                function listall(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-all.php";
                                }
                                function listtoday(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-today.php";
                                }
                                function listupcoming(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-upcoming.php";
                                }
                                function listpending(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-processing.php";
                                }
                            </script>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Order Date</th>
                                        <th>Appointment Date</th>
                                        <th>Payment Status</th>
                                        <th>Order Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($user as $row) {
                                        
                                        $orderid = $row['order_id'];/*
                                        $result2 = mysqli_query($conn, "SELECT appointwoo.start_appoint FROM appointwoo LEFT JOIN orderwoo ON orderwoo.order_id=appointwoo.order_id WHERE orderwoo.order_id=$orderid LIMIT 1");
                                        $timee = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                        */
                                        $result2 = $conn->prepare("SELECT appointwoo.start_appoint, orderwoo.cust_id 
                                        FROM appointwoo LEFT JOIN orderwoo ON orderwoo.order_id=appointwoo.order_id WHERE orderwoo.order_id=? LIMIT 1");
                                        $result2->bind_param("i", $orderid);
                                        $result2->execute();
                                        $timee = $result2->get_result()->fetch_all(MYSQLI_ASSOC);

                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['order_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['order_date']; ?>
                                            </td>
                                            <td>
                                                <?php foreach ($timee as $rows) {
                                                    echo date('Y-m-d', $rows['start_appoint']);
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <a href='view-appointment.php?orderid=<?php echo $row['order_id']; ?>&custid=<?php echo $row['cust_id']; ?>' target='_blank'><button class="btn btn-primary"><i class="bi bi-eye-fill"></i></button></a>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#refund<?php echo $row['order_id']; ?>"><i class="bi bi-cash-stack"></i></button>
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
    <!--========================================== M O D A L == I N F O =====================================-->
                            <?php foreach ($user as $row2) {
                                $refid = $row2['order_id'];

                                $data = mysqli_query($conn, "SELECT * FROM appointwoo WHERE order_id = '$refid'");
                                $data = mysqli_fetch_all($data, MYSQLI_ASSOC);

                                $data2 = mysqli_query($conn, "SELECT * FROM packagewoo");
                                $data2 = mysqli_fetch_all($data2, MYSQLI_ASSOC);
                            ?>
                            <div class="modal fade text-left" id="refund<?php echo $row2['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Request Refund</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php foreach ($data as $key) {echo $key['prod_id'];}?>
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
