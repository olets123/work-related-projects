<?php

/*
*   This file did we not manage to finish. The end goal was to return the playlistname     
*   width the correct video. We manage to find the maching values, but we had a difficould
*   time understanding how to loop through each result and display them all
*/

session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$stmt = $db->prepare('SELECT * FROM playlist_video');
$stmt->execute(); 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM video_2');
$stmt->execute(); 
$res1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM playlist');
$stmt->execute(); 
$res2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$res = [];
$res['status'] = 'FAILED';
if($result) {
    foreach($result as $item) {
        foreach($res1 as $item1) {
            if($item['video_id'] == $item1['video_id']){
                foreach($res2 as $item2) {
                    if($item2['playlist_id'] == $item['playlist_id']) {
                        $res['status'] = 'SUCCESS';
                        $res['playlist_navn'] = $item2['playlist_name'];
                        $res['video_navn'] = $item1['video_filnavn'];
                        $res['bruker'] = $item1['video_tittel'];
                    }
                }
            } 
        }  
    }
}


echo json_encode($res);

