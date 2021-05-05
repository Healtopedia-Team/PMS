

<?php
$sql = mysqli_query($conn, "SELECT * FROM user WHERE user_id = {$_SESSION['user_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}
?>
<ul class="users-list">

</ul>

<script src="js/users.js"></script> 

