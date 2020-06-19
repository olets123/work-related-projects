<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
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


$friend->name = $data->name;
$friend->description = $data->description;
$friend->facebookLink = $data->facebookLink;
$friend->instagramLink = $data->instagramLink;
$friend->email = $data->email;
$friend->picture_url = $data->picture_url;
$friend->picture_alt = $data->picture_alt;
$friend->contact_phone = $data->contact_phone;
$friend->contact_name = $data->contact_name;

// create friend
if ($friend->create()) {
    echo json_encode(
        array('message' => 'friend Created')
    );
} else {
    echo json_encode(
        array('message' => 'friend Not Created')
    );
}

?>