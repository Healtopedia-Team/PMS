<?php


$conn=mysqli_connect("localhost","root","", "add_user");

if(isset($_POST['save_profile'])){
    $username=stripslashes($_POST['name']);
    $price=stripslashes($_POST['price']);
    //this is the name of the image that will be saved in the database
    $image=time() . '-' . $_FILES['image']['name'];

    //upload the image to a specific folder first and this folder for example called (images)

    $target_dir="images/";
    $target_file=$target_dir . basename($image);

    //now move the image to the folder (images)

    // move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    //now let we upload the image to the database

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
        $sql="INSERT INTO user SET image='$image', username='$username', price='$price'";
//if the data has been saved in the database , redirect the user to the main page
        if(mysqli_query($conn, $sql)){
            header('location:index.php');
        }
    }
}



//let we select all the profiles from the database 

$results=mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
$user=mysqli_fetch_all($results, MYSQLI_ASSOC);


?>
