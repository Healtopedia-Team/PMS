                <?php
                include 'appointment-list-header.php';
                $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
                $result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,orderwoo.order_id,orderwoo.status,SUBSTRING(orderwoo.order_date,1,10) AS order_date,appointwoo.appoint_id,appointwoo.start_appoint FROM orderwoo INNER JOIN appointwoo ON orderwoo.order_id = appointwoo.order_id GROUP BY order_id ORDER BY orderwoo.order_id DESC");
                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary" onclick="listall()">All</button>
                                <button type="button" class="btn btn-outline-primary active" onclick="listtoday()">Today</button>
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
                                <?php foreach( $ansappoint as $row ){
                                    $appdate = date('Y-m-d', $row['start_appoint']);
                                    $todaydate = date("Y-m-d");

                                    if ($appdate == $todaydate) {
                                        $orderid = $row['order_id'];
                                        $ordersql = mysqli_query($conn, "SELECT firstname, lastname, cust_id, status, SUBSTRING(order_date,1,10) AS order_date FROM orderwoo WHERE order_id = '$orderid'");
                                        $ansorder = mysqli_fetch_all($ordersql, MYSQLI_ASSOC);

                                        foreach ( $ansorder as $row2 ) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['order_id'];?>
                                        </td>
                                        <td>
                                            <?php echo $row2['firstname'];?> <?php echo $row2['lastname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row2['order_date'];?>
                                        </td>
                                        <td>
                                            <?php echo $appdate; ?>
                                        </td>
                                        <td>
                                            <?php echo $row2['status'];?>
                                        </td>
                                        <td>
                                            <a href='view-appointment.php?orderid=<?php echo $row['order_id']; ?>&custid=<?php echo $row2['cust_id']; ?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye-fill"></i></button></a>
                                        </td>
                                    </tr>
                                <?php $i++; ?>
                                <?php } } } ?>
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
