<?php
    session_start();
    include_once "../dbconnect.php";
    $outgoing_id = $_SESSION["user_id"];
    $sqlu = "SELECT * FROM user WHERE NOT user_id = {$outgoing_id} ORDER BY user_id DESC";
    $userlist = mysqli_query($conn, $sqlu);
    $output = "";
    console_log(mysqli_fetch_assoc($userlist));
    if(mysqli_num_rows($userlist) == 0){
        $output .= '<li class="contact">
                        <div class="wrap">
                            <div class="meta">
                                <p class="name">Nobody</p>
                                <p class="preview"> No users are available to chat</p>
                            </div>
                        </div>
                    </li>';
    } elseif(mysqli_num_rows($userlist) > 0){
        include_once "data.php";
    }
    echo $output;
?>