<?php

function console_log($output, $with_script_tags = true)
{
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
		');';
	if ($with_script_tags) {
		$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
}
//action.php


if (isset($_POST['action']) && $_POST['action'] == 'leave') {
	session_start();
	require('database/ChatUser.php');

	$user_object = new ChatUser;

	$user_object->setUserStatus('offline');

	$user_object->setUserId($_POST['user_id']);

	$user_object->setUserLoginStatus('Logout');

	$user_object->setUserToken($_SESSION['user_data'][$_POST['user_id']]['token']);

	if ($user_object->update_user_login_data()) {
		unset($_SESSION['user_data']);

		session_destroy();

		echo json_encode(['status' => 1]);
	} else {
		echo "bad status";
	}
}
if (isset($_POST["action"]) && $_POST["action"] == 'fetch_chat') {
	require 'database/PrivateChat.php';

	$private_chat_object = new PrivateChat;

	$private_chat_object->setToUserId($_POST["from_user_id"]);

	$private_chat_object->setFromUserId($_POST["to_user_id"]);

	$private_chat_object->change_chat_status();

	$data = json_encode($private_chat_object->get_all_chat_data());

	//echo convert_from_latin1_to_utf8_recursively($data);
	//echo json_encode($private_chat_object->get_all_chat_data());
	//echo mb_convert_encoding($private_chat_object->get_all_chat_data(), 'UTF-8', 'UTF-8');
	//echo $private_chat_object->get_all_chat_data();
	//print_r(json_encode($private_chat_object->get_all_chat_data()));

	echo $data;
}
?>
