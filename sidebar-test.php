<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php");

session_start();

?>
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
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-check-fill"></i>
                        <span>Request Appoint</span>
                    </a>
                    <ul class="submenu <?php if ($your_variable == "request-appointment-all" || $your_variable == "request-addappoint" || $your_variable == "request-appointment-pending" || $your_variable == "request-appointment-postponed" || $your_variable == "request-appointment-approved" || $your_variable == "manage-date" || $your_variable == "manage-time") {
                                            echo "active";
                                        } else {
                                            echo "noactive";
                                        } ?>">
                        <li class="submenu-item <?php if ($your_variable == "request-appointment-all" || $your_variable == "request-appointment-pending" || $your_variable == "request-appointment-postponed" || $your_variable == "request-appointment-approved") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="request-appointment-all.php">Request List</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable == "request-addappoint") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="request-addappoint.php">Add Request</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable == "manage-date") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="manage-date.php">Manage Date</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable == "manage-time") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="manage-time.php">Manage Time</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item <?php if ($your_variable == "appointment-list-all" || $your_variable == "view-appointment") {
                                            echo "active";
                                        } else {
                                            echo "noactive";
                                        } ?>">
                    <a href="appointment-list-all.php" class='sidebar-link'>
                        <i class="bi bi-list-ul"></i>
                        <span>Appointment List</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu <?php if ($your_variable == "user-profile" || $your_variable == "users" || $your_variable == "hospitals") {
                                            echo "active";
                                        } else {
                                            echo "noactive";
                                        } ?>">
                        <li class="submenu-item <?php if ($your_variable == "user-profile") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="user-profile.php">Profile</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable == "users") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="users.php">Users</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable == "hospitals") {
                                                    echo "active";
                                                } else {
                                                    echo "noactive";
                                                } ?>">
                            <a href="hospitals.php">Hospitals</a>
                        </li>
                    </ul>

                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Mail</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">No new mail</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                            <?php
                            $query = mysqli_query($conn, "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC");
                            $notifications = mysqli_fetch_assoc($query);
                            $cnt_not = count(array_keys($notifications, "unread"));
                            if ($cnt_not > 0) {
                            ?>
                                <span class="badge badge-light"><?php echo $cnt_not; ?></span>
                            <?php
                            }
                            ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <li><a class="dropdown-item">No notification available</a></li>
                            <?php
                            $query = "SELECT * from `notifications` order by `date` DESC";
                            if (count(mysqli_fetch_assoc($query)) > 0) {
                                foreach (mysqli_fetch_assoc($query) as $i) {
                            ?>
                                    <li>
                                        <a style="
                                            <?php
                                            if ($i['status'] == 'unread') {
                                                echo "font-weight:bold;";
                                            }
                                            ?>  
                                            " class="dropdown-item" href="#">
                                            <small><i>
                                                    <?php echo date('F j, Y, g:i a', strtotime($i['date'])) ?>
                                                </i></small><br />
                                            <?php
                                            if ($i['type'] == 'request-appointment') {
                                                echo "You just successfully reserved an appointment on  .";
                                            } else if ($i['type'] == 'cancel') {
                                                echo "You just successfully cancelled your appointment on  .";
                                            }
                                            ?>
                                        </a>
                                    </li>
                            <?php
                                }
                            } else {
                            ?>
                                <li><a class="dropdown-item">
                                <?php
                                echo "No notifications yet.";
                            }
                            ?>
                                </a></li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?php echo $_SESSION["name"] ?></h6>
                                <p class="mb-0 text-sm text-gray-600"><?php echo $_SESSION["role"] ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="images/<?php echo $_SESSION["pic"] ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">Hello, <?php echo $_SESSION["name"] ?>!</h6>
                        </li>
                        <li><a class="dropdown-item" href="user-profile.php"><i class="icon-mid bi bi-person me-2"></i>Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>