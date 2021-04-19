<!DOCTYPE html>
<html>
<head>
    <title>TRY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <form method="POST" action="function.php">
      <input type="hidden" name="command" value="TRY">
        <div class="container">
            <label>Name :</label>
            <input type="text" name="tryname" class="form-control">

            <label>ID/Passport :</label>
            <input type="text" name="trypassport" class="form-control">

            <label>Phone No :</label>
            <input type="text" name="tryphone" class="form-control">

            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
        </div>
    </form>
</body>
</html>
