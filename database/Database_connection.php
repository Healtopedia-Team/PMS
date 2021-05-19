<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
		$connect = new PDO("mysql:host=127.0.0.1; dbname=test;charset=utf8", "root", "");

		return $connect;
	}
}

?>