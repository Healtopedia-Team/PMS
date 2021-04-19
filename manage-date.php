<?php
$conn = mysqli_connect("localhost", "myhealtopedia", "Healit20.", "AppsOnsite");

if (isset($_POST['submit'])) {
    
    $date = $_POST['ddate'];
    $date1 = $_POST['ddate1'];
    $date2 = $_POST['ddate2'];
    $date3 = $_POST['ddate3'];
    $date4 = $_POST['ddate4'];

    $sql = "INSERT INTO xdate(datedisable) VALUES('$date'),('$date1'),('$date2'),('$date3'),('$date4')";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Successfully close date");</script>';
    }
}

if (isset($_POST['deletedate'])) {
    
    $deletedate = $_POST['deletedate'];

    $sql = "DELETE FROM xdate WHERE id = '$deletedate'";

    if (mysqli_query($conn,$sql)) {
        echo '<script>alert("Success delete closed data");</script>';
    }
}

$result=mysqli_query($conn, "SELECT * FROM xdate WHERE datedisable != ''");
$user=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting - Patient Management System</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>
  
<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div class="container-fluid">
              <div class="alert alert-info" role="alert">
                  <h1>Manage Date</h1>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-sm">
                          <form method="POST">
                              <label>Date to close :</label>
                              <input type="text" name="ddate" class="form-control datepicker" autocomplete="off">
                              <br>
                              <label>Date to close :</label>
                              <input type="text" name="ddate1" class="form-control datepicker" autocomplete="off">
                              <br>
                              <label>Date to close :</label>
                              <input type="text" name="ddate2" class="form-control datepicker" autocomplete="off">
                              <br>
                              <label>Date to close :</label>
                              <input type="text" name="ddate3" class="form-control datepicker" autocomplete="off">
                              <br>
                              <label>Date to close :</label>
                              <input type="text" name="ddate4" class="form-control datepicker" autocomplete="off">
                              <br>
                              <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                          </form>
                      </div>
                      <div class="col-sm">
                          <table class="table table-bordered" style="text-align: center;">
                              <tr class="table-info">
                                  <th>DISABLED DATE</th>
                                  <th>DELETE</th>
                              </tr>
                              <?php foreach($user as $row): ?>
                                  <form method="POST">
                                  <tr>
                                      <td><?php echo $row['datedisable']; ?></td>
                                      <td>
                                          <button type="submit" name="deletedate" class="btn btn-danger">
                                              <i class="icon-trash"></i>
                                              <input type="text" name="deletedate" value="<?php echo $row['id']; ?>" style="display: none;">
                                          </button>
                                      </td>
                                  </tr>
                                  </form>
                              <?php endforeach; ?>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
    </div>
</body>
