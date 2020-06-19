<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/program.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog tag object
$program = new Program($db);

// check if search is empty, if yes stop process
$search = isset($_GET['search']) ? $_GET['search'] : die();

// program query
$result = $program->search($search);

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
        $eventId = utf8_encode(html_entity_decode($eventId));
        $programId = utf8_encode(html_entity_decode($programId));
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
        array('message' => 'No tag found')
    );
}
?>