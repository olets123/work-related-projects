<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/History.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog history object
$history = new History($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$history->timeId = $data->timeId;

$history->year = $data->year;
$history->title = $data->title;
$history->description = $data->description;

// Update history
if ($history->update()) {
    echo json_encode(
        array('message' => 'History Updated')
    );
} else {
    echo json_encode(
        array('message' => 'History Not Updated')
    );
}

?>