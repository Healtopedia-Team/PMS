<?php
    session_start();
    include "dbconnect.php";
    $_SESSION["target_chat_user"] = $_POST['target_userid'];
    $outgoing_id = $_SESSION["user_id"];
    //console_log($_POST['target_userid']);
    $output = '';
    $target_id = mysqli_real_escape_string($conn, $_SESSION["target_chat_user"]);
    $targetuser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$target_id'");
    if (mysqli_num_rows($targetuser) > 0) {
        $row = mysqli_fetch_assoc($targetuser);
        $output .= '
                <div class="contact-profile">
                    <img src="../assets/images/faces/1.jpg" alt="" />
                    <p class="person_received">' .$row['first_name'] . " " . $row['last_name'] . '</p>
                    <div class="social-media">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="messages">
                </div>
                <form action="js/insert.php" class="message-input">
                    <div class="wrap">
                        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $outgoing_id; ?>" hidden>

                        <input type="text" name="message" class="input-field" placeholder="Write your message..." />
                        <button class="submitbutton"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <button class="attachmentbtn"><i class="fa fa-paperclip attachment" aria-hidden="true"></i></button>
                    </div>
                </form>
        ';
    } else {
        $output .= "ERROR: " . $_POST['target_userid'];
    }
    echo $output;

?>
