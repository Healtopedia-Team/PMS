<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Appointment - Healtopedia Digital</title>

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
	<!--?php
		$data = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slot2json.php');
		$data = json_decode($data, true);
		$data2 = file_get_contents('http://app-pms.eopm4g7bxo-jqp3vpjlj350.p.runcloud.link/slotjson.php');
		$data2 = json_decode($data2, true);
	?-->
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
                      
                      	<li class="sidebar-item active ">
                            <a href="request-appointment.php" class='sidebar-link'>
                                <i class="bi bi-person-check-fill"></i>
                                <span>Request Appointment</span>
                            </a>
                        </li>
			    
			<li class="sidebar-item">
                            <a href="appointment-list.php" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Appointment List</span>
                            </a>
                        </li>
			    
			<li class="sidebar-item">
                            <a href="setting.php" class='sidebar-link'>
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
                            <h3>Request Appointment</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Request Appointment</li>
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
					<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                                            Launch demo modal
                                        </button>
				</div>
				<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                            Scrolling long
                                                            Content</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Biscuit powder jelly beans. Lollipop candy canes croissant
                                                            icing
                                                            chocolate cake. Cake fruitcake
                                                            powder pudding pastry
                                                        </p>
                                                        <p>
                                                            Tootsie roll oat cake I love bear claw I love caramels
                                                            caramels halvah
                                                            chocolate bar. Cotton
                                                            candy
                                                            gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                                                            lemon drops
                                                            danish dessert I love
                                                            caramels powder
                                                        </p>
                                                        <p>
                                                            Chocolate cake icing tiramisu liquorice toffee donut sweet
                                                            roll cake.
                                                            Cupcake dessert icing
                                                            dragée dessert. Liquorice jujubes cake tart pie donut.
                                                            Cotton candy
                                                            candy canes lollipop liquorice
                                                            chocolate marzipan muffin pie liquorice.
                                                        </p>
                                                        <p>
                                                            Powder cookie jelly beans sugar plum ice cream. Candy canes
                                                            I love
                                                            powder sugar plum tiramisu.
                                                            Liquorice pudding chocolate cake cupcake topping biscuit.
                                                            Lemon drops
                                                            apple pie sesame snaps
                                                            tootsie roll carrot cake soufflé halvah. Biscuit powder
                                                            jelly beans.
                                                            Lollipop candy canes
                                                            croissant icing chocolate cake. Cake fruitcake powder
                                                            pudding pastry.
                                                        </p>
                                                        <p>
                                                            Tootsie roll oat cake I love bear claw I love caramels
                                                            caramels halvah
                                                            chocolate bar. Cotton
                                                            candy gummi bears pudding pie apple pie cookie. Cheesecake
                                                            jujubes lemon
                                                            drops danish dessert I
                                                            love caramels powder.
                                                        </p>
                                                        <p>
                                                            dragée dessert. Liquorice jujubes cake tart pie donut.
                                                            Cotton candy
                                                            candy canes lollipop liquorice
                                                            chocolate marzipan muffin pie liquorice.
                                                        </p>
                                                        <p>
                                                            Powder cookie jelly beans sugar plum ice cream. Candy canes
                                                            I love
                                                            powder sugar plum tiramisu.
                                                            Liquorice pudding chocolate cake cupcake topping biscuit.
                                                            Lemon drops
                                                            apple pie sesame snaps
                                                            tootsie roll carrot cake soufflé halvah.Biscuit powder jelly
                                                            beans.
                                                            Lollipop candy canes croissant
                                                            icing chocolate cake. Cake fruitcake powder pudding pastry.
                                                        </p>
                                                        <p>
                                                            Tootsie roll oat cake I love bear claw I love caramels
                                                            caramels halvah
                                                            chocolate bar. Cotton
                                                            candy gummi bears pudding pie apple pie cookie. Cheesecake
                                                            jujubes lemon
                                                            drops danish dessert I
                                                            love caramels powder.
                                                        </p>
                                                        <p>
                                                            Chocolate cake icing tiramisu liquorice toffee donut sweet
                                                            roll cake.
                                                            Cupcake dessert icing
                                                            dragée dessert. Liquorice jujubes cake tart pie donut.
                                                            Cotton candy
                                                            candy canes lollipop liquorice
                                                            chocolate marzipan muffin pie liquorice.
                                                        </p>
                                                        <p>
                                                            Powder cookie jelly beans sugar plum ice cream. Candy canes
                                                            I love
                                                            powder sugar plum tiramisu.
                                                            Liquorice pudding chocolate cake cupcake topping biscuit.
                                                            Lemon drops
                                                            apple pie sesame snaps
                                                            tootsie roll carrot cake soufflé halvah. Biscuit powder
                                                            jelly beans.
                                                            Lollipop candy canes
                                                            croissant icing chocolate cake. Cake fruitcake powder
                                                            pudding pastry.
                                                        </p>
                                                        <p>
                                                            Tootsie roll oat cake I love bear claw I love caramels
                                                            caramels halvah
                                                            chocolate bar. Cotton
                                                            candy gummi bears pudding pie apple pie cookie. Cheesecake
                                                            jujubes lemon
                                                            drops danish dessert I
                                                            love caramels powder.
                                                        </p>
                                                        <p>
                                                            Chocolate cake icing tiramisu liquorice toffee donut sweet
                                                            roll cake.
                                                            Cupcake dessert icing
                                                            dragée dessert. Liquorice jujubes cake tart pie donut.
                                                            Cotton candy
                                                            candy canes lollipop liquorice
                                                            chocolate marzipan muffin pie liquorice.
                                                        </p>
                                                        <p>
                                                            Powder cookie jelly beans sugar plum ice cream. Candy canes
                                                            I love
                                                            powder sugar plum tiramisu.
                                                            Liquorice pudding chocolate cake cupcake topping biscuit.
                                                            Lemon drops
                                                            apple pie sesame snaps
                                                            tootsie roll carrot cake soufflé halvah.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary ml-1"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Accept</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
					    <td>Deanna Tan</td>
					    <td>Executive Health Screening (Women)</td>
					    <td>12/5/2021</td>
					    <td>12:00PM</td>
					    <td>Approved</td>
					    <td>
						    <div class="btn-group mb-3" role="group" aria-label="Basic example">
							    <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
							    <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
							    <button class="btn btn-warning"><i class="bi bi-calendar3-week-fill"></i></button>
							    <button class="btn btn-info"><i class="bi bi-search"></i></button>
						    </div>
					    </td>
				    </tr>
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
							    <button class="btn btn-warning"><i class="bi bi-calendar3-week-fill"></i></button>
							    <button class="btn btn-info"><i class="bi bi-search"></i></button>
						    </div>
					    </td>
				    </tr>
				    <tr>
					    <td>Muaz</td>
					    <td>Mental Health Screening</td>
					    <td>5/5/2021</td>
					    <td>09:00AM</td>
					    <td>Postponed</td>
					    <td>
						    <div class="btn-group mb-3" role="group" aria-label="Basic example">
							    <button class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
							    <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
							    <button class="btn btn-warning"><i class="bi bi-calendar3-week-fill"></i></button>
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

    <script src="assets/js/main.js"></script>
</body>

</html>
