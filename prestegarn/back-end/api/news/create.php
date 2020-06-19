<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/News.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate news object
$news = new News($db);

// Get raw posted data

$data = json_decode(utf8_decode(file_get_contents("php://input")));

$news->content = $data->content;

// create news
if ($news->create()) {
    echo json_encode(
        array('message' => 'News Created')
    );
} else {
    echo json_encode(
        array('message' => 'News Not Created')
    );
}

?>