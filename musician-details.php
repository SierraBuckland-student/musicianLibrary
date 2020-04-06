<?php
// set page title for header
$title = 'Musician Details';

// embed header
require_once('header.php');

// auth check => this page is only for authenticated users
require_once 'auth.php';

//initialize variables
$musicianId = null;
$name = null;
$recordLabel = null;
$ranking = null;
$solo = null;
$photo = null;
$city = null;
$checked = null;

//check if there is a musicianId in the url string
if (!empty($_GET['musicianId'])) {
    //if there is a musicianid, query the db for the details on this record so we can populate the form
    $musicianId = $_GET['musicianId'];

    $db = new PDO('mysql:host=172.31.22.43;dbname=Sierra200366619', 'Sierra200366619', 'Yb4mYQm6V2');
    $sql = "SELECT * FROM musicians WHERE musicianId = $musicianId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':musicianId', $musicianId, PDO::PARAM_INT);
    $cmd->execute();
    $musician = $cmd->fetch(); //use fetch for a single record, faster tha fetchAll

    //populate the variables from the query result
    $name = $musician['name'];
    $recordLabel = $musician['recordLabel'];
    $ranking = $musician['ranking'];
    $solo = $musician['solo'];
    $photo = $musician['photo'];
    $city = $musician['city'];

    if ($musician['solo'] == true) {
        $checked = "checked";
    }
}

//ensure it doesnt save as new record

?>

<!--Page one of site-->
<form method="post" action="save-musician.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name" class="col-md-2">Name:*</label>
        <input name="name" id="name" required maxlength="100" value="<?php echo $name; ?>"/>
    </fieldset>
    <fieldset>
        <label for="recordLabel" class="col-md-2">Record Label:</label>
        <input name="recordLabel" id="recordLabel" maxlength="50" value="<?php echo $recordLabel; ?>"/>
    </fieldset>
    <fieldset>
        <label for="ranking" class="col-md-2">Ranking:</label>
        <input name="ranking" id="ranking" type="number" min="1" value="<?php echo $ranking; ?>"/>
    </fieldset>
    <fieldset>
        <label for="solo" class="col-md-2">Solo:</label>
        <input name="solo" id="solo" type="checkbox" <?php echo $checked; ?>/>
    </fieldset>
    <fieldset>
        <label for="photo" class="col-md-2">Photo:</label>
        <input name="photo" id="photo" type="file" />
    </fieldset>
    <fieldset>
        <label for="city" class="col-md-2">City:</label>
        <input name="city" id="city" value="<?php echo $city; ?>"/>
    </fieldset>
    <?php
    if (!empty($photo)) {
        echo '<div class="offset-2">
                <img src="img/musicians/' . $photo . '" alt="Musician Photo" />
            </div>';
    }

    ?>
    <input type="hidden" name="musicianId" id="musicianId" value="<?php echo $musicianId; ?>" />
    <button class="offset-md-2 btn btn-primary">Save</button>
</form>

<?php
require_once('footer.php');
?>
