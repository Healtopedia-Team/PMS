<?php
//create database
$servername = "localhost";
$username = "myhealtopedia";
$password = "Healit20.";
$dbname = "db_pms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
