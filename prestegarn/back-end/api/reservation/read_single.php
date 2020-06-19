<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Reservation.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Reservation object
$reservation = new Reservation($db);

// Get ID
$reservation->reservationId = isset($_GET['id']) ? $_GET['id'] : die();

// Get reservation
$reservation->read_single();

// Create array
$reservation_arr = array(
    'reservationId' => $reservation->reservationId,
    'name' => $reservation->name,
    'email' => $reservation->email,
    'eventType' => $reservation->eventType,
    'mobile' => $reservation->mobile,
    'quantity' => $reservation->quantity,
    'fromDate' => $reservation->fromDate,
    'toDate' => $reservation->toDate,
    'accepted' => $reservation->accepted
);

// make json
printf(json_encode($reservation_arr));
?>
