<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/History.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate history object
$history = new History($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$history->year = $data->year;
$history->title = $data->title;
$history->description = $data->description;

// create history
if ($history->create()) {
    echo json_encode(
        array('message' => 'History Created')
    );
} else {
    echo json_encode(
        array('message' => 'History Not Created')
    );
}

?>