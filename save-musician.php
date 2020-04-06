<?php
// set the variable title
$title = 'Save Musician';
//embed header
require_once('header.php');
// auth check
require_once 'auth.php';

//save inputs
$musicianId = $_POST['musicianId']; //need this id
//form variables
$name = $_POST['name'];
$recordLabel = $_POST['recordLabel'];
$ranking = $_POST['ranking'];

//solo default is false, if user checks it, it is true
$solo = false;

if (!empty($_POST['solo'])) {
    $solo = true;
}

$photo = $_FILES['photo'];
$city = $_POST['city'];

//check if user inputs are valid
$valid = true; //determines if we should save record or not

if (empty($name)){
    echo 'Name is required<br />';
    $valid = false;
}

// strlen is a PHP function that shows the length of a string value
elseif (strlen($name) > 100) {
    echo 'Name must be 100 characters or less<br />';
    $valid = false;
}

// ! means NOT / false.  is_numeric is a PHP function that checks if a value is an integer or not
if (!empty($ranking)) {
    if (!is_numeric($ranking)) {
        echo 'Ranking must be a number 0 or higher<br />';
        $valid = false;
    }

    if ($ranking < 0) {
        echo 'Ranking must be a number 0 or higher<br />';
        $valid = false;
    }
}

//photo upload check
if (!empty($photo['name'])) {
    $tmp_name = $photo['tmp_name'];
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Please upload a .jpg or .png file<br />';
        $valid = false;
    }
    else {
        // use the session to uniquely name the uploaded file & save to the img/musicians
        session_start();
        $photo = session_id() . '-' . $photo['name'];
        move_uploaded_file($tmp_name, "img/musicians/$photo");
    }
}

// is the form valid?
if ($valid == true) {
//show user enter fields
    echo "Name: $name<br />Record Label: $recordLabel<br />Ranking: $ranking<br />Solo or Group: $solo<br />Photo: $photo<br />City: $city";

//connect to the db
    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');


    if (empty($musicianId)) {
        //SQL insert with parameters for the user inputs
        $sql = "INSERT INTO musicians (name, recordLabel, ranking, solo, photo, city) VALUES (:name, :recordLabel, :ranking, :solo, :photo, :city)";
    }
    else{
        $sql = "UPDATE musicians SET name = :name, recordLabel = :recordLabel, ranking = :ranking, solo = :solo, 
        photo = :photo, city = :city WHERE musicianId = :musicianId";
        //the where part of this is very important so only the one specific record is updated not ALL of them
    }


//create a command variable to populate the parameter values
    $cmd = $db->prepare($sql);

    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
    $cmd->bindParam(':recordLabel', $recordLabel, PDO::PARAM_STR, 50);
    $cmd->bindParam(':ranking', $ranking, PDO::PARAM_INT);
    $cmd->bindParam(':solo', $solo, PDO::PARAM_BOOL);
    $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);
    $cmd->bindParam(':city', $city, PDO::PARAM_STR, 50);

    if (!empty($musicianId)) {
        $cmd->bindParam(':musicianId', $musicianId, PDO::PARAM_INT);
    }

    $cmd->execute(); //saves the above six values to the db

//disconnect
    $db = null;

    echo '<p>Musician Saved!</p>';
}
?>
<a href="musicians.php">Go to musician table</a>

<?php
//embed footer
require_once('footer.php');
?>