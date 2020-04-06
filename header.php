<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<!-- navbar from https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp -->
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php">COMP1006 Music Library</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="musicians.php">View All</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto"
        <?php
        if (empty($_SESSION['userId'])) {
            echo '<li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>';
        }
        else {
            echo '<li class="nav-item">
                    <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>';
        }

        ?>
        </ul>
    </div>
</nav>

