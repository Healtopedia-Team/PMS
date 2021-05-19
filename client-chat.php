<?php

session_start();

// The link and href is not done yet !!! Be aware of that
if ($_SESSION["role"] !== 'admin') {
    $login_user_email = $_SESSION['email'];
    require_once('database/ChatUser.php');
    $user_object = new ChatUser;
    $user_object->setUserEmail($login_user_email);
    $user_data = $user_object->get_user_data_by_email();
    $login_user_id = $user_data['user_id'];
    $_SESSION['chat_user_id'] = $login_user_id;
    $token = $user_data['token'];
    $firstname = $user_data['first_name'];
    $lastname = $user_data['last_name'];
    $user_profile = $user_data['profile'];
    $hospital = $user_data['hospital'];

    $user_object->setRole('admin');
    $user_object->setHosptial($hospital);
    $hospital_userid = $user_object->get_userid_of_hospital_admin();
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
    <link rel="stylesheet" type="text/css" href="client-chat.css">
    <link href="chatapp/vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="chatapp/vendor-front/jquery/jquery.min.js"></script>
    <script src="chatapp/vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main">
            <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
            <input type="hidden" name="hospital_user_id" id="hospital_user_id" value="<?php echo $hospital_userid; ?>" />
            <input type="hidden" name="hospital_name" id="hospital_name" value="<?php echo $hospital_name; ?>" />
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
                    <div class="row">
                        <div class="col-12" id="client-chat">
                            <!--
                        <div class="card" id="nochat">
                            <div class="card-header">
                                <h5 class="card-title">Coming Soon!</h5>
                            </div>
                            <div class="card-body">
                                If you want to contribute. Check out this <a href="https://github.com/zuramai/mazer" target="_blank">template repository</a>.
                            </div>
                        </div>
                        -->
                            <div id="chat_section">

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
        $(document).ready(function() {
            var from_user_id = $('#login_user_id').val();
            var receiver_userid = $('#hospital_user_id').val();
            var conn = new WebSocket('ws://0.0.0.0:8180?token=<?php echo $token; ?>');

            conn.onopen = function(event) {
                console.log('Connection Established');
            };

            conn.onmessage = function(event) {
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
                        <form id="file_form" method="POST" action="uploadfile.php">
                            <div class="wrap fileuploadbtn">
                                <input type="text" name="from_user_id" hidden>
                                <input type="text" name="to_user_id" hidden>
                                <!-- <input type="file" id="fileupload" name="file" onchange="loadFile(event)"> -->
                        <input type="file" id="fileupload" name="file">
                        <p id="storefile" hidden></p>
                        <button style="float:left" type="submit" class="attachmentbtn" name="files">
                            <i class="fa fa-paperclip attachment" aria-hidden="true"> </i></button>
                    </div>
                    </form>
                    <form id="chat_form" method="POST">
                        <div class="wrap">
                            <input type="text" class="incoming_id" name="incoming_id" hidden>
                            <input style="float:left" type="text" name="message" class="input-field" id="chat_message" placeholder="Write your message..." required/>
                            <button style="float:right" type="submit" class="submitbutton"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>`;

                $('#chat_section').html(html);
                //$(".content").trigger("create");
                //$(".nomessage").css("display", "none");
                //$(".content").css("display", "block");

                //$('#chat_form').parsley();
            };

            //userlist onclick part
            $(document).on('load', '#chat_section', function() {

                //receiver_userid = $(this).data('userid');
                //console.log(receiver_userid)

                var from_user_id = $('#login_user_id').val();
                //console.log(from_user_id)
                var receiver_user_name = $('#hospital_name').val();

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
                                html_data += ` <div class="` + row_class + `" style="padding: 0px 10px 0px 10px; margin-right: -5px;
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
                            //$('#userid_' + receiver_userid).html('');

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

                var file = '';

                var data = {
                    userId: user_id,
                    msg: message,
                    receiver_userid: receiver_userid,
                    command: 'private'
                };

                conn.send(JSON.stringify(data));

            });

        })
    </script>
</body>

</html>