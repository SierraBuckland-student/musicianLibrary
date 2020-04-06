<?php
// set the page title so the header can display it
$title = 'Musicians';

// use the require_once function to embed the shared header here
require_once('header.php');
?>

<h1>Musician List</h1>

<?php

if (!empty($_SESSION['userId'])) {
    echo '<a href="musician-details.php">Add a New Musician</a>';
}

// connect
require_once 'db.php';

// set up & execute query
$sql = "SELECT * FROM musicians";
$cmd = $db->prepare($sql);
$cmd->execute();
$musicians = $cmd->fetchAll();

// start table
echo '<table class="table table-striped table-hover">
<thead>
<th>Name</th>
<th>Label</th>
<th>Ranking</th>
<th>Solo</th>
<th>City</th>
<th></th>
</thead>';

// loop through data and display the results
foreach ($musicians as $value) {
    echo '<tr><td>';
    if (!empty($_SESSION['userId'])) {
        echo '<a href="musician-details.php?musicianId=' . $value['musicianId'] . '">' . $value['name'] . '</a>';
    }
    else {
        echo $value['name'];
    }

    echo '</td>
        <td>' . $value['recordLabel'] . '</td>
        <td>' . $value['ranking'] . '</td>
        <td>' . $value['solo'] . '</td>
        <td>' . $value['city'] . '</td>
        <td>';

    if (!empty($value['photo'])) {
        echo '<img src="img/musicians/' . $value['photo'] . '" alt="Musician Photo" class="thumbnail" />';
    }
    echo '</td>';

    // show delete links only to authenticated users
    if (!empty($_SESSION['userId'])) {
        echo '<td><a class="text-danger" href="delete-musician.php?musicianId=\' . $value[\'musicianId\'] . \'"
                onclick="return confirmDelete();">Delete</a></td>
            </tr>';
    }
}

echo '</table>';

require_once('footer.php');
?>

