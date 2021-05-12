<?php

//privatechat.php

session_start();
include "dbconnect.php";


if (!isset($_SESSION['name']) || $_SESSION["loggedin"] !== true) {
    header('location:index.php');
}

//this one might not be here but the root directory
if (isset($_SESSION['loggedin'])) {
    $user_email = $_SESSION['email'];
    $user_data = get_user_data_by_email($conn, $user_email);
    $user_token = md5(uniqid());
    //put the token into the session
    $_SESSION["user_token"] = $user_token;
    // this is for further use (more complicated)
    if (update_user_login_data($conn, $user_token, $user_data['user_id'], $user_data['user_login_status'])) {
        $_SESSION['user_data'][$user_data['user_id']] = [
            'id'    =>  $user_data['user_id'],
            'name'  =>  $user_data['username'],
            'profile'   =>  $user_data['user_profile'],
            'token' =>  $user_token,
        ];
    }
}

?>

<!DOCTYPE html>
<html class=''>

<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

    <script src="https://use.typekit.net/hoy3lrg.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>
    <link rel='stylesheet prefetch' href='../assets/vendors/fontawesome/all.min.js'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link rel="stylesheet" href="chat.css">
</head>

<body>
    <!-- 

A concept for a chat interface. 

Try writing a new message! :)


Follow me here:
Twitter: https://twitter.com/thatguyemil
Codepen: https://codepen.io/emilcarlsson/
Website: http://emilcarlsson.se/

-->

    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                <div class="wrap">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE first_name = '$username'");
                    $row = mysqli_fetch_assoc($sql);
                    $_SESSION["user_id"] = $row['user_id'];
                    ?>

                    <img id="profile-img" src="../assets/images/faces/1.jpg" class="online" alt="" />
                    <p><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
                    <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                    <div id="status-options">
                        <ul>
                            <li id="status-online" class="active"><span class="status-circle"></span>
                                <p>Online</p>
                            </li>
                            <li id="status-away"><span class="status-circle"></span>
                                <p>Away</p>
                            </li>
                            <li id="status-busy"><span class="status-circle"></span>
                                <p>Busy</p>
                            </li>
                            <li id="status-offline"><span class="status-circle"></span>
                                <p>Offline</p>
                            </li>
                        </ul>
                    </div>
                    <div id="expanded">
                        <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
                        <input name="twitter" type="text" value="mikeross" />
                        <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
                        <input name="twitter" type="text" value="ross81" />
                        <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
                        <input name="twitter" type="text" value="mike.ross" />
                    </div>
                </div>
            </div>
            <div id="search">
                <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                <input type="text" placeholder="Search contacts..." id="search" name="searchvalue">
            </div>
            <div id="contacts">
                <?php
                //from private chat
                $login_user_id = '';
                $token = '';
                //Just obtain the current user data from the session
                foreach ($_SESSION['user_data'] as $key => $value) {
                    $login_user_id = $value['id'];
                    $token = $value['token'];
                ?>
                    <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
                    <input type="hidden" name="is_active_chat" id="is_active_chat" value="No" />
                <?php
                }
                //this part is about the get the user list with showing unread messages count
                // retrieve all users from database with unread message count
                $user_data = get_user_all_data_with_status_count($conn, $login_user_id);

                ?>
                <!-- till here is the chat part -->
                <ul class="users-list">
                    <?php

                    foreach ($user_data as $key => $user) {
                        $icon = '<i class="fa fa-circle text-danger"></i>';

                        if ($user['user_login_status'] == 'Login') {
                            $icon = '<i class="fa fa-circle text-success"></i>';
                        }
                        //Only list the users that are not current user

                        if ($user['user_id'] != $login_user_id) {
                            if ($user['count_status'] > 0) {
                                $total_unread_message = '<span class="badge badge-danger badge-pill">' . $user['count_status'] . '</span>';
                            } else {
                                $total_unread_message = '';
                            }
                            $last_message = "SELECT * FROM chat_message WHERE (to_user_id = {$user['user_id']}
                                            OR from_user_id = {$user['user_id']}) AND (from_user_id = '$login_user_id'
                                            OR to_user_id = '$login_user_id') ORDER BY chat_message_id DESC LIMIT 1";

                            $last_message_query = mysqli_query($conn, $last_message);
                            $last_msg = mysqli_fetch_assoc($last_message_query);
                            if (mysqli_num_rows($last_message_query) > 0) {
                                $result = $last_msg['chat_messasge'];
                            } else {
                                $result = "No message available";
                            }
                            if (strlen($result) > 28) {
                                $msg =  substr($result, 0, 28) . '...';
                            } else {
                                $msg = $result;
                            }
                            if (isset($last_msg['outgoing_msg_id'])) {
                                ($outgoing_id == $last_msg['outgoing_msg_id']) ? $you = "You: " : $you = "";
                            } else {
                                $you = "";
                            }
                            $output .= '
                                <!-- <a href="chat.php?user_id=' . $user['user_id'] . '"> -->
                                <li class="contact select_user" data-userid = "' . $user['user_id'] . '" value="info-' . $user['user_id'] . '" " >
                                    <div class="wrap">
                                        <span class="contact-status ' . $user['status'] . '"></span>
                                        <img src= "../assets/images/faces/1.jpg" alt="" />
                                        <div class="meta">
                                            <p class="name" id="list_user_name_"' . $user['user_id'] . '"">' . $user['first_name'] . " " . $user['last_name'] . '</p>
                                            <p class="preview"> ' . $you . $msg . '</p>
                                        </div>
                                        <span style="float:right" id="userid_' . $user['user_id'] . '">"' . $total_unread_message . '"</span>
                                    </div>
                                </li>';
                            echo $output;
                            /*
                            echo "
							<a class='list-group-item list-group-item-action select_user' style='cursor:pointer' data-userid = '" . $user['user_id'] . "'>
								<img src='" . $user["user_profile"] . "' class='img-fluid rounded-circle img-thumbnail' width='50' />
								<span class='ml-1'>
									<strong>
										<span id='list_user_name_" . $user["user_id"] . "'>" . $user['user_name'] . "</span>
										<span id='userid_" . $user['user_id'] . "'>" . $total_unread_message . "</span>
									</strong>
								</span>
								<span class='mt-2 float-right' id='userstatus_" . $user['user_id'] . "'>" . $icon . "</span>
							</a>
							";
                            */
                        }
                    }


                    ?>
                </ul>
            </div>
            <div id="bottom-bar">
                <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>

        <div class="content">

        </div>
        <div class="nomessage">
            <img id="chatboximg" src="assets/img/chatmsg.png" alt="" />
            <div class="startchat">
                <h1>Start new chat now!</h1>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            var receiver_userid = '';

            var conn = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');

            conn.onopen = function(event) {
                console.log('Connection Established');
            };

            conn.onmessage = function(event) {
                var data = JSON.parse(event.data);
                // wondering if these two if is necessary or not , as it is to show the online/offline one
                //might need to change
                if (data.status_type == 'Online') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-success"></i>');
                } else if (data.status_type == 'Offline') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-danger"></i>');
                } else {
                    //chat room chatbubblebox part
                    var row_class = '';
                    var background_class = '';

                    if (data.from == 'Me') {
                        row_class = 'row justify-content-start';
                        background_class = 'alert-primary';
                    } else {
                        row_class = 'row justify-content-end';
                        background_class = 'alert-success';
                    }

                    if (receiver_userid == data.userId || data.from == 'Me') {
                        if ($('#is_active_chat').val() == 'Yes') {
                            var html_data = `
						<div class="` + row_class + `">
							<div class="col-sm-10">
								<div class="shadow-sm alert ` + background_class + `">
									<b>` + data.from + `-</b>` + data.msg + `<br />
									<div class="text-right">
										<small><i>` + data.datetime + `</i></small>
									</div>
								</div>
							</div>
						</div>
						`;

                            $('#messages_area').append(html_data);

                            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

                            $('#chat_message').val("");
                        }
                    } else {
                        var count_chat = $('#userid' + data.userId).text();

                        if (count_chat == '') {
                            count_chat = 0;
                        }

                        count_chat++;

                        $('#userid_' + data.userId).html('<span class="badge badge-danger badge-pill">' + count_chat + '</span>');
                    }
                }
            };

            conn.onclose = function(event) {
                console.log('connection close');
            };

            function make_chat_area(user_name) {
                var html = `
                <div class="contact-profile">
                    <img src="../assets/images/faces/1.jpg" alt="" />
                    <p class="person_received">` + user_name + `</p>
                    <div class="social-media">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="messages" id="messages_area">

                </div>
                <form action="#" class="message-input" id="chat_form">
                    <div class="wrap">
                        <input type="text" class="incoming_id" name="incoming_id" hidden>
                        <input type="text" name="message" class="input-field" id="chat_message" placeholder="Write your message..." />
                        <input type="file" id="fileupload" name="file" hidden>
                        <button class="submitbutton"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <button class="attachmentbtn"><i class="fa fa-paperclip attachment" aria-hidden="true"></i></button>
                    </div>
                </form>
			`;

                $('.content').html(html);

                //$('#chat_form').parsley();
            }
            //here needs to change the userlist on click features pls take a look slowly
            //to do part

            $(document).on('click', '.select_user', function() {

                receiver_userid = $(this).data('userid');

                var from_user_id = $('#login_user_id').val();

                var receiver_user_name = $('#list_user_name_' + receiver_userid).text();

                $('.select_user.active').removeClass('active');

                $(this).addClass('active');

                make_chat_area(receiver_user_name);

                $('#is_active_chat').val('Yes');

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        action: 'fetch_chat',
                        to_user_id: receiver_userid,
                        from_user_id: from_user_id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data)
                        if (data.length > 0) {
                            var html_data = '';

                            for (var count = 0; count < data.length; count++) {
                                var row_class = '';
                                var background_class = '';
                                var user_name = '';
                                //chatbubble
                                //here is sender(the current user)
                                if (data[count].from_user_id == from_user_id) {
                                    if (data[count].chat_msg !== null) {
                                        output = `
                                    <li class="sent" 
                                        style="display: inline-block; clear: both;
                                        float: right; margin: 15px 15px 5px 15px;
                                        width: calc(100%-25px); font-size: 0.9em;">
                                        <img id="profile-img" src="../assets/images/faces/2.jpg" 
                                            class="online" alt="" style="margin: 6px 0 0 8px; width: 22px;
                                            border-radius: 50%; float: right;"/>
                                        <p style="background: #d5ebff; color: #000000; display: inline-block; float:right;
                                            padding: 10px 15px;
                                            border-radius: 20px;
                                            max-width: 205px;
                                            line-height: 100%;"> ` + data[count].chat_message + ` </p>
                                    </li>`;
                                    } else { //means the message is a file
                                        if (data[count].img_or_not) { //means that it is an image
                                            output = `
                                            <li class="sent" 
                                                style = "display: inline-block; clear: both;
                                                float: right;
                                                margin: 15 px 15 px 5 px 15 px;
                                                width: calc(100% -25 px);
                                                font-size: 0.9 em;
                                            "> 
                                            <img id = "profile-img"
                                                src = "../assets/images/faces/2.jpg"
                                                class = "online" alt = ""
                                                style = "margin: 6px 0 0 8px; width: 22px;
                                                border-radius: 50% ; float: right; "/> 
                                                <p style = "background: #d5ebff; color: #000000; 
                                                    display: inline-block; float:right;
                                                    padding: 10 px 15 px;
                                                    border-radius: 20 px;
                                                    max-width: 205 px;
                                                    line-height: 100% ;">  
                                                    <img style = "max-width: 100%; max-height: 100%;"
                                                        src = "` + data[count].upload_file + `"
                                                        alt = "" > 
                                                </p> 
                                            </li>`;
                                        } else {
                                            output = `
                                            <li class="sent" 
                                            style = "display: inline-block; clear: both;
                                            float: right; margin: 15 px 15 px 5 px 15 px;
                                            width: calc(100%-25 px); font-size: 0.9 em; "> 
                                                <img id = "profile-img" src = "../assets/images/faces/2.jpg"
                                                class = "online"  alt = ""
                                                style = "margin: 6px 0 0 8px; width: 22px;
                                                border-radius: 50% ; float: right; "/> 
                                                <p style="background: #d5ebff; color: #000000; display: inline-block; float:right;
                                                padding: 10 px 15 px; border-radius: 20 px; max-width: 205 px;
                                                line-height: 100% ;">  
                                                    <a href="` + data[count].upload_file + `" download= "` + data[count].filename + `" >
                                                        <i class = "fa fa-download" aria-hidden = "true" > < /i>
                                                        ` + data[count].filename + ` 
                                                    </a> 
                                                </p > 
                                            </li>`;
                                        }

                                    }

                                } else { // this is the target chat user
                                    if (data[count].chat_msg !== null) {
                                        output = `<li class="replies" style="display: inline-block;
                                                        clear: both; float: left;
                                                        margin: 15px 15px 5px 15px; width: calc(100% - 25px);
                                                        font-size: 0.9em;">
                                                        <img id="profile-img" src="../assets/images/faces/1.jpg" 
                                                            class="online" alt=""  style="margin: 6px 8px 0 0; width: 22px;
                                                            border-radius: 50%; float: left;"/>
                                                        <p style="background: #000000; float: left; display: inline-block; 
                                                            color:white; float:left;
                                                            padding: 10px 15px; border-radius: 20px;
                                                            max-width: 205px; line-height: 100%;">` + data[count].chat_message + `</p>
                                                    </li>`;
                                    } else {
                                        if ($row['img_or_not']) { //means that it is an image
                                            output = `
                                            <li class="replies" style="display: inline-block;
                                                clear: both; float: left;
                                                margin: 15px 15px 5px 15px; width: calc(100% - 25px);
                                                font-size: 0.9em;">
                                                <img id="profile-img" src="../assets/images/faces/1.jpg" 
                                                    class="online" alt=""  style="margin: 6px 8px 0 0; width: 22px;
                                                    border-radius: 50%; float: left;"/>
                                                <p style="background: #000000; float: left; display: inline-block; 
                                                    color:white; float:left;
                                                    padding: 10px 15px; border-radius: 20px;
                                                    max-width: 205px; line-height: 150%;">
                                                    <img style="max-width: 100%; max-height: 100%;" 
                                                        src="` + data[count].upload_file + `" alt="">
                                                </p>
                                            </li>`;
                                        } else {
                                            output = `
                                                <li class="replies" style="display: inline-block;
                                                    clear: both; float: left;
                                                    margin: 15px 15px 5px 15px; width: calc(100% - 25px);
                                                    font-size: 0.9em;">
                                                    <img id="profile-img" src="../assets/images/faces/1.jpg" 
                                                        class="online" alt=""  style="margin: 6px 8px 0 0; width: 22px;
                                                        border-radius: 50%; float: left;"/>
                                                    <p style="background: #000000; float: left; display: inline-block; 
                                                        color:white; float:left;
                                                        padding: 10px 15px; border-radius: 20px;
                                                        max-width: 205px; line-height: 150%;">
                                                        <a href="` + data[count].upload_file + `" download= "` + data[count].filename + `" >
                                                        <i class = "fa fa-download" aria-hidden = "true" > < /i>
                                                        ` + data[count].filename + ` 
                                                        </a> 
                                                    </p>
                                                </li>`
                                        }
                                    }
                                }

                                html_data += output;
                            }
                            //this line is for letting the unread message be read then no notice
                            $('#userid_' + receiver_userid).html('');

                            $('#messages_area').html(html_data);

                            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);
                        }
                    }
                })

            });

            $(document).on('submit', '#chat_form', function(event) {

                event.preventDefault();
                var user_id = parseInt($('#login_user_id').val());

                var message = $('#chat_message').val();

                var data = {
                    userId: user_id,
                    msg: message,
                    receiver_userid: receiver_userid,
                    command: 'private'
                };

                conn.send(JSON.stringify(data));

            });

            $('#logout').click(function() {

                user_id = $('#login_user_id').val();

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        user_id: user_id,
                        action: 'leave'
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.status == 1) {
                            conn.close();

                            location = 'index.php';
                        }
                    }
                })

            });

        })
    </script>

</html>