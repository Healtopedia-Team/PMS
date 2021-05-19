<?php
session_start();
//include "./dbconnect.php";
header('Content-type: text/html; charset=utf-8');

class PrivateChat
{
	private $chat_message_id;
	private $to_user_id;
	private $from_user_id;
	private $chat_message;
	private $timestamp;
	private $chat_status;
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

	function setStatus($chat_status)
	{
		$this->chat_status = $chat_status;
	}

	function getStatus()
	{
		return $this->chat_status;
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
		require_once('Database_connection.php');

		$db = new Database_connection();

		$this->connect = $db->connect();
	}

	function get_all_chat_data()
	{
		/*
		$query = "
		SELECT concat(a.first_name, ' ',  a.last_name)  as from_user_name, concat(b.first_name, ' ',  b.last_name) as to_user_name, 
			chat_message, timestamp, chat_status, to_user_id, from_user_id, upload_file, img_or_not, filename  
			FROM chat_message 
			INNER JOIN user a 
				ON chat_message.from_user_id = a.user_id 
			INNER JOIN user b 
				ON chat_message.to_user_id = b.user_id 
			WHERE (chat_message.from_user_id = :from_user_id AND chat_message.to_user_id = :to_user_id) 
			OR (chat_message.from_user_id = :to_user_id AND chat_message.to_user_id = :from_user_id)
		";
		*/
		$query = "
		SELECT a.username as from_user_name, b.username as to_user_name, chat_message, timestamp, chat_status, to_user_id, from_user_id  
			FROM chat_message 
		INNER JOIN chat_user_table a 
			ON chat_message.from_user_id = a.user_id 
		INNER JOIN chat_user_table b 
			ON chat_message.to_user_id = b.user_id 
		WHERE (chat_message.from_user_id = :from_user_id AND chat_message.to_user_id = :to_user_id) 
		OR (chat_message.from_user_id = :to_user_id AND chat_message.to_user_id = :from_user_id)
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':from_user_id', $this->from_user_id);

		$statement->bindParam(':to_user_id', $this->to_user_id);

		$statement->execute();

		//return $statement->errorInfo();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	function check_upload_file(){
		if (!empty($this->upload_file)) {
			$allowedExts = array(
				"jpg", "jpeg", "gif", "png", "7z", "rar", "zip", "tar.gz", "csv",
				"xlsx", "xls", "xlsm", "doc", "docx", "txt", "pdf"
			);
			$imgExts = array("jpg", "jpeg", "gif", "png");
			$isImgOrNot = true;
			$extension = pathinfo($this->upload_file['file']['name'], PATHINFO_EXTENSION);
			$target_dir = "uploads/";
			if (in_array($extension, $imgExts)) {
				$isImgOrNot = 1;
			} else {
				$isImgOrNot = 0;
			}

			if (($this->upload_file["file"]["size"] < 250000000) && in_array($extension, $allowedExts)) {
				if ($this->upload_file["file"]["error"] > 0) {
					echo "Return Code: " . $this->upload_file["file"]["error"] . "<br />";
				} else {
					if (is_uploaded_file($this->upload_file["file"]["tmp_name"])) {
						$_source_path = $this->upload_file["file"]["tmp_name"];
						$_filename = $this->upload_file['file']['name'];
						$target_path = $target_dir . $this->upload_file["file"]["name"];
						if (move_uploaded_file($_source_path, $target_path)) {
							$this->setUpload_file($target_path);
							$this->setImg_or_not($isImgOrNot);
							$this->setFilename($_filename);
						}
					}
				}
			} else {
				echo "Invalid file";
			}
		}
	}
		/*
	function save_chat()
	{
		$query = "
		INSERT INTO chat_message 
			(to_user_id, from_user_id, chat_message, timestamp, chat_status) 
			VALUES (:to_user_id, :from_user_id, :chat_message, :timestamp, :status)
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':to_user_id', $this->to_user_id);

		$statement->bindParam(':from_user_id', $this->from_user_id);

		$statement->bindParam(':chat_message', $this->chat_message);

		$statement->bindParam(':timestamp', $this->timestamp);

		$statement->bindParam(':status', $this->chat_status);

		$statement->execute();
		//echo $statement->errorInfo();

		return $this->connect->lastInsertId();
	}
	*/


	function save_chat()
	{
		$query = "
		INSERT INTO chat_message 
			(to_user_id, from_user_id, chat_message, timestamp, chat_status, upload_file, img_or_not, filename ) 
			VALUES (:to_user_id, :from_user_id, :chat_message, :timestamp, :chat_status, :upload_file, :img_or_not, :filename )
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':to_user_id', $this->to_user_id);

		$statement->bindParam(':from_user_id', $this->from_user_id);

		$statement->bindParam(':chat_message', $this->chat_message);

		$statement->bindParam(':timestamp', $this->timestamp);

		$statement->bindParam(':chat_status', $this->chat_status);

		$statement->bindParam(':upload_file', $this->upload_file);
		$statement->bindParam(':img_or_not', $this->img_or_not);
		$statement->bindParam(':filename', $this->filename);

		$statement->execute();

		return $this->connect->insert_id;
	}

	function update_chat_status()
	{
		$query = "
		UPDATE chat_message 
			SET chat_status = :chat_status 
			WHERE chat_message_id = :chat_message_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':chat_status', $this->chat_status);

		$statement->bindParam(':chat_message_id', $this->chat_message_id);

		$statement->execute();
	}

	function change_chat_status()
	{
		$query = "
		UPDATE chat_message 
			SET chat_status = 'Yes' 
			WHERE from_user_id = :from_user_id 
			AND to_user_id = :to_user_id 
			AND chat_status = 'No'
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':from_user_id', $this->from_user_id);

		$statement->bindParam(':to_user_id', $this->to_user_id);

		$statement->execute();
	}

	function get_last_message()
	{
		$last_message = "SELECT * FROM chat_message WHERE (to_user_id = :to_user_id
                                            OR from_user_id = :to_user_id) AND (from_user_id = :from_user_id
                                            OR to_user_id = :from_user_id) ORDER BY chat_message_id DESC LIMIT 1";
		
		$statement = $this->connect->prepare($last_message);

		$statement->bindParam(':from_user_id', $this->from_user_id);

		$statement->bindParam(':to_user_id', $this->to_user_id);

		$statement->execute();

		return $statement->fetch(PDO::FETCH_ASSOC);

	}
	function upload_files($file){
		$allowedExts = array(
			"jpg", "jpeg", "gif", "png", "7z", "rar", "zip", "tar.gz", "csv",
			"xlsx", "xls", "xlsm", "doc", "docx", "txt", "pdf"
		);
		$imgExts = array("jpg", "jpeg", "gif", "png");
		$isImgOrNot = true;
		$extension = pathinfo($file['file']['name'], PATHINFO_EXTENSION);
		$target_dir = "uploads/";
		if (in_array($extension, $imgExts)) {
			$isImgOrNot = 1;
		} else {
			$isImgOrNot = 0;
		}

		if (($file["file"]["size"] < 250000000) && in_array($extension, $allowedExts)) {
			if ($file["file"]["error"] > 0) {
				echo "Return Code: " . $file["file"]["error"] . "<br />";
			} else {
				if (is_uploaded_file($file["file"]["tmp_name"])) {
					$_source_path = $file["file"]["tmp_name"];
					$_filename = $file['file']['name'];
					$target_path = $target_dir . $file["file"]["name"];
					if (move_uploaded_file($_source_path, $target_path)) {
						return array($target_path, $isImgOrNot,$_filename);
					} else {
						return array();					
					}
				}

			}
		}
	}
}
