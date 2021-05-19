<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
		$connect = new PDO("mysql:host=localhost; dbname=db_pms;", "myhealtopedia", "Healit20.");

		return $connect;
	}
}

?>