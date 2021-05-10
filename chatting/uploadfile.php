<?php
session_start();
include "dbconnect.php";
$outgoing_id = $_SESSION['user_id'];
$incoming_id = mysqli_real_escape_string($conn, $_SESSION["target_chat_user"]);
//File upload part below
if(!empty($_FILES)){
    $allowedExts = array(
        "jpg", "jpeg", "gif", "png", "7z", "rar", "zip", "tar.gz", "csv",
        "xlsx", "xls", "xlsm", "doc", "docx", "txt", "pdf"
    );
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $target_dir = "uploads/";

    if (($_FILES["file"]["size"] < 250000000) && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            if(is_uploaded_file($_FILES["file"]["tmp_name"])){
                $_source_path = $_FILES["file"]["tmp_name"];
                $target_path = $target_dir . $_FILES["file"]["name"];
                if(move_uploaded_file($_source_path, $target_path)){
                    $sql = mysqli_query($conn, "INSERT INTO chat (incoming_msg_id, outgoing_msg_id, uploadfile)
                    VALUES ('$incoming_id', '$outgoing_id', '$target_path')") or die("Cannot upload files!");
                }
            }

            /*
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            */
            //The repeated file might be allowed?
            /*
            if (file_exists($target_dir . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $_FILES["file"]["name"]);
                echo "Stored in: " . $target_dir . $_FILES["file"]["name"];
                $sql = mysqli_query($conn, "INSERT INTO chat (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ('$incoming_id', '$outgoing_id', '$message')") or die("Cannot send");
            }
            */
        }
    } else {
        echo "Invalid file";
    }
}

