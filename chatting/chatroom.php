<?php 
session_start();

if(!isset($_SESSION['name']))
{
	header('location:index.php');
}

require('chatroomclass.php');

$chat_object = new ChatRooms;

$chat_data = $chat_object->get_all_chat_data();


?>