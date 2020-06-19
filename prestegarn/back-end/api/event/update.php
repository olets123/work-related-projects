<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
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

// Set ID to update
$event->eventId = $data->eventId;

$event->title = $data->title;
$event->date = $data->date;
$event->description = $data->description;
$event->picture_url = $data->picture_url;
$event->picture_alt = $data->picture_alt;
$event->numTickets = $data->numTickets;
$event->ticketsSold = $data->ticketsSold;
$event->price = $data->price;

// Update event
if ($event->update()) {
    echo json_encode(
        array('message' => 'Event Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Event Not Updated')
    );
}

?>