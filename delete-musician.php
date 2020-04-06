<?php
require_once 'header.php';
require_once 'auth.php';

// read the selected musicianId from the value at the end of the url
$musicianId = $_GET['musicianId'];

// connect to the db
require_once 'db.php';

//set up sql command to delete selected record
$sql = "DELETE FROM musicians WHERE musicianId = :musicianId";

//bind parameter to pass in the selected id
$cmd = $db->prepare($sql);
$cmd->bindParam( ':musicianId', $musicianId, PDO::PARAM_INT);

//execute sql command
$cmd->execute();

//disconnect
$db = null;

//take user back to updated list
//only add redirect once we know above code is worker otherwise we will not get the error message
header('location:musicians.php');

?>
</body>
</html>
