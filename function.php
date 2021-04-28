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
    case "ADD_HOSP":
        add_hospital($conn);
        break;
    case "DELETE_HOSP":
        delete_hospital($conn);
        break;
    case "UPDATE_HOSP":
        update_hospital($conn);
        break;
    case "DELETE_USER":
        delete_user($conn);
        break;
    case "UPDATE_USER":
        update_user($conn);
        break;
    case "UPDATE_PROFILE":
        update_profile($conn);
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
    $img = 'avatar.jpg';


    $sql = "INSERT INTO user SET first_name='$firstname',last_name='$lastname',email='$email', username='$username', password='$pass', role='$role', hospital='$hosp', user_profile='$img'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["name"] = $firstname;
        $_SESSION["hospital"] = $hosp;
        $_SESSION["role"] = $role;
        header('location:users.php');
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

function add_hospital($conn){

    $hospname = $_POST['hospname'];
    $hospcompany = $_POST['hospcomp'];
    $hospphone = $_POST['hospphone'];
    $hospaddress = $_POST['hospadd'];

    $sql = "INSERT INTO hospital SET hosp_name='$hospname',hosp_company='$hospcompany',hosp_phone='$hospphone', hosp_address='$hospaddress'";
    if (mysqli_query($conn, $sql)) {
        header('location:hospitals.php');
    }

}
function delete_user($conn)
{

    $userid = $_REQUEST['id'];
    $sql = "DELETE user FROM user WHERE user_id=$userid";
    if (mysqli_multi_query($conn, $sql)) {
        header('location:users.php');
    }
}

function update_user($conn)
{
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $hosp = $_POST['hospital'];
    $role = $_POST['role'];

    $sql = "UPDATE user SET first_name='$firstname',last_name='$lastname',email='$email', username='$username', password='$pass', role='$role', hospital='$hosp' WHERE user_id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:users.php');
    }
    
}

function update_profile($conn)
{
    $id = $_POST['id'];
    $firstname = $_POST['firstnameuser'];
    $lastname = $_POST['lastnameuser'];
    $email = $_POST['emailuser'];
    $hosp = $_POST['hospitaluser'];
    $image = time() . '-' . $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    $sql = "UPDATE user SET first_name='$firstname',last_name='$lastname',email='$email', hospital='$hosp', user_profile='$image' WHERE user_id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:user-profile.php');
    }
   }else
       echo 'error!';
}

function delete_hospital($conn)
{

    $hospid = $_REQUEST['id'];
    $sql = "DELETE hospital FROM hospital WHERE hosp_id=$hospid";
    if (mysqli_multi_query($conn, $sql)) {
        header('location:hospitals.php');
    }
}

function update_hospital($conn)
{
    $id = $_POST['id'];
    $hospname = $_POST['hospname'];
    $hospcompany = $_POST['hospcomp'];
    $hospphone = $_POST['hospphone'];
    $hospaddress = $_POST['hospadd'];

    $sql = "UPDATE hospital SET hosp_name='$hospname',hosp_company='$hospcompany',hosp_phone='$hospphone', hosp_address='$hospaddress' WHERE hosp_id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:hospitals.php');
    }
}
