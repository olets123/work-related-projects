<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/Tag.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate tag object
$tag = new Tag($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$tag->tagId = $data->tagId;

$tag->content = $data->content;

// Update tag
if ($tag->update()) {
    echo json_encode(
        array('message' => 'Tag Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Tag Not Updated')
    );
}

?>