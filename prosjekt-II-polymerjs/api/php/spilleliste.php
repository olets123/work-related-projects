<?php

/**
 *  This file allows the user to add videos to playlists. 
 *  This file compares the value of each input field against information from the database
 */

session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$spilleliste = !empty($_POST['spilleliste']) ? trim($_POST['spilleliste']) : null; 
$video = !empty($_POST['video']) ? trim($_POST['video']) : null; 

$sql = "SELECT * FROM playlist";
$stmt = $db->prepare($sql);
$stmt->execute();
$playlistid = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM video_2";
$stmt = $db->prepare($sql);
$stmt->execute();
$videoid = $stmt->fetch(PDO::FETCH_ASSOC);

if($spilleliste == $playlistid['playlist_name'] && $video == $videoid['video_filnavn']) {
    $res = [];
    $res['status'] = "FAILED";
    $sql = "INSERT INTO playlist_video (playlist_id, video_id) VALUES (:playlistid, :videoid)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":playlistid", $playlistid['playlist_id']);
    $stmt->bindParam(":videoid", $videoid['video_id']);
    $result = $stmt->execute();
    if(!$result){
        $res['status'] = "DEFAULT";
    } else {
        $res['status'] = "SUCCESS";
    }
} else {
    $res['status'] = "Something went wrong!";
}

echo json_encode($res);