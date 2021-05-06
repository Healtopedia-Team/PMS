<?php
include_once 'dbconnect.php';

if(isset($_POST['requpreport'])) {
    $requestid = $_POST['requestid'];
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $folder="uploadreports/";
  
    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case
 
    $final_file=str_replace(' ','-',$new_file_name);
 
    if(move_uploaded_file($file_loc,$folder.$final_file)) {
        $sql="INSERT INTO requestappointment(patient_report) VALUES('$final_file')";
        $sql = "UPDATE requestappoint SET patient_report = '$final_file' WHERE request_id = '$requestid'";
        mysqli_query($conn,$sql);
    ?>
    <script>
        alert('successfully uploaded');
        window.location.href='patient-report.php';
    </script>
    <?php }else {?>
    <script>
        alert('error while uploading file');
        window.location.href='patient-report.php';
    </script>
    <?php }
}
?>
