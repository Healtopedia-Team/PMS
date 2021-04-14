                <?php
                include 'appointment-list-header.php';
                $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
                $result = mysqli_query($conn, "SELECT orderwoo.firstname,orderwoo.lastname,orderwoo.order_id,orderwoo.status,appointwoo.appoint_id,appointwoo.start_appoint FROM orderwoo INNER JOIN appointwoo ON orderwoo.order_id = appointwoo.order_id GROUP BY order_id ORDER BY orderwoo.order_id DESC");
                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <a href="appointment-list-all.php"><button type="button" class="btn btn-outline-primary">All</button></a>
                            <a href="appointment-list-upcoming.php"><button type="button" class="btn btn-outline-primary active">Upcoming</button></a>
                            <a href="appointment-list-processing.php"><button type="button" class="btn btn-outline-primary">Processing</button></a>
                            <br><br>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Order Details</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($user as $row){
                                  $currdate = date("Y-m-d");
                                  $appdate = date("Y-m-d",$row['start_appoint']);
                                  if ($appdate > $currdate){ ?>
                                    <tr>
                                        <td>
                                            <?php echo $i;?>
                                        </td>
                                        <td>
                                            <?php echo $row['order_id'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['firstname'];?> <?php echo $row['lastname'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['status'];?>
                                        </td>
                                        <td>
                                            <a href='view-appointment.php?orderid=<?php echo $row['order_id'];?>&custid=<?php echo $row['appoint_id'];?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye-fill"></i></button></a>
                                        </td>
                                    </tr> 
                                    <?php $i++; ?>
                                    <?php }} ?>
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
