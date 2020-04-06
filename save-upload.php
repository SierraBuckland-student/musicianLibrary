<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
//use _files collection to access any files uploaded
$file = $_FILES['file1'];

// file name
$name = $file['name'];
echo "Name: $name<br />";

// email
//use post collection as we normally do - to access all other inputs
$email = $_POST['email'];
echo "Email: $email<br />";

// size in bytes (1 kb = 1024 kb)
$size = $file['size'];
echo "Size: $size<br />";

// temporary file location
$tmp_name = $file['tmp_name'];
echo "Temp Name: $tmp_name<br />";

// check actual file type/content - not just file extension
$type = mime_content_type($tmp_name);
echo "Type: $type<br />";

// save the file to the uploads folder
if ($size <= 1024000 && $type == 'image/jpeg') {
    // use the session to create a (mostly) unique name
    session_start();
    //start the file name with session id then dash then file name to avoid writing over file
    $name = session_id() . '-' . $name;

    move_uploaded_file($tmp_name, "uploads/$name");
}
else if ($size > 1024000){
    echo "Invalid file size (too large)";
}

else {
    echo "Invalid file type";
}
?>

</body>
</html>
