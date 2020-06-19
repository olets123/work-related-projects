<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/User.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog user object
$user = new User($db);

// Blog user query
$result = $user->read();
// get row count
$num = $result->rowCount();

// check if any User
if ($num > 0) {
    // User array
    $user_arr = array();
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // encode utf8
        $username = utf8_encode(html_entity_decode($username));
        
        $user_item = array(
            'username' => $username
        );

        // Push to "data"
        array_push($user_arr['data'], $user_item);
    }
    
    // Turn to JSON & output
    echo json_encode($user_arr);

} else {
    // no User
    echo json_encode(
        array('message' => 'No user found')
    );
}
?>