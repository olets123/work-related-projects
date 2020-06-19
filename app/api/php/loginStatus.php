<?php

/*
*   loginStatus.php checks the status if user is logged in, or
*   if user is not logged in
*/
session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$res['loggedIn'] = false;
if(isset($_SESSION['uid'])) {
    $stmt = $db->prepare('SELECT * FROM users WHERE user_id = ?');
    $stmt->execute(array($_SESSION['uid'])); 
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $res['loggedIn'] = true;
    $res['status'] = 'SUCCESS';
    $res['uid'] = $result['user_id'];
    $res['username'] = $result['user_email'];
    $res['firstname'] = $result['user_firstname'];
    $res['lastname'] = $result['user_lastname'];
    $res['premission'] = $result['user_premission'];
}

echo json_encode($res);