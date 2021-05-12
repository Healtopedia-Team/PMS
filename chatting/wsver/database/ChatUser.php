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
		include_once "./dbconnect.php";
		$this->connect = $conn;
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
			SELECT * FROM user 
			WHERE email = :user_email
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_email', $this->email);

		if ($statement->execute()) {
			$user_data = $statement->fetch_assoc();
		}
		return $user_data;
	}

	function save_data()
	{
		$query = "
			INSERT INTO user (first_name, last_name, username, email, password, role, user_profile, status) 
			VALUES (:first_name, :last_name, :username, :email, :password, :role, :user_profile, :status)
		";
		$statement = $this->connect->prepare($query);

		$statement->bind_param(':first_name', $this->first_name);

		$statement->bind_param(':last_name', $this->last_name);

		$statement->bind_param(':username', $this->username);

		$statement->bind_param(':email', $this->email);

		$statement->bind_param(':password', $this->password);

		$statement->bind_param(':role', $this->role);

		$statement->bind_param(':user_profile', $this->user_profile);

		$statement->bind_param(':status', $this->status);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function add_user() //might not need this
	{
		if (isset($_POST['hospital'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$pass = $_POST['password'];
			$email = $_POST['email'];
			$hosp = $_POST['hospital'];
			$role = $_POST['role'];
			$img = 'avatar.jpg';

			$query = "INSERT INTO user SET first_name=:firstname,last_name=:lastname,email=:email, 
			username=:username, password=:password, role=:role, hospital=:hosp, user_profile=:user_profile, status='online'";
			$statement = $this->connect->prepare($query);
			$statement->bind_param(':username', $this->username);

			$statement->bind_param(':email', $this->email);

			$statement->bind_param(':password', $this->password);

			$statement->bind_param(':user_profile', $this->user_profile);

			$statement->bind_param(':status', $this->status);

			$statement->bind_param(':user_connection_id', $this->user_connection_id);

			$statement->bind_param(':user_token', $this->user_token);

			$statement->execute();
			if ($statement->execute()) {
				header('location:users.php');
			} else {
				return false;
			}
		} else {
			$hosp = '-';
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$pass = $_POST['password'];
			$email = $_POST['email'];
			$role = $_POST['role'];
			$img = 'avatar.jpg';


			$sql = "INSERT INTO user SET first_name='$firstname',last_name='$lastname',email='$email', 
				username='$username', password='$pass', role='$role', hospital='$hosp', user_profile='$img', status='online'";
			if (mysqli_query($conn, $sql)) {
				header('location:users.php');
			}
		}
	}


	function check_user($conn)
	{
		$username = $_POST['username'];
		$pass = $_POST['password'];

		$sql = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
		if (mysqli_query($conn, $sql)) {

			$result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$pass'");
			$userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$_SESSION["loggedin"] = true;
			$_SESSION["name"] = $userdet["first_name"];
			$_SESSION["hospital"] = $userdet["hospital"];
			$_SESSION["role"] = $userdet["role"];
			$_SESSION["pic"] = $userdet["user_profile"];
			$_SESSION["email"] = $userdet["email"];
			$_SESSION["user_login_status"] = "Online";
			header('location:index.php');
		} else {
		?>

			<div class="alert">
				<span class="closebtn" onclick="location.href = 'auth-login.php';">&times;</span>
				<strong>Invalid!</strong> Incorrect password!
				<?php include 'auth-login.php'; ?>
			</div>
		<?php

		}
	}

	function add_hospital($conn)
	{

		$hospname = $_POST['hospname'];
		$hospcompany = $_POST['hospcomp'];
		$hospphone = $_POST['hospphone'];
		$hospaddress = $_POST['hospadd'];

		$sql = "INSERT INTO hospital SET hosp_name='$hospname',hosp_company='$hospcompany',hosp_phone='$hospphone', hosp_address='$hospaddress'";
		if (mysqli_query($conn, $sql)) {
			header('location:hospitals.php');
		}
	}
	function delete_user($conn)
	{

		$userid = $_REQUEST['id'];
		$sql = "DELETE user FROM user WHERE user_id=$userid";
		if (mysqli_multi_query($conn, $sql)) {
			header('location:users.php');
		}
	}

	function update_user_login_data()
	{
		$query = "
		UPDATE user
		SET user_login_status = :user_login_status, user_token = :user_token  
		WHERE user_id = :user_id
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_login_status', $this->user_login_status);

		$statement->bind_param(':user_token', $this->user_token);

		$statement->bind_param(':user_id', $this->user_id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_data_by_id()
	{
		$query = "
			SELECT * FROM user
			WHERE user_id = :user_id
			";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_id', $this->user_id);

		try {
			if ($statement->execute()) {
				$user_data = $statement->fetch_assoc();
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
		UPDATE user
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

		$statement->bind_param(':first_name', $this->first_name);

		$statement->bind_param(':last_name', $this->last_name);

		$statement->bind_param(':username', $this->username);

		$statement->bind_param(':email', $this->email);

		$statement->bind_param(':password', $this->password);

		$statement->bind_param(':user_profile', $this->user_profile);

		$statement->bind_param(':role', $this->role);

		$statement->bind_param(':user_id', $this->user_id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_all_data()
	{
		$query = "
			SELECT * FROM user
		";

		$statement = $this->connect->prepare($query);

		$statement->execute();

		$data = $statement->fetch_assoc();

		return $data;
	}

	function get_user_all_data_with_status_count()
	{
		$query = "
		SELECT user_id, concat(first_name, ' ',  last_name) as fullname, user_profile, user_login_status, 
		(SELECT COUNT(*) FROM chat_message WHERE to_user_id = :user_id AND from_user_id = user.user_id AND status = 'No') 
		AS count_status FROM user
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_id', $this->user_id);

		$statement->execute();

		$data = $statement->fetch_assoc();

		return $data;
	}

	function update_user_connection_id()
	{
		$query = "
		UPDATE user
		SET user_connection_id = :user_connection_id 
		WHERE user_token = :user_token
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_connection_id', $this->user_connection_id);

		$statement->bind_param(':user_token', $this->user_token);

		$statement->execute();
	}

	function get_user_id_from_token()
	{
		$query = "
		SELECT user_id FROM user
		WHERE user_token = :user_token
		";

		$statement = $this->connect->prepare($query);

		$statement->bind_param(':user_token', $this->user_token);

		$statement->execute();

		$user_id = $statement->fetch_assoc();

		return $user_id;
	}
}



?>