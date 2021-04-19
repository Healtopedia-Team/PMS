<?php
$conn = mysqli_connect("localhost","myhealtopedia","Healit20.","db_pms");

if (isset($_POST['submit'])){
  $name = $_POST['tryname'];
  $passport = $_POST['trypassport'];
  $phone = $_POST['tryphone'];
  
  $sql = "INSERT INTO requestappoint SET req_custname = '$name', req_custid = '$passport', req_custphone = '$phone'";
  
  if(mysqli_query($conn,$sql)){
    echo '<script>alert("Successfully added");</script>';
  }else{
    echo '<script>alert("Failed to added");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>TRY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <form method="POST">
        <div class="container">
            <label>Name :</label>
            <input type="text" name="tryname" class="form-control">

            <label>ID/Passport :</label>
            <input type="text" name="trypassport" class="form-control">

            <label>Phone No :</label>
            <input type="text" name="tryphone" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Submit</button>
    </form>
</body>
</html>
