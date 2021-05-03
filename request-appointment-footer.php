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
    <?php
    $query=mysqli_query($conn, "SELECT datedisable FROM xdate");
    $dateclose=mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>
    <script type="text/javascript">
        var disableDates = [<?php foreach ($dateclose as $value){echo "'".$value['datedisable']."'".",";}?>];
          
        $('.datepicker').datepicker({
            startDate: new Date(),
            format: 'm/d/yyyy',
            daysOfWeekDisabled: [0,6],
            beforeShowDay: function(date){
                dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                if(disableDates.indexOf(dmy) != -1){
                    return false;
                }
                else{
                    return true;
                }
            }
        });
    </script>
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
