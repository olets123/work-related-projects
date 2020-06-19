<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/About.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog about object
$about = new About($db);

// Blog about query
$result = $about->read();
// get row count
$num = $result->rowCount();

// check if any About elements
if ($num > 0) {
    // About array
    $about_arr = array();
    $about_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        // encode utf8
        $aboutId = utf8_encode(html_entity_decode($aboutId));
        $hansContent = utf8_encode(html_entity_decode($hansContent));
        $anitaContent = utf8_encode(html_entity_decode($anitaContent));
        $mainContent = utf8_encode(html_entity_decode($mainContent));
        $anitaPicture_url = utf8_encode(html_entity_decode($anitaPicture_url));
        $anitaPicture_alt = utf8_encode(html_entity_decode($anitaPicture_alt));
        $hansPicture_url = utf8_encode(html_entity_decode($hansPicture_url));
        $hansPicture_alt = utf8_encode(html_entity_decode($hansPicture_alt));
        $mainPicture_url = utf8_encode(html_entity_decode($mainPicture_url));
        $mainPicture_alt = utf8_encode(html_entity_decode($mainPicture_alt));

        $about_item = array(
            'aboutId' => $aboutId,
            'hansContent' => $hansContent,
            'anitaContent' => $anitaContent,
            'mainContent' => $mainContent,
            'anitaPicture_url' => $anitaPicture_url,
            'anitaPicture_alt' => $anitaPicture_alt,
            'hansPicture_url' => $hansPicture_url,
            'hansPicture_alt' => $hansPicture_alt,
            'mainPicture_url' => $mainPicture_url,
            'mainPicture_alt' => $mainPicture_alt
        );

        // Push to "data"
        array_push($about_arr['data'], $about_item);
    }
    
    // Turn to JSON & output
    echo json_encode($about_arr);

} else {
    // no About
    echo json_encode(
        array('message' => 'No about found')
    );
}
?>