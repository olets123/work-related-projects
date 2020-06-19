<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
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

// Set ID to delete
$reservation->reservationId = $data->reservationId;

// delete post
if ($reservation->delete()) {
    echo json_encode(
        array('message' => 'Reservation deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Reservation Not deleted')
    );
}

?>