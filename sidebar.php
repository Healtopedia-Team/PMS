<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$your_variable = basename($_SERVER['PHP_SELF'], ".php"); 
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
                    <ul class="submenu <?php if ($your_variable=="request-appointment-all" || $your_variable=="request-addappoint" || $your_variable=="request-appointment-pending" || $your_variable=="request-appointment-postponed" || $your_variable=="request-appointment-approved" || $your_variable=="manage-date" || $your_variable=="manage-time") {echo "active"; }else{echo"noactive";}?>">
                        <li class="submenu-item <?php if ($your_variable=="request-appointment-all" || $your_variable=="request-appointment-pending" || $your_variable=="request-appointment-postponed" || $your_variable=="request-appointment-approved") {echo "active"; }else{echo"noactive";}?>">
                            <a href="request-appointment-all.php">Request List</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable=="request-addappoint") {echo "active"; }else{echo"noactive";}?>">
                            <a href="request-addappoint.php">Add Request</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable=="manage-date") {echo "active"; }else{echo"noactive";}?>">
                            <a href="manage-date.php">Manage Date</a>
                        </li>
                        <li class="submenu-item <?php if ($your_variable=="manage-time") {echo "active"; }else{echo"noactive";}?>">
                            <a href="manage-time.php">Manage Time</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item <?php if ($your_variable=="appointment-list-all" || $your_variable=="view-appointment") {echo "active"; }else{echo"noactive";}?>">
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
                    <ul class="submenu <?php if ($your_variable=="update-profile") {echo "active"; }else{echo"noactive";}?>">
                        <li class="submenu-item <?php if ($your_variable=="update-profile") {echo "active"; }else{echo"noactive";}?>">
                            <a href="update-profile.php">Update Profile</a>
                        </li>
                    </ul>
                <ul class="sidebar-item <?php if ($your_variable=="users") {echo "active"; }else{echo"noactive";}?>">
                    <a href="users.php" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Users</span>
                    </a>
                </ul>
                <ul class="sidebar-item <?php if ($your_variable=="hospitals") {echo "active"; }else{echo"noactive";}?>">
                    <a href="hospitals.php" class='sidebar-link'>
                        <i class="bi bi-house-fill"></i>
                        <span>Hospitals</span>
                    </a>
                </ul>
                    </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
