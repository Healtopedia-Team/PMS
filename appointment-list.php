<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment List - Healtopedia Digital</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
	<?php
		$data = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slot2json.php');
		$data = json_decode($data, true);
		$data2 = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slotjson.php');
		$data2 = json_decode($data2, true);
	?>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-title">Forms &amp; Tables</li>
                      
                      	<li class="sidebar-item">
                            <a href="request-appointment.html" class='sidebar-link'>
                                <i class="bi bi-person-check-fill"></i>
                                <span>Request Appointment</span>
                            </a>
                        </li>
			    
			<li class="sidebar-item active">
                            <a href="appointment-list.php" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Appointment List</span>
                            </a>
                        </li>
			    
			<li class="sidebar-item">
                            <a href="setting.html" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Setting</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Appointment List</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Appointment List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
				<div class="btn-group mb-3" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-primary">All</button>
                                        <button type="button" class="btn btn-outline-primary">Upcoming</button>
                                        <button type="button" class="btn btn-outline-primary">Pending</button>
                                    </div>
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
              				<?php foreach ($data as $row ) : ?>
                			<?php if ($row['status'] == "completed" || $row['status'] == "processing") { ?>
                  			<tr>
                    				<td><?= $i; ?></td>
                    				<td><?= $row['number']; ?></td>
                    				<td>
                      					<?= $row['billing']['first_name']; ?>
                      					<?= $row['billing']['last_name']; ?>
                      					<?php foreach ($data2 as $row2) {
                        					if ($row2['order_id'] == $row['number']) {
                          						$cust_id = $row2['id']; }
                          				} ?>
                    				</td>
                    				<td>
                      					<?php if ($row['status'] == "completed") { ?>

                        				<button class="btn btn-success" disabled><?= $row['status']; ?></button>

                      					<?php } elseif ($row['status'] == "processing") { ?>

                        				<button class="btn btn-primary" disabled><?= $row['status']; ?></button>
                      					<?php } ?>
                    				</td>
                    				<td>
                      					<a href='intersect.php?orderid=<?= $row['number']; ?>&custid=<?php echo $cust_id;?>' target='_blank'><button class="btn btn-info"><i class="icon-eye-open"></i></button></a>
                    				</td>
                  			</tr>
               	 			<?php $i++; ?>
                			<?php } ?>
            				<?php endforeach; ?>
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
