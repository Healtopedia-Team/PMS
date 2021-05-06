<?php include '../dbconnect.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["name"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../auth-login.php");
	exit;
}
$username = $_SESSION["name"];
$user_id = $_SESSION["user_id"];

function console_log($output, $with_script_tags = true)
{
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
		');';
	if ($with_script_tags) {
		$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
}

?>
<?= console_log($username); ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html class=''>

<head>
	<script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
	<script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
	<script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
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
				<input type="text" placeholder="Search contacts..." id="search" name="searchvalue" onkeyup="search(this.value)">
			</div>
			<div id="contacts">
				<ul class="users-list">

				</ul>
			</div>
			<div id="bottom-bar">
				<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
				<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
			</div>
		</div>
		<div class="content">
			<div class="contact-profile">
				<img src="../assets/images/faces/1.jpg" alt="" />
				<p><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
				<div class="social-media">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</div>
			</div>
			<div class="messages">
				<ul>
					<li class="sent">
						<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
						<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
					</li>
					<li class="replies">
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<p>When you're backed against the wall, break the god damn thing down.</p>
					</li>
					<li class="replies">
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<p>Excuses don't win championships.</p>
					</li>
					<li class="sent">
						<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
						<p>Oh yeah, did Michael Jordan tell you that?</p>
					</li>
					<li class="replies">
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<p>No, I told him that.</p>
					</li>
					<li class="replies">
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<p>What are your choices when someone puts a gun to your head?</p>
					</li>
					<li class="sent">
						<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
						<p>What are you talking about? You do what they say or they shoot you.</p>
					</li>
					<li class="replies">
						<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
						<p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
					</li>
				</ul>
			</div>
			<div class="messages">
			</div>
			<form action='#' class="message-input">
				<div class="wrap">
					<input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>

					<input type="text" class="input-field" placeholder="Write your message..." />

					<button class="submitbutton"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
					<button><i class="fa fa-paperclip attachment" aria-hidden="true"></i></button>
				</div>
			</form>
		</div>
	</div>
	<script src="chat.js"></script>
	<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script>
		<?php
		function listalluser($user_id, $conn)
		{
			$outgoing_id = $user_id;
			$sql = "SELECT * FROM user WHERE NOT user_id = '$user_id' ORDER BY user_id DESC";
			$query = mysqli_query($conn, $sql);
			$output = "";
			if (mysqli_num_rows($query) == 0) {
				$output .= '<li class="contact">
                    <div class="wrap">
                        <span class="contact-status offline"></span>
                        <img src= "../assets/images/faces/1.jpg" alt="" />
                        <div class="meta">
                            <p class="name">Nobody</p>
                            <p class="preview"> No users are available to chat</p>
                        </div>
                    </div>
                </li>';
			} elseif (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_assoc($query)) {
					$sql2 = "SELECT * FROM chat WHERE (incoming_msg_id = {$row['user_id']}
										OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
										OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

					$query2 = mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($query2);
					if (mysqli_num_rows($query2) > 0) {
						$result = $row2['msg'];
					} else {
						$result = "No message available";
					}
					if (strlen($result) > 28) {
						$msg =  substr($result, 0, 28) . '...';
					} else {
						$msg = $result;
					}
					if (isset($row2['outgoing_msg_id'])) {
						($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
					} else {
						$you = "";
					}
					//($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

					$output .= '
                <li class="contact">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img src= "../assets/images/faces/1.jpg" alt="" />
                        <div class="meta">
                            <p class="name">' . $row['first_name'] . " " . $row['last_name'] . '</p>
                            <p class="preview"> ' . $you . $msg . '</p>
                        </div>
                    </div>
                </li>';
				}
			}
			echo $output;
		}
		?>
	</script>
	<script type="text/javascript">
		const usersList = document.querySelector('.users-list');

		function update() {
			$.ajax({
				type: 'GET',
				url: 'php/users.php',
				success: function(data) {
					usersList.innerHTML = data;
					console.log("Userlist update run here!");
					console.log(data);
				},
				error: function(e){
					console.log(e);
					console.log(data);
				}
			});
		};
		update();
		var refInterval = window.setInterval('update()', 10000); // 30 seconds
		function search(searchvalue) {
			$.ajax({
				url: "searchbar.php",
				type: "POST",
				data: {
					searchvalue: searchvalue
				},
				success: function(result) {
					searchvalue ? (usersList.innerHTML = result) : (usersList.innerHTML = '');
					console.log("Search function runs here!");				}
			});
		}
		/*
		fetch('php/users.php', {
				method: 'GET',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				},
			})
			.then(data => console.log(data));

		var refInterval = window.setInterval('update()', 10000); // 30 seconds

		var update = function() {
			$.ajax({
				type: 'GET',
				url: 'userlist.php',
				success: function(data) {
					usersList.innerHTML = data;
				},
			});
		};
		update();
		setInterval(() => {
			let xhr = new XMLHttpRequest()
			xhr.open('GET', "userlist.php", true)
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						if (!searchBar.classList.contains('active')) {
							usersList.innerHTML = data
						}
					}
				} else {
					alert('Connection issues!');
				}
			}
			xhr.send()
		}, 500)

		function searchBar(searchitem) {
			let searchTerm = searchitem
			let xhr = new XMLHttpRequest()
			xhr.open('POST', 'php/search.php', true)
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						//console.log(data);
						usersList.innerHTML = data
					}
				}
			}
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
			xhr.send('searchTerm=' + searchTerm)
		}
		*/
	</script>

	<script>
		<?php

		function userlist_php($user_id, $conn)
		{
			$outgoing_id = $user_id;
			$sqlu = "SELECT * FROM user WHERE NOT user_id='$outgoing_id' ORDER BY user_id DESC";
			$userlist = mysqli_query($conn, $sqlu);
			$output = "";
			if (mysqli_num_rows($userlist) == 0) {
				$output .= '<li class="contact">
										<div class="wrap">
											<div class="meta">
												<p class="name">Nobody</p>
												<p class="preview"> No users are available to chat</p>
											</div>
										</div>
									</li>';
			} elseif (mysqli_num_rows($userlist) > 0) {
				include_once "data.php";
			}
			echo $output;
		}
		$userlist = userlist_php($user_id, $conn);
		?>
	</script>
	<script>
		$(".messages").animate({
			scrollTop: $(document).height()
		}, "fast");

		$("#profile-img").click(function() {
			$("#status-options").toggleClass("active");
		});

		$(".expand-button").click(function() {
			$("#profile").toggleClass("expanded");
			$("#contacts").toggleClass("expanded");
		});

		$("#status-options ul li").click(function() {
			$("#profile-img").removeClass();
			$("#status-online").removeClass("active");
			$("#status-away").removeClass("active");
			$("#status-busy").removeClass("active");
			$("#status-offline").removeClass("active");
			$(this).addClass("active");

			if ($("#status-online").hasClass("active")) {
				$("#profile-img").addClass("online");
			} else if ($("#status-away").hasClass("active")) {
				$("#profile-img").addClass("away");
			} else if ($("#status-busy").hasClass("active")) {
				$("#profile-img").addClass("busy");
			} else if ($("#status-offline").hasClass("active")) {
				$("#profile-img").addClass("offline");
			} else {
				$("#profile-img").removeClass();
			};

			$("#status-options").removeClass("active");
		});

		function newMessage() {
			message = $(".message-input input").val();
			if ($.trim(message) == '') {
				return false;
			}
			$('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
			$('.message-input input').val(null);
			$('.contact.active .preview').html('<span>You: </span>' + message);
			$(".messages").animate({
				scrollTop: $(document).height()
			}, "fast");
		};

		$('.submit').click(function() {
			newMessage();
		});

		$(window).on('keydown', function(e) {
			if (e.which == 13) {
				newMessage();
				return false;
			}
		});
		//# sourceURL=pen.js
		//const phpscript = "";
		/*
		const usersList = document.querySelector('.users-list')
		setInterval(() => {
			let xhr = new XMLHttpRequest()
			xhr.open('GET', <?php echo $userlist ?>, true)
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						if (!searchBar.classList.contains('active')) {
							usersList.innerHTML = data
						}
					}
				} else {
					alert('Connection issues!');
				}
			}
			xhr.send()
		}, 500)

		const searchBar = document.querySelector('#search input')
		searchBar.onkeyup = () => {
			let searchTerm = searchBar.value
			let xhr = new XMLHttpRequest()
			xhr.open('POST', 'php/search.php', true)
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						//console.log(data);
						usersList.innerHTML = data
					}
				}
			}
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
			xhr.send('searchTerm=' + searchTerm)
		}
		*/
	</script>
</body>

</html>