<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/News.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog News object
$news = new News($db);

// Get ID
$news->newsId = isset($_GET['id']) ? $_GET['id'] : die();


// Get news
$news->read_single();

// Create array
$news_arr = array(
    'newsId' => $news->newsId,
    'content' => $news->content
);

// make json
printf(json_encode($news_arr));
?>
