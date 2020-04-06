<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="save-upload.php" enctype="multipart/form-data">
<!--   encoding: this converts file from original to binary and transfer a copy to web server -->

    <fieldset>
        <label for="file1">Upload any file:</label>
        <input name="file1" type="file" />
    </fieldset>

    <fieldset>
        <label for="email">Email: *</label>
        <input name="email" id="email" type="email" required />
    </fieldset>

    <button>Upload Now</button>

</form>
</body>
</html>