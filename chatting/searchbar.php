

<?php
    $safe_value = $_POST['searchvalue'];
   
    $result = mysqli_query($conn, "SELECT * FROM user WHERE first_name LIKE '$safe_value%' OR last_name LIKE '$safe_value%'");
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
        $output .=
    '<li class="contact">
                <div class="wrap">
                    <span class="contact-status offline"></span>
                    <img src= "../assets/images/faces/1.jpg" alt="" />
                    <div class="meta">
                        <p class="name">Nobody</p>
                        <p>' . $_POST['searchvalue'] . '</p>
                    </div>
                </div>
            </li>';
    }
echo $output;
?>