<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Friend.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog friend object
$friend = new Friend($db);

// Get ID
$friend->friendId = isset($_GET['id']) ? $_GET['id'] : die();


// Get friend
$friend->read_single();

// Create array
$friend_arr = array(
    'friendId' => $friend->friendId,
    'name' => $friend->name,
    'description' => $friend->description,
    'facebookLink' => $friend->facebookLink,
    'instagramLink' => $friend->instagramLink,
    'email' => $friend->email,
    'picture_url' => $friend->picture_url,
    'picture_alt' => $friend->picture_alt,
    'contact_phone' => $friend->contact_phone,
    'contact_name' => $friend->contact_name
);

// make json
printf(json_encode($friend_arr));
?>
