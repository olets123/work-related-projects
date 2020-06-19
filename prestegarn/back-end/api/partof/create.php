<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/PartOf.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate partOf object
$partOf = new PartOf($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$partOf->eventId = $data->eventId;
$partOf->friendId = $data->friendId;

// create partOf
if ($partOf->create()) {
    echo json_encode(
        array('message' => 'PartOf Created')
    );
} else {
    echo json_encode(
        array('message' => 'PartOf Not Created')
    );
}

?>