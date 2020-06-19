<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/EventHasTags.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate EventHasTags object
$eventHasTags = new EventHasTags($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to delete

$eventHasTags->eventId = $_GET['eId'];
$eventHasTags->tagId = $_GET['tId'];

// delete post
if ($eventHasTags->delete()) {
    echo json_encode(
        array('message' => 'EventHasTags deleted')
    );
} else {
    echo json_encode(
        array('message' => 'EventHasTags Not deleted')
    );
}

?>