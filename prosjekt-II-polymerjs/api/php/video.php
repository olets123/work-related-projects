<?php

/**
 * video.php fetch all videoinformation from the database
 */

session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$stmt = $db->prepare('SELECT * FROM video_2');
$stmt->execute(); 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$res = [];
$res['status'] = 'FAILED';

if($result) {
    $res['status'] = 'SUCCESS';
    $res['result'] = $result;
} else {
    $res['status'] = 'FAILED';
}

echo json_encode($res);