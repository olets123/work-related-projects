<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

include_once('../../config/Database.php');
include_once('../../models/History.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate history object
$history = new History($db);

// check if search is empty, if yes stop process
$search = isset($_GET['search']) ? $_GET['search'] : die();
$admin = isset($_GET['admin']) ? true : false;

// define history query, but check if it is a year query or normal text query
if ((substr( $search, 0, 2 ) === '18') || (substr( $search, 0, 2 ) === '19')) {
    $result = $history->search($search, true, $admin);
} else {
    $result = $history->search($search, false, $admin);
}
// get row count
$num = $result->rowCount();

// check if any history
if ($num > 0) {
    // history array
    $history_arr = array();
    $history_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timeId = utf8_encode(html_entity_decode($timeId));
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