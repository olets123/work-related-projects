<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
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

// Set ID to delete
$history->timeId = $data->timeId;

// delete history element
if ($history->delete()) {
    echo json_encode(
        array('message' => 'Post deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not deleted')
    );
}

?>