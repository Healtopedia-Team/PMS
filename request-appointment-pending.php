<?php
include 'request-appointment-header.php';

$result = mysqli_query($conn,"SELECT * FROM requestappoint WHERE req_status = 'pending'");
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
                                    <tr>
                                        <td>Selvendran Baskaran</td>
                                        <td>Basic Health Screening (Men)</td>
                                        <td>22/5/2021</td>
                                        <td>04:00PM</td>
                                        <td>Pending</td>
                                        <td>
                                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                                <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                                <button class="btn btn-warning"><i class="bi bi-calendar3-week"></i></button>
                                                <button class="btn btn-info"><i class="bi bi-search"></i></button>
                                            </div>
                                        </td>
                                    </tr>
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
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
