                <?php
                include 'finance-header.php';

                $conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
                session_start();
                $role = $_SESSION['role'];
                //print_r($role);
                $hosp = $_SESSION['hospital'];
                if ($role === 'admin' || ($role == 'financial manager' and $hosp == 'Healtopedia')) {
                    echo '<script>alert("Welcome ' . $role . '");window.location.href="po-list-admin.php";</script>';
                }
                $hosp = $_SESSION["hospital"];
                $heal = "Healtopedia";
                if (strpos($hosp, $heal) !== false) {
                    $query = "SELECT DISTINCT (DATE(FROM_UNIXTIME(start_appoint, '%Y-%m-%d'))) 
                            AS unique_date, COUNT(*) AS amount
                            FROM `appointwoo`
                            WHERE DATEDIFF(NOW(), FROM_UNIXTIME(appointwoo.end_appoint, '%Y-%m-%d')) > 1 
                            AND statusapp='complete'
                            GROUP BY unique_date
                            ORDER BY unique_date DESC";
                    //$result = mysqli_query($conn, $query);
                    //$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $result = $conn->prepare($query);
                    $result->execute();
                    $res = $result->get_result()->fetch_all(MYSQLI_ASSOC);
                } else {
                    $query = "SELECT DISTINCT (DATE(FROM_UNIXTIME(start_appoint, '%Y-%m-%d'))) 
                            AS unique_date, COUNT(*) AS amount
                            FROM `appointwoo`
                            WHERE DATEDIFF(NOW(), FROM_UNIXTIME(appointwoo.end_appoint, '%Y-%m-%d')) > 1 
                            AND hosp_name = ? 
                            AND statusapp='complete'
                            GROUP BY unique_date
                            ORDER BY unique_date DESC";
                    //$result = mysqli_query($conn, $query);
                    //$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $result = $conn->prepare($query);
                    $result->bind_param("s", $hosp);
                    $result->execute();
                    $res = $result->get_result()->fetch_all(MYSQLI_ASSOC);
                }

                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total Number of Orders</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($res as $row) {

                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['unique_date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['amount']; ?>
                                            </td>
                                            <td>
                                                <a href='report-po.php?cur_date=<?php echo $row['unique_date'] ?>&hosp=<?php echo $hosp ?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye"></i></button></a>
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