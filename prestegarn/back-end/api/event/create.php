<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$event->title = $data->title;
$event->date = $data->date;
$event->description = $data->description;
if (isset($data->ticketsSold)) { $event->ticketsSold = $data->ticketsSold; } else {$event->ticketsSold = 0; } 
$event->numTickets = $data->numTickets;
$event->price = $data->price;
$event->picture_url = $data->picture_url;
$event->picture_alt = $data->picture_alt;


// create event
if ($event->create()) {
    echo json_encode(
        array('message' => 'Event Created')
    );
} else {
    echo json_encode(
        array('message' => 'Event Not Created')
    );
}

?>