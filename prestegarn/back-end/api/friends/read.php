<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Friend.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog friend object
$friend = new Friend($db);

$limit = isset($_GET['limit']) ? $_GET['limit'] : null;
// Blog friend query
$result = $friend->read($limit);
// get row count
$num = $result->rowCount();

// check if any friend
if ($num > 0) {
    // friend array
    $friend_arr = array();
    $friend_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // encode utf8
        $friendId = utf8_encode(html_entity_decode($friendId));
        $name = utf8_encode(html_entity_decode($name));
        $description = utf8_encode(html_entity_decode($description));
        $facebookLink = utf8_encode(html_entity_decode($facebookLink));
        $instagramLink = utf8_encode(html_entity_decode($instagramLink));
        $email = utf8_encode(html_entity_decode($email));
        $picture_url = utf8_encode(html_entity_decode($picture_url));
        $picture_alt = utf8_encode(html_entity_decode($picture_alt));
        $contact_phone = utf8_encode(html_entity_decode($contact_phone));
        $contact_name = utf8_encode(html_entity_decode($contact_name));

        
        $friend_item = array(
            'friendId' => $friendId,
            'name' => $name,
            'description' => $description,
            'facebookLink' => $facebookLink,
            'instagramLink' => $instagramLink,
            'email' => $email,
            'picture_url' => $picture_url,
            'picture_alt' => $picture_alt,
            'contact_phone' => $contact_phone,
            'contact_name' => $contact_name

        );

        // Push to "data"
        array_push($friend_arr['data'], $friend_item);
    }
    
    // Turn to JSON & output
    echo json_encode($friend_arr);

} else {
    // no friend
    echo json_encode(
        array('message' => 'No friend found')
    );
}
?>