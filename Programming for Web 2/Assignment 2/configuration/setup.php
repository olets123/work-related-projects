<?php 

// if no database exists create one database.
try {
    $mysqli = new mysqli("localhost", "root", "");
} catch (\Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}
if ($mysqli->select_db('dictionary') === false) {
    // Create database 'dictionary'.
    $dbQuery = 'CREATE DATABASE dictionary';
    $mysqli->query($dbQuery);
    $mysqli->select_db('dictionary');
    $mysqli->query('SET NAMES utf8');
    createTables($mysqli);
}

// Function to create tables and run functions created in setupFunctions.
function createTables($mysqli) {
    include('setupFunctions.php');
    // run functions
    createUsers($mysqli);
    createTopics($mysqli);
    createEntries($mysqli);  
}

$mysqli->close();



?>