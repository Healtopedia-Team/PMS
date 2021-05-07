<?php 
    session_start();
    include "../dbconnect.php";
    $outgoing_id = $user_id;
    echo "outgoing id is" . $outgoing_id;
    $incoming_id = mysqli_real_escape_string($conn, $_SESSION["target_chat_user"]);
    echo "incoming id is " . $incoming_id;
    $output = "";
    $sql = "SELECT * FROM chat LEFT JOIN user ON user.user_id = chat.outgoing_msg_id
            WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id')
            OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){//message send
                $output .= '<li class="sent">
                                <img id="profile-img" src="../assets/images/faces/1.jpg" class="online" alt="" />
                                <p>'. $row['msg'] .'</p>
                            </li>';
            }else{//message receiver
                $output .= '<li class="chat incoming">
                                <img id="profile-img" src="../assets/images/faces/1.jpg" class="online" alt="" />
                                <p>'. $row['msg'] .'</p>
                            </li>';
            }
        }
    }else{
        $output .= '<div style="color:black" class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;

?>