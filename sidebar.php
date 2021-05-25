<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php");

session_start();
$username = $_SESSION['name'];
$role = $_SESSION['role'];
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
                <li class="sidebar-item  ">
                    <a href="index.php" class='sidebar-link'>
                        <i class="bi bi-house-door-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php if ($role == "admin" || $role == "receptionist") { ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-check-fill"></i>
                            <span>Request Appointment</span>
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
                            <?php if ($role == "admin") { ?>
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
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($role == "admin" || $role == "financial manager") { ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="submenu <?php if ($your_variable == "po-list" || $your_variable == "financial-report-status") {
                                                echo "active";
                                            } else {
                                                echo "noactive";
                                            } ?>">
                            <li class=" submenu-item <?php if ($your_variable == "po-list") {
                                                            echo "active";
                                                        } else {
                                                            echo "noactive";
                                                        } ?>">
                                <a href="po-list.php">Appointment Reports List</a>
                            </li>
                            <li class="submenu-item  <?php if ($your_variable == "financial-report-status") {
                                                            echo "active";
                                                        } else {
                                                            echo "noactive";
                                                        } ?>">
                                <a href="financial-report-status.php">Financial Report</a>
                            </li>

                        </ul>
                    </li>
                <?php } ?>


                <?php if ($role == "admin" || $role == "receptionist") {
                ?>
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
                    <li class="sidebar-item <?php if ($your_variable == "appoint-calendar") {
                                                echo "active";
                                            } else {
                                                echo "noactive";
                                            } ?>">
                        <a href="appoint-calendar.php" class='sidebar-link'>
                            <i class="bi bi-calendar3-week-fill"></i>
                            <span>Appointment Calendar</span>
                        </a>
                    </li>

                <?php } ?>
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

                        <?php if ($role == "admin" || $role == "receptionist" || $role == "financial manager") { ?>
                            <li class="submenu-item <?php if ($your_variable == "user-profile") {
                                                        echo "active";
                                                    } else {
                                                        echo "noactive";
                                                    } ?>">
                                <a href="user-profile.php">Profile</a>
                            </li> <?php }
                                if ($role == "admin") { ?>
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
                            </li><?php } ?>
                    </ul>

                </li>
                <?php if ($role == "admin") { ?>

                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-person-fill"></i>
                            <span>Users Role</span>
                        </a>
                        <ul class="submenu <?php if ($your_variable == "users-role" || $your_variable == "add-users-role") {
                                                echo "active";
                                            } else {
                                                echo "noactive";
                                            } ?>">
                            <li class="submenu-item <?php if ($your_variable == "users-role") {
                                                        echo "active";
                                                    } else {
                                                        echo "noactive";
                                                    } ?>">
                                <a href="users-role.php">Role List</a>
                            </li>
                            <li class="submenu-item <?php if ($your_variable == "add-users-role") {
                                                        echo "active";
                                                    } else {
                                                        echo "noactive";
                                                    } ?>">
                                <a href="add-users-role.php">Add Role</a>
                            </li>
                        </ul>

                    </li><?php } ?>
                <li class="sidebar-item  ">
                    <a href="#" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>Logout</span>
                    </a>
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
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#notif-bell").click(function() {
                                setInterval(function() {
                                    $('#notif-item').css("font-weight", "400");
                                    <?php
                                    $chgstatus = "UPDATE notification SET status='read'";
                                    if (mysqli_query($conn, $chgstatus)) {
                                        echo "Record was updated successfully.";
                                    } else {
                                        echo "ERROR: " . mysqli_error($conn);
                                    }
                                    ?>
                                }, 5000);
                            });
                        });
                    </script>
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="notif-bell">
                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                            <?php
                            $statuscnt = mysqli_query($conn, "SELECT COUNT(id) as 'cnt' FROM notification WHERE status='unread'");
                            $notifications = mysqli_fetch_assoc($statuscnt);
                            $cnt_not = $notifications['cnt'];
                            ?>
                            <?php
                            if ($cnt_not > 0) {
                            ?>
                                <span class="badge badge-light" style="color: red"><?php echo $cnt_not; ?></span>
                            <?php
                            }
                            ?>
                            </span>
                        </a>
                        <!-- Here not done -->
                        <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="dropdownMenuButton" style="
                        width: calc(0.2*100vw + 100px) !important; max-height: 400px !important; overflow-y:scroll; right:0 !important;">
                            <li style="word-wrap: break-word;">
                                <h6 class=" dropdown-header">Notifications</h6>
                            </li>

                            <?php
                            $not_list = mysqli_query($conn, "SELECT * FROM notification WHERE name='$username' ORDER BY 'date' DESC LIMIT 5");
                            $notifications = mysqli_fetch_all($not_list);
                            if ($cnt_not >= 0) {
                                foreach ($notifications as $rows) {
                            ?>
                                    <li>
                                        <a style="<?php if ($rows['status'] == 'unread') {
                                                        echo "font-weight:bold";
                                                    } else {
                                                        echo "font-weight:400";
                                                    } ?>;" class="dropdown-item" href="#" id="notif-item">
                                            <small><i>
                                                    <!-- 
                                                        0: "id"
                                                        1: "name"
                                                        2: "type"
                                                        3: "message"
                                                        4: "status"
                                                        5: "date"
                                                        6: "reserved_date"
                                                    -->
                                                    <?php echo $rows[5] ?>
                                                </i></small><br />
                                            <?php echo "You just successfully reserved an" ?> <br /> <?php echo "appointment on {$rows[6]}" ?>
                                        </a>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>
                                <li><a class="dropdown-item">
                                    <?php
                                    echo "No notifications available.";
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Logout Confirmation
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Select "Logout" below if you are ready to end your current session.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <a class="btn btn-primary ml-1" href="auth-logout.php">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>