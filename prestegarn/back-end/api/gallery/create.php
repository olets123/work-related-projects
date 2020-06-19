<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/Gallery.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate gallery object
$gallery = new Gallery($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$gallery->timeId = $data->timeId;
$gallery->picture_url = $data->picture_url;
$gallery->picture_alt = $data->picture_alt;
$gallery->copyright = $data->copyright;

// create gallery
if ($gallery->create()) {
    echo json_encode(
        array('message' => 'Gallery Created')
    );
} else {
    echo json_encode(
        array('message' => 'Gallery Not Created')
    );
}

?>