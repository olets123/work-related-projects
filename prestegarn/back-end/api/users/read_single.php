<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/User.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

$user->username = isset($_POST['username']) ? $_POST['username'] : die();
$user->password = isset($_POST['password']) ? $_POST['password'] : die();

// User query
$result = $user->read_single();
// get row count
$num = $result->rowCount();

// checkUser
if ($num === 0) {
    $exists = false;
    // no User
    echo json_encode(
        array('message' => 'No user found')
    );
} else {
    $exists = true;
    // user found 
    echo json_encode(
        array('message' => 'User found')
    );
}

if ($exists === true) {
    $_SESSION['username'] = $user->username;
    $_SESSION['success'] = 'logged in';
    header('location: index.php');
} else {
    $_SESSION['success'] = 'failure';
    header('location: index.php');
}

?>
