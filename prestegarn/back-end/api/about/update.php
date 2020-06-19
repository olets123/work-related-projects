<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/About.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate about object
$about = new About($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$about->aboutId = $data->aboutId;

$about->hansContent = $data->hansContent;
$about->anitaContent = $data->anitaContent;
$about->mainContent = $data->mainContent;
$about->anitaPicture_url = $data->anitaPicture_url;
$about->anitaPicture_alt = $data->anitaPicture_alt;
$about->hansPicture_url = $data->hansPicture_url;
$about->hansPicture_alt = $data->hansPicture_alt;
$about->mainPicture_url = $data->mainPicture_url;
$about->mainPicture_alt = $data->mainPicture_alt;

// Update about
if ($about->update()) {
    echo json_encode(
        array('message' => 'About Updated')
    );
} else {
    echo json_encode(
        array('message' => 'About Not Updated')
    );
}

?>