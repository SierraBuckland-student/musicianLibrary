<?php
$username = $_POST['username'];
$password = $_POST['password'];


require_once 'db.php';


$sql = "SELECT userId, password FROM users WHERE username = :username";

$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();

$user = $cmd->fetch();

if (!password_verify($password, $user['password'])) {
    echo 'Invalid Login';
    exit();
}
else {
    //handle valid login
    session_start();

    $_SESSION['userId'] = $user['userId']; // store the user's id from our query in a new session variable
    $_SESSION['username'] = $username;

    header('location: musicians.php');
}

$db = null;

?>


