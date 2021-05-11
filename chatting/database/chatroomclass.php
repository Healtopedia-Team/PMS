<?php
session_start();
//include "./dbconnect.php";
class ChatRooms
{
	private $chat_message_id;
	private $to_user_id;
	private $from_user_id;
	private $chat_message;
	private $timestamp;
	private $status;
	protected $connect;
	private $upload_file;
	private $img_or_not;
	private $filename;

	function setChatMessageId($chat_message_id)
	{
		$this->chat_message_id = $chat_message_id;
	}

	function getChatMessageId()
	{
		return $this->chat_message_id;
	}

	function setToUserId($to_user_id)
	{
		$this->to_user_id = $to_user_id;
	}

	function getToUserId()
	{
		return $this->to_user_id;
	}

	function setFromUserId($from_user_id)
	{
		$this->from_user_id = $from_user_id;
	}

	function getFromUserId()
	{
		return $this->from_user_id;
	}

	function setChatMessage($chat_message)
	{
		$this->chat_message = $chat_message;
	}

	function getChatMessage()
	{
		return $this->chat_message;
	}

	function setTimestamp($timestamp)
	{
		$this->timestamp = $timestamp;
	}

	function getTimestamp()
	{
		return $this->timestamp;
	}

	function setStatus($status)
	{
		$this->status = $status;
	}

	function getStatus()
	{
		return $this->status;
	}

	function setUpload_file($upload_file)
	{
		$this->upload_file = $upload_file;
	}

	function getUpload_file()
	{
		return $this->upload_file;
	}
	function setImg_or_not($img_or_not)
	{
		$this->img_or_not = $img_or_not;
	}

	function getImg_or_not()
	{
		return $this->img_or_not;
	}
	function setFilename($filename)
	{
		$this->filename = $filename;
	}

	function getFilename()
	{
		return $this->filename;
	}

	public function __construct()
	{
        include_once "./dbconnect.php";
		$this->connect = $conn;
	}

	function get_all_chat_data()
	{
		$query = "
		SELECT concat(a.first_name, ' ',  a.last_name) as from_user_name, concat(b.first_name, ' ',  b.last_name) as to_user_name, 
			chat_message, timestamp, status, to_user_id, from_user_id, upload_file, img_or_not, filename  
			FROM chat_message 
			INNER JOIN user a 
				ON chat_message.from_user_id = a.user_id 
			INNER JOIN user b 
				ON chat_message.to_user_id = b.user_id 
			WHERE (chat_message.from_user_id = :from_user_id AND chat_message.to_user_id = :to_user_id) 
			OR (chat_message.from_user_id = :to_user_id AND chat_message.to_user_id = :from_user_id)
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':from_user_id', $this->from_user_id);

		$statement->bind_param(':to_user_id', $this->to_user_id);

		$statement->execute();

		return $statement->fetch_assoc();
	}

	function save_chat()
	{
		$query = "
		INSERT INTO chat_message 
			(to_user_id, from_user_id, chat_message, timestamp, status, upload_file, img_or_not, filename ) 
			VALUES (:to_user_id, :from_user_id, :chat_message, :timestamp, :status, :upload_file, :img_or_not, :filename )
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':to_user_id', $this->to_user_id);

		$statement->bind_param(':from_user_id', $this->from_user_id);

		$statement->bind_param(':chat_message', $this->chat_message);

		$statement->bind_param(':timestamp', $this->timestamp);

		$statement->bind_param(':status', $this->status);

		$statement->bind_param(':upload_file', $this->upload_file);
		$statement->bind_param(':img_or_not', $this->img_or_not);
		$statement->bind_param(':filename', $this->filename);

		$statement->execute();

		return $this->connect->insert_id;
	}

	function update_chat_status()
	{
		$query = "
		UPDATE chat_message 
			SET status = :status 
			WHERE chat_message_id = :chat_message_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':status', $this->status);

		$statement->bind_param(':chat_message_id', $this->chat_message_id);

		$statement->execute();
	}

	function change_chat_status()
	{
		$query = "
		UPDATE chat_message 
			SET status = 'Yes' 
			WHERE from_user_id = :from_user_id 
			AND to_user_id = :to_user_id 
			AND status = 'No'
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':from_user_id', $this->from_user_id);

		$statement->bind_param(':to_user_id', $this->to_user_id);

		$statement->execute();
	}
}
