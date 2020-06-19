<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Event.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate event object
$event = new Event($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to delete
$event->eventId = $data->eventId;

// delete post
if ($event->delete()) {
    echo json_encode(
        array('message' => 'Event deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Event Not deleted')
    );
}

?>