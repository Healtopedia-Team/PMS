    $firstnameuser = $_POST['firstnameuser'];
    $lastnameuser = $_POST['lastnameuser'];
    $emailuser = $_POST['emailuser'];
    $hospitaluser = $_POST['hospitaluser'];
    $image=time() . '-' . $_FILES['userimage']['name'];

    //upload the image to a specific folder first and this folder for example called (images)

    $target_dir="images/";
    $target_file=$target_dir . basename($image);

    //now move the image to the folder (images)

    // move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    //now let we upload the image to the database

    if(move_uploaded_file($_FILES['userimage']['tmp_name'], $target_file)){

        $sql = "UPDATE user SET first_name = '$firstnameuser', last_name = '$lastnameuser', email = '$emailuser', hospital = '$hospitaluser', user_profile = '$image'";
        if (mysqli_query($conn,$sql)) {
            echo '<script>alert("Successfully update profile");</script>';
        }
        header("Location: auth-login.php");
    }