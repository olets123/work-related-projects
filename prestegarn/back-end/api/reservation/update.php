<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/Reservation.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate reservation object
$reservation = new Reservation($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$reservation->reservationId = $data->reservationId;
$reservation->accepted = $data->accepted;

// Update reservation
if ($reservation->update()) {
    echo json_encode(
        array('message' => 'Reservation Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Reservation Not Updated')
    );
}

?>