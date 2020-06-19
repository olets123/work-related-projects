<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Gallery.php');

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog tag object
$gallery = new Gallery($db);

// check if search is empty, if yes stop process
$search = isset($_GET['search']) ? $_GET['search'] : die();

// gallery query
$result = $gallery->search($search);

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
        $galleryId = utf8_encode(html_entity_decode($galleryId));
        $timeId = utf8_encode(html_entity_decode($timeId));
        $picture_url = utf8_encode(html_entity_decode($picture_url));
        $picture_alt = utf8_encode(html_entity_decode($picture_alt));
        $copyright = utf8_encode(html_entity_decode($copyright));

        $program_item = array(
            'galleryId' => $galleryId,
            'timeId' => $timeId,
            'picture_url' => $picture_url,
            'picture_alt' => $picture_alt,
            'copyright' => $copyright
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