<?php
session_start();

include 'dbconnect.php';

$theCommand = $_REQUEST['command'];
switch ($theCommand) {
    case "ADD_USER":
        add_user($conn);
        break;
    case "CHECK_USER":
        check_user($conn);
        break;
    case "TRY":
        tryme($conn);
        break;
    case "REQ_APPOINT":
        request_appointment($conn);
        break;
    default:
        echo "System Error!";
}

function add_user($conn)
{

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $hosp = $_POST['hospital'];
    $role = $_POST['role'];


    $sql = "INSERT INTO user SET first_name='$firstname',last_name='$lastname',email='$email', username='$username', password='$pass', role='$role', hospital='$hosp'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["name"] = $firstname;
        $_SESSION["hospital"] = $hosp;
        $_SESSION["role"] = $role;
        header('location:index.php');
    }
}

function check_user($conn)
{


    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
    if (mysqli_query($conn, $sql)) {

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$pass'");
        $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION["loggedin"] = true;
        $_SESSION["name"] = $userdet["first_name"];
        $_SESSION["hospital"] = $userdet["hospital"];
        $_SESSION["role"] = $userdet["role"];
        header('location:index.php');
    } else {
?>

        <div class="alert">
            <span class="closebtn" onclick="location.href = 'auth-login.php';">&times;</span>
            <strong>Invalid!</strong> Incorrect password!
            <?php include 'auth-login.php'; ?>
        </div>
<?php

    }
}

function tryme($conn){
    
    if (isset($_POST['submit'])){
  $name = $_POST['tryname'];
  $passport = $_POST['trypassport'];
  $phone = $_POST['tryphone'];
  
  $sql = "INSERT INTO requestappoint SET req_custname = '$name', req_custid = '$passport', req_custphone = '$phone'";
  
  if(mysqli_query($conn,$sql)){
   header('location:index.php');
  }
}
}

function checkdate($conn){
    if (isset($_POST['submitdate'])){
        $appdate=$_POST['checkdate'];
        $sql = "INSERT INTO requestappoint SET req_appdate='$appdate', request_count='1'";
        if(mysqli_query($conn, $sql)){
            $last_id = mysqli_insert_id($conn);
            echo '<script>alert("Success!");</script>';
        }else{
            echo '<script>alert("Try again!");</script>';
        }
    }
}

function request_appointment($conn){
    if (isset($_POST['submitrequest'])) {
    $reqpackname=$_POST['reqpackname'];
    $custname=$_POST['custname'];
    $custpassport=$_POST['custpassport'];
    $custphone=$_POST['custphone'];
    $custaddress=$_POST['custaddress'];
    $appdate=$_POST['appdate'];
    $apptime=$_POST['apptime'];
    $reqstatus=$_POST['reqstatus'];

    $sql = "INSERT INTO requestappoint(req_packname, req_custname, req_custid, req_custphone, req_custaddress, req_appdate, req_apptime, req_status) VALUES ('$reqpackname','$custname','$custpassport','$custphone','$custaddress','$appdate','$apptime','$reqstatus')";
    if (mysqli_query($conn, $sql)){
        header('location:index.php');
    }
}
}
