<?php
    session_start();
    include_once "dbconnect.php";
    if (isset($_SESSION['user_id'])) {
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        echo $message;
        if (!empty($message)) {
            $sql = mysqli_query($conn, "INSERT INTO chat (incoming_msg_id, outgoing_msg_id, msg)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    } 
?>