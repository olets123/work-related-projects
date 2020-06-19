<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Friend.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate friend object
$friend = new Friend($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to delete
$friend->friendId = $data->friendId;

// delete post
if ($friend->delete()) {
    echo json_encode(
        array('message' => 'friend deleted')
    );
} else {
    echo json_encode(
        array('message' => 'friend Not deleted')
    );
}

?>