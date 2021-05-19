<?php
header('Content-type: text/html; charset=utf-8');

require('database/ChatUser.php');

require('database/PrivateChat.php');
if (!isset($_SESSION['user_data'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <!-- from private chat -->
    <link rel="shortcut icon" type="image/x-icon" href="https://production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="https://production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
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
    <link rel='stylesheet prefetch' type="text/css" href='../assets/vendors/fontawesome/all.min.js'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="admin-chat.css">
    <link href="chatapp/vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="chatapp/vendor-front/jquery/jquery.min.js"></script>
    <script src="chatapp/vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Chat Application</h3>
                            <p class="text-subtitle text-muted">An application for user to check Chat inbox</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chat Application</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div id="frame">
                        <div id="sidepanel">
                            <div id="profile">
                                <div class="wrap">
                                    <?php
                                    /*
                                        $login_user_id = '';
                                        $token = '';
                                        $fullname = '';
                                        $user_profile = '';
                                        //$status = '';
                                        */
                                    //print_r($_SESSION['user_data'][18]);
                                    foreach ($_SESSION['user_data'] as $key => $value) {
                                        //print_r($value['id']);
                                        $login_user_id = $value['id'];
                                        $token = $value['token'];
                                        $firstname = $value['first_name'];
                                        $lastname = $value['last_name'];
                                        $user_profile = $value['profile'];
                                        //$status = $value['status']

                                    ?>
                                        <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
                                        <input type="hidden" name="is_active_chat" id="is_active_chat" value="No" />
                                        <img id="profile-img" src="<?php echo $user_profile ?>" class="online" alt="" />
                                        <p>
                                            <?php echo $firstname . " " . $lastname ?>
                                        </p>
                                        <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                                        <input type="button" class="btn btn-primary mt-2 mb-2" id="logout" name="logout" value="Logout" hidden />
                                        <input type="button" class="btn btn-primary mt-1 mb-1" id="ref_userlist" name="ref" value="ref" hidden />
                                        <!-- this status options might be cancelled -->
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div id="search">

                                <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                                <input type="text" placeholder="Search contacts..." id="search" name="searchvalue">
                            </div>
                            <div id="contacts">

                                <!-- till here is the userlist part -->
                                <ul class="users-list">
                                    <?php
                                    /*
                                        $chat = new PrivateChat;
                                        $chat->setFromUserId(17);
                                        $chat->setToUserId(18);
                                        $result = $chat->get_all_chat_data();
                                        print_r($result);
                                        */

                                    $user_object = new ChatUser;

                                    $user_object->setUserId($login_user_id);

                                    $user_data = $user_object->get_user_all_data_with_status_count();
                                    //print_r($user_data[0]['count_status']);

                                    //$user_con =$user_object->get_user_data_by_id();
                                    //print_r($user_con);
                                    //print_r($user_data);

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
                                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
                            </div>
                        </div>

                        <div class="content">

                        </div>
                        <div class="nomessage">
                            <img id="chatboximg" src="../assets/chatmsg.png" alt="" />
                            <div class="startchat">
                                <h1>Start new chat now!</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        const searchBar = document.querySelector("#frame #search input");
        const usersList = document.querySelector('.users-list');
        const invisible_refresh = document.querySelector("#ref_userlist");
        var from_user_id = $('#login_user_id').val();
        invisible_refresh.onclick = () => {
            console.log("refresh userlist here")
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "userlist.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        //console.log(data);
                        usersList.innerHTML = data;
                        console.log("refresh userlist")

                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("login_user_id=" + from_user_id);
        };
        searchBar.onkeyup = () => {
            let searchTerm = searchBar.value;
            if (searchTerm != "") {
                searchBar.classList.add("active");
            } else {
                searchBar.classList.remove("active");
            }
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "search.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        //console.log(data);
                        if (searchBar.classList.contains("active")) {
                            usersList.innerHTML = data;
                            console.log(searchTerm)
                        } else {
                            invisible_refresh.click();
                        }
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("searchTerm=" + searchTerm + "& login_user_id=" + from_user_id);
        };

        $(document).ready(function() {

            var receiver_userid = '';

            var conn = new WebSocket('ws://0.0.0.0:8180?token=<?php echo $token; ?>');

            conn.onopen = function(event) {
                console.log('Connection Established');
            };

            conn.onmessage = function(event) {
                //$('.select_user.active').click();
                var data = JSON.parse(event.data);

                if (data.status_type == 'online') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-success"></i>');
                } else if (data.status_type == 'offline') {
                    $('#userstatus_' + data.user_id_status).html('<i class="fa fa-circle text-danger"></i>');
                } else {

                    var row_class = '';
                    var background_class = '';

                    if (data.from == 'Me') {
                        row_class = 'row justify-content-end';
                        style = "float:right; padding: 0px 10px 0px 10px;margin-right: -5px; margin-left: -5px;";
                        background_class = 'alert-success';
                    } else {
                        row_class = 'row justify-content-start';
                        style = "float:left; padding: 0px 10px 0px 10px;margin-right: -5px; margin-left: -5px;";
                        background_class = 'alert-primary';
                    }

                    if (receiver_userid == data.userId || data.from == 'Me') {
                        if ($('#is_active_chat').val() == 'Yes') {
                            var html_data = `
                                <div class="` + row_class + `" style="` + style + `">
                                    <div class="col-sm-9">
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

                        count_chat = 'New unread messages';

                        $('#userid_' + data.userId).html('<span class="badge badge-danger badge-pill" style="float: right;">' + count_chat + '</span>');
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
                </div>
                <div class="messages" id="messages_area">

                </div>
                <div class="message-input">
                    <form id="chat_form" method="POST">
                    <div class="wrap">
                        <input type="text" class="incoming_id" name="incoming_id" hidden>
                        <input style="float:left" type="text" name="message" class="input-field" id="chat_message" placeholder="Write your message..." />
                        <button style="float:right" type="submit" class="submitbutton"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                    </form>
                </div>
                    
			`;

                $('.content').html(html);
                //$(".content").trigger("create");
                $(".nomessage").css("display", "none");
                $(".content").css("display", "block");

                //$('#chat_form').parsley();
            }

            //userlist onclick part
            $(document).on('click', '.select_user', function() {

                receiver_userid = $(this).data('userid');
                //console.log(receiver_userid)

                var from_user_id = $('#login_user_id').val();
                //console.log(from_user_id)
                var receiver_user_name = $('#list_user_name_' + receiver_userid).text();

                $('.select_user.active').removeClass('active');

                $(this).addClass('active');

                make_chat_area(receiver_user_name);

                $('#is_active_chat').val('Yes');

                //load the history message
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        action: 'fetch_chat',
                        to_user_id: receiver_userid,
                        from_user_id: from_user_id,
                    },
                    //dataType: 'json',
                    //dataType: 'json',
                    //contentType: 'application/json; charset=utf-8',
                    cache: false,
                    success: function(result) {
                        data = jQuery.parseJSON(result);
                        if (data.length > 0) {
                            var html_data = '';

                            for (var count = 0; count < data.length; count++) {
                                var row_class = '';
                                var background_class = '';
                                var user_name = '';

                                if (data[count].from_user_id == from_user_id) {
                                    row_class = 'row justify-content-end';

                                    background_class = 'alert-success';

                                    user_name = 'Me';
                                } else {
                                    row_class = 'row justify-content-start';

                                    background_class = 'alert-primary';
                                    user_name = data[count].from_user_name;
                                }

                                html_data += `
                                                <div class="` + row_class + `" style="padding: 0px 10px 0px 10px; margin-right: -5px;
                                                margin-left: -5px;">
                                                    <div class="col-sm-9">
                                                        <div class="shadow alert ` + background_class + `" style="border-color:none">
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
                            //this line is for letting the unread message be read then no notice
                            $('#userid_' + receiver_userid).html('');

                            $('#messages_area').html(html_data);

                            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);


                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR)
                        console.log(errorThrown)
                        console.log(textStatus)
                    }
                })
            });



            $(document).on('submit', '#chat_form', function(event) {

                event.preventDefault();
                var user_id = parseInt($('#login_user_id').val());

                var message = $('#chat_message').val();

                //var file = $("#fileupload").val();

                var file = '';

                var data = {
                    userId: user_id,
                    msg: message,
                    //file: fileupload,
                    receiver_userid: receiver_userid,
                    command: 'private'
                };

                conn.send(JSON.stringify(data));

            });

            // might be cancelled!!!
            $('#logout').click(function() {

                user_id = $('#login_user_id').val();

                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        user_id: user_id,
                        action: 'leave'
                    },
                    success: function(result) {
                        console.log(result)
                        data = jQuery.parseJSON(result);

                        var response = data;
                        if (response.status == 1) {
                            conn.close();
                            console.log("Successfully log out")
                            location = 'index.php';
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR)
                        console.log(errorThrown)
                        console.log(textStatus)
                    }
                })

            });
        })
    </script>
</body>

</html>