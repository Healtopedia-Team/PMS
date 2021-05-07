<?php

$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true){
    header("location: auth-login.php");
    exit;
}else{
    $name = $_SESSION["name"];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE first_name = '$name'");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

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
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>My Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="avatar avatar-xxxl">
                                <?php foreach ($data as $row){ ?>
                                <form method="POST" action="function.php" enctype="multipart/form-data">
                                    <input type="hidden" name="command" value="UPDATE_PROFILE">
                                    <input type="hidden" name="id" value="<?php echo $row['user_id'];?>">
    
                                    <img src="images/<?php if ($row['user_profile'] ==""){ echo "avatar.jpg";}echo $row['user_profile'];?>"  id="profileDisplay" onClick="triggerClick()">
                                    <input type="file" name="file_to_upload"id="file_to_upload" onChange="displayImage(this)" class="form-control" style="display: none;" accept='image/*'>
                                    <br>
                                    <center><br>
                                        <h6>Firstname</h6>
                                        <input type="text" name="firstnameuser" value="<?php echo $row['first_name'];?>" class="form-control" style="width: 400px;">
                                        <br>
                                        <h6>Lastname</h6>
                                        <input type="text" name="lastnameuser" value="<?php echo $row['last_name'];?>" class="form-control" style="width: 400px;">
                                        <br>
                                        <h6>Email</h6>
                                        <input type="text" name="emailuser" value="<?php echo $row['email'];?>" class="form-control" style="width: 400px;">
                                        <br>
                                        <h6>Hospital</h6>
                                        <input type="text" name="hospitaluser" value="<?php echo $row['hospital'];?>" class="form-control" style="width: 400px;" read-only>
                                        <?php } ?>
                                        <br>
                                        <button type="submit" name="saveprofile" class="btn btn-primary">SAVE</button>
                                </form>
                                    </center>
                            </div>
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
                        <p>Powered By Atiq<span class="text-danger"><i class="bi bi-heart"></i></span></p>
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
     
     function triggerClick(e) {
            document.querySelector('#file_to_upload').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>
