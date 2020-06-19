<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/User.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$error = $user->__validateUserData($data->username, $data->passwordOne, $data->passwordTwo);

if ($error[0] === false) {
    $user->username = $data->username;
    $user->password = $data->passwordOne;

    // create user
    if ($user->create()) {
        echo json_encode(
            array('message' => 'User Created')
        );
    } else {
        echo json_encode(
            array('message' => 'User Not Created')
        );
    }
} else {
    echo json_encode(
        array('error' => $exists[1])
    );
}





?>