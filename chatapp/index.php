<?php

session_start();
header('Content-type: text/html; charset=utf-8');

$error = '';
if(isset($_SESSION['user_data']))
{
    //echo $_SESSION['user_data'];
    header('location:privatechat.php');
}
if(isset($_POST['login']))
{
   
    require_once('database/ChatUser.php');

    $user_object = new ChatUser;

    $user_object->setUserEmail($_POST['email']);

    $user_data = $user_object->get_user_data_by_email();

    //print_r($user_data);

    if(is_array($user_data) && count($user_data) > 0)
    {
        if($user_data['password'] == $_POST['password'])
        {
            $user_object->setUserId($user_data['user_id']);
            $user_object->setUserStatus("online");
            $user_object->setUserLoginStatus('Login');
            $user_token = md5(uniqid());
            //print_r($user_token);

            $user_object->setUserToken($user_token);

            if($user_object->update_user_login_data())
            {
                //echo '<script>alert("Session data is inserted here")</script>';
                //print_r($user_data);
                $_SESSION['user_data'][$user_data['user_id']] = [
                        'id'    =>  $user_data['user_id'],
                        'name'  =>  $user_data['username'],
                        'first_name' => $user_data['first_name'],
                        'last_name' => $user_data['last_name'],
                        'profile'   =>  $user_data['user_profile'],
                        'token' =>  $user_token,
                ];
                header('location:privatechat.php');

            } else {
                //echo "update is wrong";
                //echo '<script>console.log("Session data is not inserted here")</script>';
            }
        }
        else
        {
            $error = 'Wrong Password';
        }
    }
    else
    {
        $error = 'Wrong Email Address';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Load Chat from Mysql Database | PHP Chat Application using Websocket</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="vendor-front/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="vendor-front/parsley/parsley.css"/>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor-front/jquery/jquery.min.js"></script>
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
</head>

<body>

    <div class="container">
        <br />
        <br />
        <h1 class="text-center">Realtime One to One Chat App using Ratchet WebSockets with PHP Mysql - Online Offline Status - 8</h1>
        <div class="row justify-content-md-center mt-5">
            
            <div class="col-md-4">
               <?php
               if(isset($_SESSION['success_message']))
               {
                    echo '
                    <div class="alert alert-success">
                    '.$_SESSION["success_message"] .'
                    </div>
                    ';
                    unset($_SESSION['success_message']);
               }

               if($error != '')
               {
                    echo '
                    <div class="alert alert-danger">
                    '.$error.'
                    </div>
                    ';
               }
               ?>
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post" id="login_form">
                            <div class="form-group">
                                <label>Enter Your Email Address</label>
                                <input type="text" name="email" id="email"  class="form-control" data-parsley-type="email" required />
                            </div>
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" name="password" id="password" class="form-control" required />
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="login" id="login" class="btn btn-primary" value="Login" />
                            </div>
                        </form>
                        <a href="register.php">Register</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>

$(document).ready(function(){
    
    $('#login_form').parsley();
    
});

</script>