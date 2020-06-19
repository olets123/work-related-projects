<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Event.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Event object
$event = new Event($db);

// Get ID
$event->eventId = isset($_GET['id']) ? $_GET['id'] : die();

// Get event
$event->read_single();

// Create array
$event_arr = array(
    'eventId' => $event->eventId,
    'title' => $event->title,
    'date' => $event->date,
    'description' => $event->description,
    'ticketsSold' => $event->ticketsSold,
    'numTickets' => $event->numTickets,
    'price' => $event->price,
    'picture_url' => $event->picture_url,
    'picture_alt' => $event->picture_alt
);

// make json
printf(json_encode($event_arr));
?>
