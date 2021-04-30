<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
$upload_ok = 1;
$image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
// checking if image file is accessible
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file_to_upload"]["tmp_name"]);
    if($check !== false) {
        echo "The file you picked is an image - " . $check["mime"] . ".";
        $upload_ok = 1;
    } else {
        echo "The file you picked is not image.";
        $upload_ok = 0;
    }
}
?>

