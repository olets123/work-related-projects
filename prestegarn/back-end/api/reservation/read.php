<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Reservation.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog reservation object
$reservation = new Reservation($db);

// Blog reservation query
$result = $reservation->read();
// get row count
$num = $result->rowCount();

// check if any Reservation elements
if ($num > 0) {
    // Reservation array
    $reservation_arr = array();
    $reservation_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // encode utf8
        $reservationId = utf8_encode(html_entity_decode($reservationId));
        $name = utf8_encode(html_entity_decode($name));
        $email = utf8_encode(html_entity_decode($email));
        $eventType = utf8_encode(html_entity_decode($eventType));
        $mobile = utf8_encode(html_entity_decode($mobile));
        $quantity = utf8_encode(html_entity_decode($quantity));
        $fromDate = utf8_encode(html_entity_decode($fromDate));
        $toDate = utf8_encode(html_entity_decode($toDate));

        $reservation_item = array(
            'reservationId' => $reservationId,
            'name' => $name,
            'email' => $email,
            'eventType' => $eventType,
            'mobile' => $mobile,
            'quantity' => $quantity,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'accepted' => $accepted
        );

        // Push to "data"
        array_push($reservation_arr['data'], $reservation_item);
    }
    
    // Turn to JSON & output
    echo json_encode($reservation_arr);

} else {
    // no Reservation
    echo json_encode(
        array('message' => 'No reservation found')
    );
}
?>