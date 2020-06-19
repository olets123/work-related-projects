<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/Gallery.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog gallery object
$gallery = new Gallery($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$gallery->galleryId = $data->galleryId;
$gallery->timeId = $data->timeId;
$gallery->picture_url = $data->picture_url;
$gallery->picture_alt = $data->picture_alt;
$gallery->copyright = $data->copyright;

// Update gallery
if ($gallery->update()) {
    echo json_encode(
        array('message' => 'Gallery Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Gallery Not Updated')
    );
}

?>