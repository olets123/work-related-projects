<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Gallery.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Gallery object
$gallery = new Gallery($db);

$readId = 0;

// Get ID
if (isset($_GET['gId']) && isset($_GET['tId'])) {
    $gallery->galleryId = $_GET['gId'];
    $gallery->timeId = $_GET['tId'];
    $readId = 0;
} else if (isset($_GET['gId']) && !isset($_GET['tId'])) {
    $gallery->galleryId = $_GET['gId'];
    $readId = 1;
} else if (!isset($_GET['gId']) && isset($_GET['tId'])) {
    $gallery->timeId = $_GET['tId'];
    $readId = 2;
} else { die(); }

// Get gallery
$result = $gallery->read_single($readId);

// get row count
$num = $result->rowCount();

// check if any gallery items
if ($num > 0) {
    // gallery array
    $gallery_arr = array();
    $gallery_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $galleryId = utf8_encode(html_entity_decode($galleryId));
        $timeId = utf8_encode(html_entity_decode($timeId));
        $picture_url = utf8_encode(html_entity_decode($picture_url));
        $picture_alt = utf8_encode(html_entity_decode($picture_alt));
        $copyright = utf8_encode(html_entity_decode($copyright));
        
        $gallery_item = array(
            'galleryId' => $galleryId,
            'timeId' => $timeId,
            'picture_url' => $picture_url,
            'picture_alt' => $picture_alt,
            'copyright' => $copyright
        );

        // Push to "data"
        array_push($gallery_arr['data'], $gallery_item);
    }
    
    // Turn to JSON & output
    echo json_encode($gallery_arr);

} else {
    // no gallery
    echo json_encode(
        array('message' => 'No gallery found')
    );
}