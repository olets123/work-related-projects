<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/News.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate news object
$news = new News($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$news->newsId = $data->newsId;
$news->content = $data->content;

// Update news
if ($news->update()) {
    echo json_encode(
        array('message' => 'News Updated')
    );
} else {
    echo json_encode(
        array('message' => 'News Not Updated')
    );
}

?>