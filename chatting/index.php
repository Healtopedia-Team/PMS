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
<script src="../assets/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src='../assets/vendors/jquery/jquery.min.js'></script>
<!------ Include the above in your HEAD tag ---------->


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
				<ul class="users-list">

				</ul>
			</div>
			<div id="bottom-bar">
				<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
				<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
			</div>
		</div>
		<!--
		<div class="content">
			<div class="contact-profile">
				<img src="../assets/images/faces/1.jpg" alt="" />
				<p class="person_received"><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
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
					<button class="attachmentbtn"><i class="fa fa-paperclip attachment" aria-hidden="true"></i></button>
				</div>
			</form>
		</div>
		-->
		<!-- 
		
		-->
		<div class="content">

		</div>
		<div class="nomessage">
			<img id="chatboximg" src="assets/img/chatmsg.png" alt="" />
			<div class="startchat">
				<h1>Start new chat now!</h1>
			</div>

		</div>
	</div>
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
		const searchBar = document.querySelector("#frame #search input");
		const userItem = document.querySelectorAll(".users-list li");
		const chatBox = document.querySelector(".content")
		//const userItem = document.querySelector('.users-list li');
		//const activeItem = document.querySelector('.users-list li .active');
		//const searchIcon = document.querySelector(".#frame search label");
		//const usersList = document.querySelector('.users-list');
		/*function Clickuser() {
			var elems = userItem.querySelector(".active");
			if (elems !== null) {
				elems.classList.remove("active");
			}
			console.log("active hihi !");
			userItem.classList.add("active");
		}*/

		var target_userid = 0;
		$("#contacts").on("click", ".contact", function() {
			const elems = document.querySelector(".active");
			if (elems !== null) {
				elems.classList.remove("active");
			}
			console.log("active selection!");
			$(this).addClass("active");
			if ($(this).hasClass("active")) {
				$(".nomessage").css("display", "none");
				$(".content").css("display", "block");
				target_userid = $(this).attr("id").split("info-").join("");
				//alert(target_userid);
				console.log(target_userid);
				$.ajax({
					url: "obtainTargetUserID.php",
					method: "POST",
					data: {
						"target_userid": target_userid
					},
					success: function(result) {
						console.log("Obtain function runs here!");
						chatBox.innerHTML = result;
						const form = document.querySelector(".content form");
						console.log(form);
						//ForChatting(target_userid);
					},
					error: function(e) {
						console.log(e);
					}
				})
			}
		});

		const form = document.querySelector(".content .message-input"),
			incoming_id = target_userid,
			//inputField = form.querySelector(".input-field"),
			//sendBtn = form.querySelector(".submitbutton"),
			//attachBtn = form.querySelector(".attachmentbtn")
			ChatBubbleBox = document.querySelector(".content .messages"),
			personContactWith = document.querySelector(".content .contact-profile .person-received");
		console.log("anything here")
		/*
		form.onsubmit = (e) => {
			e.preventDefault();
		}

		inputField.focus();
		inputField.onkeyup = () => {
			if (inputField.value != "") {
				sendBtn.classList.add("active");
			} else {
				sendBtn.classList.remove("active");
			}
		};

		//Not doing first
		attachBtn.onclick = () => {
		  let xhr = new XMLHttpRequest()
		  xhr.open('POST', 'php/insert-attach.php', true)
		  xhr.onload = () => {
		    if (xhr.readyState === XMLHttpRequest.DONE) {
		      if (xhr.status === 200) {
		        inputField.value = '' //clear the input once submitted
		        scrollToBottom()
		      }
		    }
		  }
		  let formData = new FormData(form)
		  console.log(formData)
		  xhr.send(formData)
		}
		ChatBubbleBox.onmouseenter = () => {
		  ChatBubbleBox.classList.add('active')
		}
		*/
		/*
		sendBtn.onclick = () => {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "insert-chat.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						inputField.value = ""; //clear the input once submitted
						scrollToBottom();
					}
				}
			};
			let formData = new FormData(form);
			console.log(formData)
			xhr.send(formData);
		}
		*/
		ChatBubbleBox.onmouseenter = () => {
			ChatBubbleBox.classList.add("active");
		};

		ChatBubbleBox.onmouseleave = () => {
			ChatBubbleBox.classList.remove("active");
		};

		setInterval(() => {
			let xhr = new XMLHttpRequest();
			console.log('getting chat data here outside!')
			xhr.open("POST", "get-chat.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response;
						ChatBubbleBox.innerHTML = data;
						//personContactWith.innerHTML=data;
						console.log("getting chat data here!");

						if (!ChatBubbleBox.classList.contains("active")) {
							scrollToBottom();
						}
					}
				}
			};
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send("incoming_id=" + incoming_id);
		}, 500);

		function scrollToBottom() {
			ChatBubbleBox.scrollTop = ChatBubbleBox.scrollHeight;
		}

		function ForChatting(target_userid) {
			const form = document.querySelector(".content .message-input"),
				incoming_id = target_userid,
				inputField = form.querySelector(".input-field"),
				sendBtn = form.querySelector(".submitbutton"),
				//attachBtn = form.querySelector(".attachmentbtn")
				ChatBubbleBox = document.querySelector(".content .messages"),
				personContactWith = document.querySelector(".content .contact-profile .person-received");
			console.log("anything here")
			form.onsubmit = (e) => {
				e.preventDefault();
			}
			inputField.focus();
			inputField.onkeyup = () => {
				if (inputField.value != "") {
					sendBtn.classList.add("active");
				} else {
					sendBtn.classList.remove("active");
				}
			};
			/*
			//Not doing first
			attachBtn.onclick = () => {
			  let xhr = new XMLHttpRequest()
			  xhr.open('POST', 'php/insert-attach.php', true)
			  xhr.onload = () => {
			    if (xhr.readyState === XMLHttpRequest.DONE) {
			      if (xhr.status === 200) {
			        inputField.value = '' //clear the input once submitted
			        scrollToBottom()
			      }
			    }
			  }
			  let formData = new FormData(form)
			  console.log(formData)
			  xhr.send(formData)
			}
			ChatBubbleBox.onmouseenter = () => {
			  ChatBubbleBox.classList.add('active')
			}
			*/

		sendBtn.onclick = () => {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "js/insert-chat.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						inputField.value = ""; //clear the input once submitted
						scrollToBottom();
					}
				}
			};
			let formData = new FormData(form);
			console.log(formData)
			xhr.send(formData);
		}
		ChatBubbleBox.onmouseenter = () => {
			ChatBubbleBox.classList.add("active");
		};

		ChatBubbleBox.onmouseleave = () => {
			ChatBubbleBox.classList.remove("active");
		};

		setInterval(function() {
			let xhr = new XMLHttpRequest();
			console.log('getting chat data here outside!')
			xhr.open("POST", "js/get-chat.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response;
						ChatBubbleBox.innerHTML = data;
						//personContactWith.innerHTML=data;
						console.log("getting chat data here!");

						if (!ChatBubbleBox.classList.contains("active")) {
							scrollToBottom();
						}
					}
				}
			};
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send("incoming_id=" + incoming_id);
		}(), 5000);

		function scrollToBottom() {
			ChatBubbleBox.scrollTop = ChatBubbleBox.scrollHeight;
		}

		}
		$.ajax({
			url: "obtainTargetUserID.php",
			method: "POST",
			data: {
				"target_userid": target_userid
			},
			success: function(result) {
				console.log("Obtain function runs here!");
				console.log(result);
			},
			error: function(e) {
				console.log(e);
			}
		})



		searchBar.onkeyup = () => {
			let searchTerm = searchBar.value;
			if (searchTerm != "") {
				searchBar.classList.add("active");
			} else {
				searchBar.classList.remove("active");
			}
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "php/search.php", true);
			xhr.onload = () => {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response;
						//console.log(data);
						if (searchBar.classList.contains("active")) {
							usersList.innerHTML = data;
							console.log(searchTerm)
						} else {
							refreshUserList();
						}
					}
				}
			};
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send("searchTerm=" + searchTerm);
		};
		const Contentbox = document.querySelector(".content");

		function getUserChatRoom() {
			let xhr = new XMLHttpRequest()
			xhr.open('GET', "chatroom.php", true)
			//console.log("Runs under xhr.open!")
			xhr.onload = () => {
				console.log("Runs inside xhr.onload chatroom!")
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						Contentbox.innerHTML = data;
						//console.log('Connection issues inside!');
						//console.log(data)
					}
				} else {
					//console.log('Connection issues!');
				}
			}
			//console.log("Runs under xhr.onload!")
			xhr.send()
		}

		function refreshUserList() {
			let xhr = new XMLHttpRequest()
			xhr.open('GET', "userlist.php", true)
			//console.log("Runs under xhr.open!")
			xhr.onload = () => {
				console.log("Runs inside xhr.onload!")
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						let data = xhr.response
						if (!searchBar.classList.contains("active")) {
							usersList.innerHTML = data;
						}
						//console.log('Connection issues inside!');
						//console.log(data)
					}
				} else {
					//console.log('Connection issues!');
				}
			}
			//console.log("Runs under xhr.onload!")
			xhr.send()
		}
		refreshUserList();
		setInterval(refreshUserList, 600000);



		/*
		function selectUsera(e) {
			const elems = document.querySelector(".active");
			if (elems !== null) {
				elems.classList.remove("active");
			}
			console.log("active hihi !");
			e.target.classList.add("active");
		}

		function selectUser(e) {
			var elems = document.querySelectorAll(".active");
			[].forEach.call(elems, function(el) {
				el.classList.remove("active");
			});
			e.target.classList.add("active");
			console.log("outside click");
		}

		function myFunction(e) {
			if (document.querySelectorAll('.active') !== null) {
				document.querySelectorAll('.active').classList.remove('active');
			}
			document.querySelectorAll('.users-list li').classList.add("active");
			console.log("inner click");
		}

		const userItem = usersList.querySelector('li');
		console.log(userItem);
		for (let i = 0; i < userItem.length; i++) {
			userItem[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
			});
		}

		function search(searchvalue) {
			$.ajax({
				url: "searchbar.php",
				type: "POST",
				data: {
					searchvalue: searchvalue
				},
				success: function(result) {
					searchvalue ? (usersList.innerHTML = result) : (usersList.innerHTML = '');
					console.log("Search function runs here!");
				},
				error: function(e) {
					console.log(e);
				}
			});
		}

		function update() {
			$.ajax({
				type: 'GET',
				url: 'php/users.php',
				success: function(data) {
					usersList.innerHTML = data;
					console.log("Userlist update run here!");
					console.log(data);
				},
				error: function(e) {
					console.log(e);
				}
			});
		};
		update();
		var refInterval = window.setInterval('update()', 10000); // 30 seconds
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
		$userhhhhlist = userlist_php($user_id, $conn);
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