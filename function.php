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
    case "DATECHECK":
        date_check($conn);
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

function date_check($conn){
    
    if (isset($_POST['submitdate'])) {
        $appdate = $_POST['datecheck'];
        $sql = "INSERT INTO requestappoint SET req_appdate = '$appdate', request_count = '1'";
        if(mysqli_query($conn,$sql)){
            header('location:index.php');
        }
    }
}
