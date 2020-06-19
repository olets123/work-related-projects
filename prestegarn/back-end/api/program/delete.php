<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Program.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate program object
$program = new Program($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to delete
$program->programId = $_GET['id'];

// delete post
if ($program->delete()) {
    echo json_encode(
        array('message' => 'program deleted')
    );
} else {
    echo json_encode(
        array('message' => 'program Not deleted')
    );
}

?>