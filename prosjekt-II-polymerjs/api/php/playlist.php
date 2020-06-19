<?php

/*
*   This fil are for creating a new playlist. This right are reserved for the teacher and admin users.
*   It also checks if the playlist already exist before it adds it to the database 
*/

session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$playlistName = !empty($_POST['navn']) ? trim($_POST['navn']) : null;   

$sql = "SELECT (playlist_name) FROM playlist";
$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$res = [];
$res['status'] = "FAILED";
if($row['playlist_name'] == $playlistName){
    $res['status'] = "Playlistname are taken";
} else {

    $sql = "INSERT INTO playlist (playlist_name) VALUES (:playlistName)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":playlistName", $playlistName);
    $result = $stmt->execute();
    if(!$result){
        $res['status'] = "DEFAULT";
    } else {
        $res['status'] = "SUCCESS";
    }
}

echo json_encode($res);