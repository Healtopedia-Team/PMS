<?php

//privatechat.php

session_start();

if (!isset($_SESSION['name']) || $_SESSION["loggedin"] !== true) {
    header('location:index.php');
}

//this one might not be here but the root directory
if (isset($_SESSION['loggedin'])) {

    $user_email = $_SESSION['email'];
    $user_data = get_user_data_by_email($conn);

    $user_token = md5(uniqid());

    if (update_user_login_data($conn, $user_token)) {
        $_SESSION['user_data'][$user_data['user_id']] = [
            'id'    =>  $user_data['user_id'],
            'name'  =>  $user_data['username'],
            'profile'   =>  $user_data['user_profile'],
            'token' =>  $user_token,

        ];

        header('location:chatroom.php');
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
                //from private chat which shows the user list
                $login_user_id = '';
                $token = '';

                foreach ($_SESSION['user_data'] as $key => $value) {
                    $login_user_id = $value['id'];
                    $token = $value['token'];
                ?>
                    <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
                    <input type="hidden" name="is_active_chat" id="is_active_chat" value="No" />
                    <li class="contact">
                        <div class="wrap">
                            <span class="contact-status"></span>
                            <img src="<?php echo $value['profile']; ?>" alt="" />
                            <div class="meta">
                                <p class="name">Jonathan Sidwell</p>
                                <p class="preview"><span>You:</span> That's bullshit. This deal is solid.</p>
                            </div>
                        </div>
                    </li>
                <?php
                }
                //this part is about the get the user list with showing unread messages count

                get_user_all_data_with_status_count($login_user_id);

                ?>
                <!-- till here is the chat part -->
                <ul class="users-list">

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

                if (data.status_type == 'Online') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-success"></i>');
                } else if (data.status_type == 'Offline') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-danger"></i>');
                } else {

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
									<b>` + data.from + ` - </b>` + data.msg + `<br />
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
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col col-sm-6">
							<b>Chat with <span class="text-danger" id="chat_user_name">` + user_name + `</span></b>
						</div>
						<div class="col col-sm-6 text-right">
							<a href="chatroom.php" class="btn btn-success btn-sm">Group Chat</a>&nbsp;&nbsp;&nbsp;
							<button type="button" class="close" id="close_chat_area" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				<div class="card-body" id="messages_area">

				</div>
			</div>

			<form id="chat_form" method="POST" data-parsley-errors-container="#validation_error">
				<div class="input-group mb-3" style="height:7vh">
					<textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" data-parsley-maxlength="1000" data-parsley-pattern="/^[a-zA-Z0-9 ]+$/" required></textarea>
					<div class="input-group-append">
						<button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
				<div id="validation_error"></div>
				<br />
			</form>
			`;

                $('#chat_area').html(html);

                $('#chat_form').parsley();
            }

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
                        if (data.length > 0) {
                            var html_data = '';

                            for (var count = 0; count < data.length; count++) {
                                var row_class = '';
                                var background_class = '';
                                var user_name = '';

                                if (data[count].from_user_id == from_user_id) {
                                    row_class = 'row justify-content-start';

                                    background_class = 'alert-primary';

                                    user_name = 'Me';
                                } else {
                                    row_class = 'row justify-content-end';

                                    background_class = 'alert-success';

                                    user_name = data[count].from_user_name;
                                }

                                html_data += `
							<div class="` + row_class + `">
								<div class="col-sm-10">
									<div class="shadow alert ` + background_class + `">
										<b>` + user_name + ` - </b>
										` + data[count].chat_message + `<br />
										<div class="text-right">
											<small><i>` + data[count].timestamp + `</i></small>
										</div>
									</div>
								</div>
							</div>
							`;
                            }

                            $('#userid_' + receiver_userid).html('');

                            $('#messages_area').html(html_data);

                            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);
                        }
                    }
                })

            });

            $(document).on('click', '#close_chat_area', function() {

                $('#chat_area').html('');

                $('.select_user.active').removeClass('active');

                $('#is_active_chat').val('No');

                receiver_userid = '';

            });

            $(document).on('submit', '#chat_form', function(event) {

                event.preventDefault();

                if ($('#chat_form').parsley().isValid()) {
                    var user_id = parseInt($('#login_user_id').val());

                    var message = $('#chat_message').val();

                    var data = {
                        userId: user_id,
                        msg: message,
                        receiver_userid: receiver_userid,
                        command: 'private'
                    };

                    conn.send(JSON.stringify(data));
                }

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