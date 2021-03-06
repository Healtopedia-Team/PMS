                <?php
                include 'finance-header.php';

                $conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "db_pms");
                session_start();
                $hosp = $_SESSION['hospital'];

                $hosps = $conn->prepare("SELECT hosp_name FROM hospital");
                $hosps->execute();
                $hosp_list = $hosps->get_result()->fetch_all(MYSQLI_ASSOC);

                if (isset($_POST['keywords'])) {
                    $keywords = $_POST['keywords'];
                    if ($keywords === 'Healtopedia') {
                        $query = "SELECT DISTINCT (DATE(FROM_UNIXTIME(start_appoint, '%Y-%m-%d'))) AS unique_date, 
                            COUNT(*) AS amount, hosp_name FROM `appointwoo` WHERE DATEDIFF(NOW(), 
                            FROM_UNIXTIME(appointwoo.end_appoint, '%Y-%m-%d')) > 1 AND statusapp='complete' 
                            GROUP BY unique_date,hosp_name ORDER BY unique_date DESC";
                        $result2 = $conn->prepare($query);
                        $result2->execute();
                        $res = $result2->get_result()->fetch_all(MYSQLI_ASSOC);
                        //print_r($result2->error_list);
                        //echo "Runs here";
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
                        $result->bind_param("s", $keywords);
                        $result->execute();
                        $res = $result->get_result()->fetch_all(MYSQLI_ASSOC);
                    }
                } else {
                    $query = "SELECT DISTINCT (DATE(FROM_UNIXTIME(start_appoint, '%Y-%m-%d'))) AS unique_date, 
                            COUNT(*) AS amount, hosp_name FROM `appointwoo` WHERE DATEDIFF(NOW(), 
                            FROM_UNIXTIME(appointwoo.end_appoint, '%Y-%m-%d')) > 1 AND statusapp='complete' 
                            GROUP BY unique_date,hosp_name ORDER BY unique_date DESC";
                    //$result = mysqli_query($conn, $query);
                    //$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $result1 = $conn->prepare($query);
                    //$result->bind_param("s", $hosp);
                    $result1->execute();
                    $res = $result1->get_result()->fetch_all(MYSQLI_ASSOC);
                }
                ?>

                <section class="section">
                    <div class="card">
                        <div class="card-body" style="padding: 0.5rem;">
                            <form method="post" action="" style="display:flex; float:right;" id="choosehosp" name="formhosp">
                                <select name="keywords" class="form-select" style="width: auto;" onchange=selectChange(this.value)>
                                    <option value="">Select Hospital</option>
                                    <?php foreach ($hosp_list as $hospital) { ?>
                                        <option value="<?php echo $hospital['hosp_name'] ?>"><?php echo $hospital['hosp_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </form>
                        </div>
                    </div>
                    <?php

                    ?>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total Number of Orders</th>
                                        <th>Hospital</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php
                                    //print_r($res);
                                    if (!isset($_POST['keywords']) || $_POST['keywords'] == "Healtopedia") {
                                        foreach ($res as $row) {
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
                                                    <?php echo $row['hosp_name']; ?>
                                                </td>
                                                <td>
                                                    <a href='report-po.php?cur_date=<?php echo $row['unique_date'] ?>&hosp=<?php echo $row['hosp_name'] ?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php }
                                    } else {
                                        foreach ($res as $row) {
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
                                                    <?php echo $keywords; ?>
                                                </td>
                                                <td>
                                                    <a href='report-po.php?cur_date=<?php echo $row['unique_date'] ?>&hosp=<?php echo $keywords ?>' target='_blank'><button class="btn btn-info"><i class="bi bi-eye"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                    <?php }
                                    } ?>
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
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script>
                    // Simple Datatable
                    let table1 = document.querySelector('#table1');
                    let dataTable = new simpleDatatables.DataTable(table1);

                    function selectChange(val) {
                        //Set the value of action in action attribute of form element.
                        //Submit the form
                        $('#choosehosp').submit();
                    }
                </script>


                <script src="assets/js/main.js"></script>
                </body>

                </html>