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
    case "ADD_ROLE":
        add_role($conn);
        break;
    default:
        echo "System Error!";
}

function add_user($conn)
{

    if (isset($_POST['hospital'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $hosp = $_POST['hospital'];
        $role = $_POST['role'];
        $img = 'avatar.jpg';

        //Create a new object (ChatUser) which is linked to another chat_user_database

        $user_object = new ChatUser;
    
        $user_object->setUserName($_POST['username']);
        $user_object->setFirstName($_POST["firstname"]);
        $user_object->setLastName($_POST["lastname"]);
        $user_object->setUserEmail($_POST['email']);
        $user_object->setUserPassword($_POST['password']);
        $user_object->setRole($_POST['role']);
        $user_object->setHosptial($_POST["hospital"]);
        $user_object->setUserProfile($user_object->make_avatar(strtoupper($_POST['user_name'][0])));
        $user_object->setUserStatus('Enable');
        $user_object->save_data();
        //$user_data = $user_object->get_user_data_by_email();


        $sql = "INSERT INTO user SET first_name='$firstname',last_name='$lastname',email='$email', 
        username='$username', password='$pass', role='$role', hospital='$hosp', user_profile='$img', status='online'";
        if (mysqli_query($conn, $sql)) {
            header('location:users.php');
        }
    } else {
        $hosp = '-';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $img = 'avatar.jpg';

        //Create a new object (ChatUser) which is linked to another chat_user_database

        $user_object = new ChatUser;

        $user_object->setUserName($_POST['username']);
        $user_object->setFirstName($_POST["firstname"]);
        $user_object->setLastName($_POST["lastname"]);
        $user_object->setUserEmail($_POST['email']);
        $user_object->setUserPassword($_POST['password']);
        $user_object->setRole($_POST['role']);
        $user_object->setHosptial('-');
        $user_object->setUserProfile($user_object->make_avatar(strtoupper($_POST['user_name'][0])));
        $user_object->setUserStatus('Enable');
        $user_object->save_data();


        $sql = "INSERT INTO user SET first_name='$firstname',last_name='$lastname',email='$email', 
        username='$username', password='$pass', role='$role', hospital='$hosp', user_profile='$img', status='online'";
        if (mysqli_query($conn, $sql)) {
            header('location:users.php');
        }
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
        $_SESSION["pic"] = $userdet["user_profile"];
        $_SESSION["email"] = $userdet["email"];
        $_SESSION["user_login_status"] = "Login";
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

function add_hospital($conn)
{

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
    //chat user table modification here



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

    $user_object = new ChatUser;
    $user_object->setUserId($_POST['id']);
    $user_object->setUserName($_POST['username']);
    $user_object->setFirstName($_POST["firstname"]);
    $user_object->setLastName($_POST["lastname"]);
    $user_object->setUserEmail($_POST['email']);
    $user_object->setUserPassword($_POST['password']);
    $user_object->setRole($_POST['role']);
    $user_object->setHosptial($_POST["hospital"]);
    $user_object->update_data();
    //hospital might be empty

    $sql = "UPDATE user SET first_name='$firstname',last_name='$lastname',email='$email', username='$username', password='$pass', role='$role', hospital='$hosp' WHERE user_id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:users.php');
    }
}
//this is used to update the profile picture and the other info
function update_profile($conn)
{
    $id = $_POST['id'];
    $firstname = $_POST['firstnameuser'];
    $lastname = $_POST['lastnameuser'];
    $email = $_POST['emailuser'];
    $hosp = $_POST['hospitaluser'];
    $image = time() . '-' . $_FILES["file_to_upload"]["name"];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $image_file_type = pathinfo($target_file, PATHINFO_EXTENSION);

    $user_object = new ChatUser;
    $user_object->setUserId($_POST['id']);
    $user_object->setFirstName($_POST["firstname"]);
    $user_object->setLastName($_POST["lastname"]);
    $user_object->setUserEmail($_POST['email']);
    $user_object->setHosptial($_POST["hospital"]);

    if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE user SET first_name='$firstname',last_name='$lastname',email='$email', hospital='$hosp', 
        user_profile='$image' WHERE user_id='$id'";
        $user_object->setUserProfile($image);
        $user_object->upload_profile();
        
        //chat user table modification here
        
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION["name"] = $firstname;
            $_SESSION["hospital"] = $lastname;
            $_SESSION["pic"] = $image;
            header('location:user-profile.php');
        }
    } else {
        echo "A error has occured uploading.";
    }
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
function add_role($conn)
{

    $displayname = $_POST['dispname'];
    $hospital = $_POST['hospital'];

    $sql = "INSERT INTO roles SET role_name='$displayname',hospital='$hospital'";
    if (mysqli_query($conn, $sql)) {
        header('location:hospitals.php');
    }
}

// Additional function for the chatting

function get_user_data_by_email($conn, $user_email)
{
    $email = $user_email;
    $query = "
		SELECT * FROM user 
		WHERE email = :user_email
		";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_email', $email);

    if ($statement->execute()) {
        $user_data = $statement->fetch_assoc();
    }
    return $user_data;
}

function update_user_login_data($conn, $user_login_status, $user_id, $user_token)
{
    //$user_login_status = $_SESSION["user_login_status"];
    //$user_id = $_SESSION["user_id"];
    $query = "
		UPDATE user 
		SET user_login_status = :user_login_status, user_token = :user_token  
		WHERE user_id = :user_id
		";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_login_status', $user_login_status);

    $statement->bind_param(':user_token', $user_token);

    $statement->bind_param(':user_id', $user_id);

    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}

function get_user_data_by_id($conn, $userid)
{
    $user_id = $userid;
    $query = "
		SELECT * FROM user 
		WHERE user_id = :user_id";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_id', $user_id);

    try {
        if ($statement->execute()) {
            $user_data = $statement->fetch_assoc();
        } else {
            $user_data = array();
        }
    } catch (Exception $error) {
        echo $error->getMessage();
    }
    return $user_data;
}
/*
function upload_image($user_profile)
{
    $extension = explode('.', $user_profile['name']);
    $new_name = rand() . '.' . $extension[1];
    $destination = 'images/' . $new_name;
    move_uploaded_file($user_profile['tmp_name'], $destination);
    return $destination;
}
*/


function get_user_all_data($conn)
{
    $query = "
		SELECT * FROM user
		";

    $statement = $conn->prepare($query);

    $statement->execute();

    $data = $statement->fetch_assoc();

    return $data;
}

function get_user_all_data_with_status_count($conn, $user_id)
{
    //$user_id = $_SESSION["user_id"];
    $query = "
		SELECT user_id, username, user_profile, user_login_status, (SELECT COUNT(*) 
        FROM chat_message WHERE to_user_id = :user_id AND from_user_id = chat_user_table.user_id AND status = 'No') 
        AS count_status FROM chat
		";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_id', $user_id);

    $statement->execute();

    $data = $statement->fetch_assoc();

    return $data;
}

function update_user_connection_id($conn, $connection_id, $user_token)
{
    $user_connection_id = $connection_id;
    $query = "
		UPDATE user
		SET user_connection_id = :user_connection_id 
		WHERE user_token = :user_token
		";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_connection_id', $user_connection_id);

    $statement->bind_param(':user_token', $user_token);

    $statement->execute();
}

function get_user_id_from_token($conn, $token)
{
    $user_token = $token;
    $query = "
		SELECT user_id FROM user
		WHERE user_token = :user_token
		";

    $statement = $conn->prepare($query);

    $statement->bind_param(':user_token', $user_token);

    $statement->execute();

    $user_id = $statement->fetch_assoc();

    return $user_id;
}
