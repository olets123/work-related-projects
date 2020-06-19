<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$reservation->name = $data->name;
$reservation->email = $data->email;
$reservation->eventType = $data->eventType;
$reservation->mobile = $data->mobile;
$reservation->quantity = $data->quantity;
$reservation->fromDate = $data->fromDate;
$reservation->toDate = $data->toDate;
$reservation->accepted = false;

// create reservation
if ($reservation->create()) {
    echo json_encode(
        array('message' => 'Reservation Created')
    );
} else {
    echo json_encode(
        array('message' => 'Reservation Not Created')
    );
}

?>