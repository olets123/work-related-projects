<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Event.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog event object
$event = new Event($db);

// check if search is empty, if yes stop process
$search = isset($_GET['search']) ? utf8_decode($_GET['search']) : die();
$admin = isset($_GET['admin']) ? true : false;

// Blog event query
$result = $event->search($search, $admin);

// get row count
$num = $result->rowCount();

// check if any Event
if ($num > 0) {
    
    // Event array
    $event_arr = array();
    $event_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // encode utf8
        $eventId = utf8_encode(html_entity_decode($eventId));
        $title = utf8_encode(html_entity_decode($title));
        $date = utf8_encode(html_entity_decode($date));
        $description = utf8_encode(html_entity_decode($description));
        $ticketsSold = utf8_encode(html_entity_decode($ticketsSold));
        $numTickets = utf8_encode(html_entity_decode($numTickets));
        $price = utf8_encode(html_entity_decode($price));
        $picture_url = utf8_encode(html_entity_decode($picture_url));
        $picture_alt = utf8_encode(html_entity_decode($picture_alt));

        $event_item = array(
            'eventId' => $eventId,
            'title' => $title,
            'date' => $date,
            'description' => $description,
            'ticketsSold' => $ticketsSold,
            'numTickets' => $numTickets,
            'price' => $price,
            'picture_url' => $picture_url,
            'picture_alt' => $picture_alt
        );

        // Push to "data"
        array_push($event_arr['data'], $event_item);
    }
    // Turn to JSON & output
    echo json_encode($event_arr);
} else {
    // no Event
    echo json_encode(
        array('message' => 'No event found')
    );
}
?>