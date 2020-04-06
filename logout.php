<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
// end the authenticated session and redirect to the login page
session_start();
session_unset(); // remove any session variables
session_destroy(); // delete the session from memory

header('location:login.php');
?>
</body>
</html>
