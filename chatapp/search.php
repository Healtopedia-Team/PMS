<?php
    session_start();
    require_once('database/Database_connection.php');

    $db = new Database_connection();

    $conn = $db->connect();
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$outgoing_id = $_SESSION['user_id'];
    $searchTerm = $_POST['searchTerm'];
    $login_user_id = $_POST['login_user_id'];
    //print_r($_POST['searchTerm']);
    if ($searchTerm !== ' '){
        $stmt = $conn->prepare("SELECT * FROM chat_user_table WHERE first_name LIKE '$searchTerm%' OR last_name LIKE '$searchTerm%'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);
        $output = '';
        if(count($result) > 0){
            foreach($result as $key=>$value){
                if ($value['user_id'] !== $login_user_id){
                    $output .=
                        '<li class="contact select_user" data-userid = "' . $value['user_id'] . '" value="info-' . $value['user_id'] . '" " >
                            <div class="wrap">
                                <span class="contact-status ' . $value['status'] . '"></span>
                                <img src= "../assets/images/faces/1.jpg" alt="" />
                                <div class="meta">
                                        <p class="name" id="list_user_name_' . $value['user_id'] . '">' . $value['first_name'] . " " . $value["last_name"] . '</p>
                                    <p class="preview"> Is this the user you are finding? </p>
                                </div>
                            </div>
                        </li>';
                }
                
            }
        
        } else {
            $output .=
                        '<li class="contact">
                            <div class="wrap">
                                <span class="contact-status offline"></span>
                                <img src= "../assets/images/faces/1.jpg" alt="" />
                                <div class="meta">
                                    <p class="name">No available users</p>
                                    <p> No messages here</p>
                                </div>
                            </div>
                        </li>';
        }
        echo $output;

    } else 
    {
        foreach ($_SESSION['user_data'] as $key => $value) {
            //print_r($value['id']);
            $login_user_id = $value['id'];
            $token = $value['token'];
            $firstname = $value['first_name'];
            $lastname = $value['last_name'];
            $user_profile = $value['profile'];
        }

        $user_object = new ChatUser;

        $user_object->setUserId($login_user_id);

        $user_data = $user_object->get_user_all_data_with_status_count();

        $output = '';

        foreach ($user_data as $key => $user) {
            //print_r($user['user_login_status']);
            $icon = '<i class="fa fa-circle text-danger"></i>';

            if ($user['user_login_status'] === 'Login') {
                $icon = '<i class="fa fa-circle text-success"></i>';
            }
            //Only list the users that are not current user

            if ($user['user_id'] != $login_user_id) {

                if ($user['count_status'] > 0) {
                    $total_unread_message = '<span class="badge badge-danger badge-pill" style="float:right">New unread messages</span>';
                } else {
                    $total_unread_message = '';
                }

                $chat_object = new PrivateChat;

                $chat_object->setFromUserId($login_user_id);

                $chat_object->setToUserId($user['user_id']);

                $last_msg = $chat_object->get_last_message();

                //print_r($last_msg);

                if ($last_msg) {
                    $result = $last_msg['chat_message'];
                } else {
                    $result = "No message available";
                }
                if (strlen($result) > 28) {
                    $msg =  substr($result, 0, 28) . '...';
                } else {
                    $msg = $result;
                }
                if (isset($last_msg['from_user_id'])) {
                    ($login_user_id == $last_msg['from_user_id']) ? $you = "You: " : $you = "";
                } else {
                    $you = "";
                }
                $output .= '
                                    <!-- <a href="chat.php?user_id=' . $user['status'] . '"> -->
                                    <li class="contact select_user" data-userid = "' . $user['user_id'] . '" value="info-' . $user['user_id'] . '" " >
                                        <div class="wrap">
                                            <span class="contact-status ' . $user['status'] . '"></span>
                                            <img src= "../assets/images/faces/1.jpg" alt="" />
                                            <div class="meta">
                                                <p class="name" id="list_user_name_' . $user['user_id'] . '">' . $user['fullname'] . '</p>
                                                <p class="preview"> ' . $you . $msg . '</p>
                                            
                                            </div>
                                            <span id="userid_' . $user['user_id'] . '">' . $total_unread_message . '</span>
                                        </div>
                                    </li>';
                echo $output;
            }
        }
    }
?>