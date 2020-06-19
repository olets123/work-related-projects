<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/PartOf.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog partOf object
$partOf = new PartOf($db);

// Blog partOf query
$result = $partOf->read();
// get row count
$num = $result->rowCount();

// check if any PartOf
if ($num > 0) {
    // PartOf array
    $partOf_arr = array();
    $partOf_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // encode utf8
        $eventId = utf8_encode(html_entity_decode($eventId));
        $friendId = utf8_encode(html_entity_decode($friendId));
        $eventTitle = utf8_encode(html_entity_decode($eventTitle));
        $friendName = utf8_encode(html_entity_decode($friendName));
        
        $partOf_item = array(
            'eventId' => $eventId,
            'friendId' => $friendId,
            'eventTitle' => $eventTitle,
            'friendName' => $friendName
        );

        // Push to "data"
        array_push($partOf_arr['data'], $partOf_item);
    }
    
    // Turn to JSON & output
    echo json_encode($partOf_arr);

} else {
    // no PartOf
    echo json_encode(
        array('message' => 'No partOf found')
    );
}
?>