<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/History.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog history object
$history = new History($db);

$limit = isset($_GET['limit']) ? $_GET['limit'] : null;
// Blog history query
$result = $history->read($limit);
// get row count
$num = $result->rowCount();

// check if any history
if ($num > 0) {
    // history array
    $history_arr = array();
    $history_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timeId = utf8_encode($timeId);
        $year = utf8_encode(html_entity_decode($year));
        $title = utf8_encode(html_entity_decode($title));
        $description = utf8_encode(html_entity_decode($description));
        
        $history_item = array(
            'timeId' => $timeId,
            'year' => $year,
            'title' => $title,
            'description' => $description
        );

        // Push to "data"
        array_push($history_arr['data'], $history_item);
    }
    
    // Turn to JSON & output
    echo json_encode($history_arr);

} else {
    // no history
    echo json_encode(
        array('message' => 'No history found')
    );
}
?>