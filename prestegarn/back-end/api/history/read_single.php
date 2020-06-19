<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/History.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog history object
$history = new History($db);

// Get ID
$history->timeId = isset($_GET['id']) ? $_GET['id'] : die();


// Get history
$history->read_single();

// Create array
$history_arr = array(
    'timeId' => $history->timeId,
    'year' => $history->year,
    'title' => $history->title,
    'description' => $history->description
);

// make json
printf(json_encode($history_arr));
?>
