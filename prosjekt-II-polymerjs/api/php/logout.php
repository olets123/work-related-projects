<?php

/*
*   This file destroy the session, and set all the user values to 0.
*   Then the user are signed out. 
*/

session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$res = [];
// checks user id and destroy session if not logged in
if(isset($_SESSION['uid'])) {
    session_destroy();
    unset($_SESSION['uid']);
    $res['status'] = 'SUCCESS';
    $res['uid'] = null;
    $res['username'] = '';
    $res['firstname'] = '';
    $res['lastname'] = '';
    $res['premission'] = '';
} else {
    $res['status'] = 'FAILED';
    $res['errormsg'] = 'Not logged in';
}

echo json_encode($res);

