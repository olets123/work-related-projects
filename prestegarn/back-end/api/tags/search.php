<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/TagSearch.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog tag object
$tag = new TagSearch($db);

// check if search is empty, if yes stop process
$search = isset($_GET['search']) ? $_GET['search'] : die();
$admin = isset($_GET['admin']) ? true : false;


// Blog tag query
$result = $tag->search($search, $admin);
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
        $eventId = utf8_encode(html_entity_decode($eventId));
        $title = utf8_encode(html_entity_decode($title));
        $date = utf8_encode(html_entity_decode($date));
        $description = utf8_encode(html_entity_decode($description));
        $ticketsSold = utf8_encode(html_entity_decode($ticketsSold));
        $numTickets = utf8_encode(html_entity_decode($numTickets));
        $price = utf8_encode(html_entity_decode($price));
        $picture_url = utf8_encode(html_entity_decode($picture_url));
        $picture_alt = utf8_encode(html_entity_decode($picture_alt));
        $content = utf8_encode(html_entity_decode($content));
        $tagId = utf8_encode(html_entity_decode($tagId));

        $tag_item = array(
            'eventId' => $eventId,
            'date' => $date,
            'title' => $title,
            'description' => $description,
            'ticketsSold' => $ticketsSold,
            'numTickets' => $numTickets,
            'price' => $price,
            'picture_url' => $picture_url,
            'picture_alt' => $picture_alt,
            'content' => $content,
            'tagId' => $tagId
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