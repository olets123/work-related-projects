<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Tag.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog tag object
$tag = new Tag($db);

// Blog tag query
$result = $tag->read();
// get row count
$num = $result->rowCount();

// check if any Tag
if ($num > 0) {
    // Tag array
    $tag_arr = array();
    $tag_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // encode utf8
        $tagId = utf8_encode(html_entity_decode($tagId));
        $content = utf8_encode(html_entity_decode($content));

        $tag_item = array(
            'tagId' => $tagId,
            'content' => $content,
        );

        // Push to "data"
        array_push($tag_arr['data'], $tag_item);
    }
    
    // Turn to JSON & output
    echo json_encode($tag_arr);

} else {
    // no Tag
    echo json_encode(
        array('message' => 'No tag found')
    );
}
?>