<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/News.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog news object
$news = new News($db);

// Blog news query
$result = $news->read();
// get row count
$num = $result->rowCount();

// check if any News
if ($num > 0) {
    // News array
    $news_arr = array();
    $news_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // encode utf8
        $newsId = utf8_encode(html_entity_decode($newsId));
        $content = utf8_encode(html_entity_decode($content));

        $news_item = array(
            'newsId' => $newsId,
            'content' => $content
        );

        // Push to "data"
        array_push($news_arr['data'], $news_item);
    }
    
    // Turn to JSON & output
    echo json_encode($news_arr);

} else {
    // no News
    echo json_encode(
        array('message' => 'No news found')
    );
}
?>