<?php
    session_start();
    include "../dbconnect.php";
    $_SESSION["target_chat_user"] = $_POST['target_userid'];
?>
