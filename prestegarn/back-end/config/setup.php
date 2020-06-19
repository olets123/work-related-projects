<?php 

// if no database exists create one
try {
    $mysqli = new mysqli("localhost", "root", "");
} catch (\Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}
if ($mysqli->select_db('prestgarn') === false) {
    // Create db
    $dbQuery = 'CREATE DATABASE prestgarn';
    $mysqli->query($dbQuery);
    $mysqli->select_db('prestgarn');
    $mysqli->query('SET NAMES utf8');
    createTables($mysqli);
}

function createTables($mysqli) {
    // runs function inside setupfiles
    include('setupFiles/setupEvents.php');
    createEvents($mysqli);
    include('setupFiles/setupHistory.php');
    createHistory($mysqli);
    include('setupFiles/setupFriends.php');
    createFriends($mysqli);
    include('setupFiles/setupUsers.php');
    createUsers($mysqli);
    include('setupFiles/setupTags.php');
    createTags($mysqli);
    include('setupFiles/setupSPOE.php');
    createSPOE($mysqli);
    include('setupFiles/setupEHT.php');
    createEHT($mysqli);
    include('setupFiles/setupNews.php');
    createNews($mysqli);
    include('setupFiles/setupAbout.php');
    createAbout($mysqli);
    include('setupFiles/setupGallery.php');
    createGallery($mysqli);
    include('setupFiles/setupProgram.php');
    createProgram($mysqli);
    include('setupFiles/setupReservations.php');
    createReservations($mysqli);
    
}

$mysqli->close();



?>