<?php
    session_start();
    include_once "../dbconnect.php";

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    $query = mysqli_query($conn, "SELECT * FROM user WHERE first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%' ");
    if(mysqli_num_rows($query) > 0){ 
        $output .= "user is found";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>