<img src="images/avatar.jpg"  id="profileDisplay" onClick="triggerClick()">
<form action="upload.php" method="post"enctype="multipart/form-data">
    Select the image you want to upload:
    <input type="file" name="file_to_upload"id="file_to_upload" onChange="displayImage(this)">
    <input type="submit" value="image upload"name="submit">
</form>
</body>
</html>
 <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
     
     function triggerClick(e) {
            document.querySelector('#file_to_upload').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
