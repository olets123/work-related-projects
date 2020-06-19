<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/About.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog About object
$about = new About($db);

// Get ID
$about->aboutId = isset($_GET['id']) ? $_GET['id'] : die();

// Get about
$about->read_single();

// Create array
$about_arr = array(
    'aboutId' => $aboutId,
    'hansContent' => $hansContent,
    'anitaContent' => $anitaContent,
    'mainContent' => $mainContent,
    'anitaPicture_url' => $anitaPicture_url,
    'anitaPicture_alt' => $anitaPicture_alt,
    'hansPicture_url' => $hansPicture_url,
    'hansPicture_alt' => $hansPicture_alt,
    'mainPicture_url' => $mainPicture_url,
    'mainPicture_alt' => $mainPicture_alt
);

// make json
printf(json_encode($about_arr));
?>
