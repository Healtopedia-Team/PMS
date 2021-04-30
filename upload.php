<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
$uploadOk = 1;
$image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file_to_upload"]["tmp_name"]);
    if($check !== false) {
        echo "The file you picked is an image - " . $check["mime"] . ".";
        $upload_ok = 1;
    } else {
        echo "The file you picked is not an image.";
        $upload_ok = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "File already present.";
    $upload_ok = 0;
}
// Check file size
if ($_FILES["file_to_upload"]["size"] > 500000) {
    echo "File too big.";
    $upload_ok = 0;
}
// Limit allowed file formats
if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $upload_ok = 0;
}
// Check if $upload_ok is set to 0 by an error
if ($upload_ok == 0) {
    echo "Your file was not uploaded.";
// If all the checks are passed, file is uploaded
} else {
    if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file_to_upload"]["name"]). " was uploaded.";
    } else {
        echo "A error has occured uploading.";
    }
}
?>


