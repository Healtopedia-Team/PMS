                <?php
                include 'appointment-list-header.php';
                $conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");
                $result = mysqli_query($conn, "SELECT * FROM orderwoo ORDER BY order_id DESC");
                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary active" onclick="listall()">All</button>
                                <button type="button" class="btn btn-outline-primary" onclick="listupcoming()">Upcoming</button>
                                <button type="button" class="btn btn-outline-primary" onclick="listpending()">Pending</button>
                            </div>
                            <script>
                                function listall(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-all.php";
                                }
                                function listupcoming(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-upcoming.php";
                                }
                                function listpending(){
                                    window.location.href="https://pms.healtopedia.com/appointment-list-pending.php";
                                }
                            </script>
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
                                <?php foreach ($user as $row){ ?>
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
                                            <a href='view-appointment.php?orderid=<?php echo $row['order_id'];?>&custid=<?php echo $row['cust_id'];?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye-fill"></i></button></a>
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
