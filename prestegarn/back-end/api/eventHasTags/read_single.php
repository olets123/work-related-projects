<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/EventHasTags.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog EventHasTags object
$eventHasTags = new EventHasTags($db);

$readId = 0;

// Get ID
if (isset($_GET['eId']) && isset($_GET['tId'])) {
    $eventHasTags->eventId = $_GET['eId'];
    $eventHasTags->tagId = $_GET['tId'];
    $readId = 0;
} else if (isset($_GET['eId']) && !isset($_GET['tId'])) {
    $eventHasTags->eventId = $_GET['eId'];
    $readId = 1;
} else if (!isset($_GET['eId']) && isset($_GET['tId'])) {
    $eventHasTags->tagId = $_GET['tId'];
    $readId = 2;
} else { die(); }

// Get eventHasTags
$result = $eventHasTags->read_single($readId);

// get row count
$num = $result->rowCount();

// check if any EventHasTags
if ($num > 0) {
    // EventHasTags array
    $eventHasTags_arr = array();
    $eventHasTags_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // encode utf8
        $eventId = utf8_encode(html_entity_decode($eventId));
        $tagId = utf8_encode(html_entity_decode($tagId));
        $tagContent = utf8_encode(html_entity_decode($tagContent));
        
        $eventHasTags_item = array(
            'eventId' => $eventId,
            'tagId' => $tagId,
            'tagContent' => $tagContent
        );

        // Push to "data"
        array_push($eventHasTags_arr['data'], $eventHasTags_item);
    }
    
    // Turn to JSON & output
    echo json_encode($eventHasTags_arr);

} else {
    // no EventHasTags
    echo json_encode(
        array('message' => 'No eventHasTags found')
    );
}
?>
