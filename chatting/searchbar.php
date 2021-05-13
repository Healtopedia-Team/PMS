

<?php
    function function_alert($message)
    {

        // Display the alert box 
        echo "<script>alert($message);</script>";
    }
    $safe_value = mysqli_real_escape_string($conn, $_POST['searchvalue']);
    $result = mysqli_query($conn, "SELECT * FROM user WHERE first_name LIKE '$safe_value' OR last_name LIKE '$safe_value'");
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<li class="contact">
                            <div class="wrap">
                                <span class="contact-status offline"></span>
                                <img src= "../assets/images/faces/1.jpg" alt="" />
                                <div class="meta">
                                    <p class="name">' . $row['first_name'] . " " . $row['last_name'] . '</p>
                                </div>
                            </div>
                        </li>';
        }
    } else {
        //function_alert(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        $output .=
    '<li class="contact">
                <div class="wrap">
                    <span class="contact-status offline"></span>
                    <img src= "../assets/images/faces/1.jpg" alt="" />
                    <div class="meta">
                        <p class="name">Nobody</p>
                        <p>' . $_POST['searchvalue'] . '</p>
                        <p>' . $row . '</p>
                    </div>
                </div>
            </li>';
    } 

    if ($_POST['searchvalue'] === '') {
    $outgoing_id = $user_id;
    $sql = "SELECT * FROM chat_user_table WHERE NOT user_id = '$outgoing_id' ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    ?>
    <?php
    if (mysqli_num_rows($query) == 0) {
        $output .= '<li class="contact">
                            <div class="wrap">
                                <span class="contact-status offline"></span>
                                <img src= "../assets/images/faces/1.jpg" alt="" />
                                <div class="meta">
                                    <p class="name">Nobody</p>
                                    <p class="preview"> No users are available to chat</p>
                                </div>
                            </div>
                        </li>';
    } elseif (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $sql2 = "SELECT * FROM chat WHERE (incoming_msg_id = {$row['user_id']}
                        OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            if (mysqli_num_rows($query2) > 0) {
                $result = $row2['msg'];
            } else {
                $result = "No message available";
            }
            if (strlen($result) > 28) {
                $msg =  substr($result, 0, 28) . '...';
            } else {
                $msg = $result;
            }
            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }
            //($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

            $output .= '
                            <li class="contact">
                                <div class="wrap">
                                    <span class="contact-status online"></span>
                                    <img src= "../assets/images/faces/1.jpg" alt="" />
                                    <div class="meta">
                                        <p class="name">' . $row['first_name'] . " " . $row['last_name'] . '</p>
                                        <p class="preview"> ' . $you . $msg . '</p>
                                    </div>
                                </div>
                            </li>
                        ';
            }
        }
        echo $output;
    }

    echo $output;
?>