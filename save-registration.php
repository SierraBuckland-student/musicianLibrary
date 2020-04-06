<?php
// 1. Get the form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$valid = true;

// 2. Validate the inputs: required + matching passwords
if (empty($username)) {
    echo 'Username is required<br />';
    $valid = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $valid = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match';
    $valid = false;
}

if ($valid) {
    // 3. connect
    require_once 'db.php';

    //3.5  check if username already exists
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

        //if we found a record with this username, stop execution and dont insert again
    if (!empty($user)) {
        echo 'Username already exists';
        exit(); //this stops execution of any more php on this page
    }

    // 4. set up SQL INSERT to users table
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);

    // 5. ** NEW ** hash the password before saving
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 6. Bind parameters and execute the insert
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
    $cmd->execute();

    // 7. Disconnect & redirect to login
    $db = null;

    header('location:login.php');

}

?>
