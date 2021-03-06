<?php

//ChatUser.php

class ChatUser
{
	private $user_id;
	private $first_name;
	private $last_name;
	private $username;
	private $email;
	private $password;
	private $role;
	private $hospital;
	private $user_profile;
	//from here is the newly added
	private $status;
	//private $user_created_on;
	//private $user_verification_code;
	private $user_login_status;
	private $user_token;
	private $user_connection_id;
	public $connect;

	public function __construct()
	{
		require_once('Database_connection.php');

		$database_object = new Database_connection;

		$this->connect = $database_object->connect();
	}

	function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	function getFirstName()
	{
		return $this->first_name;
	}

	function setFirstName($first_name)
	{
		$this->first_name = $first_name;
	}

	function getLastName()
	{
		return $this->last_name;
	}

	function setLastName($last_name)
	{
		$this->last_name = $last_name;
	}

	function getUserId()
	{
		return $this->user_id;
	}

	function setUserName($username)
	{
		$this->username = $username;
	}

	function getUserName()
	{
		return $this->username;
	}

	function setUserEmail($email)
	{
		$this->email = $email;
	}

	function getUserEmail()
	{
		return $this->email;
	}

	function setUserPassword($password)
	{
		$this->password = $password;
	}

	function getUserPassword()
	{
		return $this->password;
	}

	function setRole($role)
	{
		$this->role = $role;
	}

	function getRole()
	{
		return $this->role;
	}

	function setHosptial($hospital)
	{
		$this->hospital = $hospital;
	}

	function getHosptial()
	{
		return $this->hospital;
	}

	function setUserProfile($user_profile)
	{
		$this->user_profile = $user_profile;
	}

	function getUserProfile()
	{
		return $this->user_profile;
	}

	function setUserStatus($status)
	{
		$this->status = $status;
	}

	function getUserStatus()
	{
		return $this->status;
	}

	function setUserLoginStatus($user_login_status)
	{
		$this->user_login_status = $user_login_status;
	}

	function getUserLoginStatus()
	{
		return $this->user_login_status;
	}

	function setUserToken($user_token)
	{
		$this->user_token = $user_token;
	}

	function getUserToken()
	{
		return $this->user_token;
	}

	function setUserConnectionId($user_connection_id)
	{
		$this->user_connection_id = $user_connection_id;
	}

	function getUserConnectionId()
	{
		return $this->user_connection_id;
	}

	function make_avatar($character)
	{
		$path = "images/" . time() . ".png";
		$image = imagecreate(200, 200);
		$red = rand(0, 255);
		$green = rand(0, 255);
		$blue = rand(0, 255);
		imagecolorallocate($image, $red, $green, $blue);
		$textcolor = imagecolorallocate($image, 255, 255, 255);

		$font = dirname(__FILE__) . '/font/arial.ttf';

		imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
		imagepng($image, $path);
		imagedestroy($image);
		return $path;
	}

	function get_user_data_by_email()
	{
		$query = "
			SELECT * FROM chat_user_table 
			WHERE email = :user_email
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_email', $this->email);

		if ($statement->execute()) {
			$user_data = $statement->fetch(PDO::FETCH_ASSOC);
		}
		return $user_data;
	}

	function save_data()
	{
		$query = "
			INSERT INTO chat_user_table (first_name, last_name, username, email, password, role, hospital, user_profile, status) 
			VALUES (:first_name, :last_name, :username, :email, :password, :role, :hospital, :user_profile, :status)
		";
		$statement = $this->connect->prepare($query);

		$statement->bindParam(':first_name', $this->first_name);

		$statement->bindParam(':last_name', $this->last_name);

		$statement->bindParam(':username', $this->username);

		$statement->bindParam(':email', $this->email);

		$statement->bindParam(':password', $this->password);

		$statement->bindParam(':role', $this->role);

		$statement->bindParam(':hospital', $this->hospital);

		$statement->bindParam(':user_profile', $this->user_profile);

		$statement->bindParam(':status', $this->status);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function update_user_login_data()
	{
		$query = "
		UPDATE chat_user_table
		SET status = :status, user_login_status = :user_login_status, user_token = :user_token  
		WHERE user_id = :user_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':status', $this->status);

		$statement->bindParam(':user_login_status', $this->user_login_status);

		$statement->bindParam(':user_token', $this->user_token);

		$statement->bindParam(':user_id', $this->user_id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function upload_profile(){
		$query = "
		UPDATE chat_user_table SET first_name=:first_name,last_name=:last_name,email=:email, hospital=:hospital, 
		user_profile=:user_profile WHERE user_id=:user_id";
		$statement = $this->connect->prepare($query);

		$statement->bindParam(':first_name', $this->first_name);

		$statement->bindParam(':last_name', $this->last_name);

		$statement->bindParam(':email', $this->email);

		$statement->bindParam(':hospital', $this->hospital);

		$statement->bindParam(':user_profile', $this->user_profile);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}

	}

	function get_user_data_by_id()
	{
		$query = "
			SELECT * FROM chat_user_table
			WHERE user_id = :user_id
			";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_id', $this->user_id);

		try {
			if ($statement->execute()) {
				$user_data = $statement->fetch(PDO::FETCH_ASSOC);
				//print_r($user_data);
			} else {
				$user_data = array();
			}
		} catch (Exception $error) {
			echo $error;
		}
		return $user_data;
	}

	function upload_image($user_profile)
	{
		$extension = explode('.', $user_profile['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = 'images/' . $new_name;
		move_uploaded_file($user_profile['tmp_name'], $destination);
		return $destination;
	}

	function update_data()
	{
		$query = "
		UPDATE chat_user_table
		SET 
		first_name = :first_name, 
		last_name = :last_name,
		username = :username, 
		email = :email, 
		password = :password, 
		role = :role,
		user_profile = :user_profile  
		WHERE user_id = :user_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':first_name', $this->first_name);

		$statement->bindParam(':last_name', $this->last_name);

		$statement->bindParam(':username', $this->username);

		$statement->bindParam(':email', $this->email);

		$statement->bindParam(':password', $this->password);

		$statement->bindParam(':user_profile', $this->user_profile);

		$statement->bindParam(':role', $this->role);

		$statement->bindParam(':user_id', $this->user_id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_all_data()
	{
		$query = "
			SELECT * FROM chat_user_table
		";

		$statement = $this->connect->prepare($query);

		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	function get_user_all_data_with_status_count()
	{
		$query = "
		SELECT user_id, concat(first_name, ' ',  last_name) as fullname, user_profile, user_login_status, status,
		(SELECT COUNT(*) FROM chat_message WHERE to_user_id = :user_id AND from_user_id = chat_user_table.user_id AND chat_status = 'No') 
		AS count_status FROM chat_user_table
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_id', $this->user_id);

		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	function update_user_connection_id()
	{
		$query = "
		UPDATE chat_user_table
		SET user_connection_id = :user_connection_id 
		WHERE user_token = :user_token
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_connection_id', $this->user_connection_id);

		$statement->bindParam(':user_token', $this->user_token);

		$statement->execute();
	}

	function get_user_id_from_token()
	{
		$query = "
		SELECT user_id FROM chat_user_table
		WHERE user_token = :user_token
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_token', $this->user_token);

		$statement->execute();

		$user_id = $statement->fetch(PDO::FETCH_ASSOC);

		return $user_id;
	}

	function search_user($searchTerm){
		$query = "SELECT * FROM chat_user WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
		$statement = $this->connect->prepare($query);
		$statement->execute();
		$user_data = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $user_data;
	}
	function get_selected_user_all_data_with_status_count()
	{
		$query = "
		SELECT user_id, concat(first_name, ' ',  last_name) as fullname, user_profile, user_login_status, status,
		(SELECT COUNT(*) FROM chat_message WHERE to_user_id = :user_id AND from_user_id = chat_user_table.user_id AND chat_status = 'No') 
		AS count_status FROM chat_user_table
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_id', $this->user_id);

		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}
	function delete_user(){
		$query = "
		DELETE FROM chat_user_table WHERE user_id=:user_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_id', $this->user_id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}
	function get_userid_of_hospital_admin(){
		$query = "
			SELECT user_id FROM chat_user_table WHERE role=:role, hospital=:hospital;
		";
		$statement = $this->connect->prepare($query);

		$statement->bindParam(':role', $this->role);

		$statement->bindParam(':hospital', $this->hospital);

		$data = $statement->fetch(PDO::FETCH_ASSOC);

		return $data;

	}
}



?>