<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/EventHasTags.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate EventHasTags object
$EventHasTags = new EventHasTags($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$EventHasTags->eventId = $data->eventId;
$EventHasTags->tagId = $data->tagId;

// create EventHasTags
if ($EventHasTags->create()) {
    echo json_encode(
        array('message' => 'EventHasTags Created')
    );
} else {
    echo json_encode(
        array('message' => 'EventHasTags Not Created')
    );
}

?>