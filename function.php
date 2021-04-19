<?php
include 'dbconnect.php';

$theCommand = $_REQUEST['command'];
switch ($theCommand) {
    case "ADD_USER":
        add_user($conn);
        break;
    case "CHECK_USER":
        check_user($conn);
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
        header('location:index.php');
    }
}

function check_user($conn)
{


    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
    if (mysqli_query($conn, $sql)) {
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
