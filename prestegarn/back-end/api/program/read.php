<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/Program.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog program object
$program = new Program($db);

// Blog program query
$result = $program->read();
// get row count
$num = $result->rowCount();

// check if any program
if ($num > 0) {
    // program array
    $program_arr = array();
    $program_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // encode utf8
        $programId = utf8_encode(html_entity_decode($programId));
        $eventId = utf8_encode(html_entity_decode($eventId));
        $time = utf8_encode(html_entity_decode($time));
        $content = utf8_encode(html_entity_decode($content));
        
        $program_item = array(
            'programId' => $programId,
            'eventId' => $eventId,
            'time' => $time,
            'content' => $content
        );

        // Push to "data"
        array_push($program_arr['data'], $program_item);
    }
    
    // Turn to JSON & output
    echo json_encode($program_arr);

} else {
    // no program
    echo json_encode(
        array('message' => 'No program found')
    );
}
?>