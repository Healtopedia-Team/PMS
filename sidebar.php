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
                <li class="sidebar-item <?php if ($your_variable=="request-appointment") {echo "active"; } 
     else{echo"noactive";}?>" >
                    <a href="request-appointment.html" class='sidebar-link'>
                        <i class="bi bi-person-check-fill"></i>
                        <span>Request Appointment</span>
                    </a>
                </li>
                <li class="sidebar-item <?php if ($your_variable=="appointment-list" || $your_variable=="view-appointment") {echo "active"; } 
     else{echo"noactive";}?>" >
                    <a href="appointment-list.html" class='sidebar-link'>
                        <i class="bi bi-list-ul"></i>
                        <span>Appointment List</span>
                    </a>
                </li>
                <li class="sidebar-item <?php if ($your_variable=="setting") {echo "active"; } 
     else{echo"noactive";}?>" >
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
