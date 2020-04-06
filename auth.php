<?php
// authentication check => return to login if user is anonymous
// we will call session_start() in the header FIRST so we don't need it on this page
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}

?>