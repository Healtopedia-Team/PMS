<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
		try {
			$connect = new PDO("mysql:host=localhost; dbname=db_pms;", "myhealtopedia", "Healit20.");
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $connect;
	}
}

?>