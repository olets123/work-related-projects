<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Tag.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Tag object
$tag = new Tag($db);

// Get ID
$tag->tagId = isset($_GET['id']) ? $_GET['id'] : die();

// Get tag
$tag->read_single();

// Create array
$tag_arr = array(
    'tagId' => $tag->tagId,
    'content' => $tag->content,
);

// make json
printf(json_encode($tag_arr));
?>
