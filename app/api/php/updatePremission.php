<?php

/**
 * updates the access for all user to get permission to become teacher
 */

session_start();

    header("Access-Control-Allow-Origin: http://localhost:8081");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=utf-8");

    require_once '../classes/db_connect.php';
    $db = DB::getDBConnection();

    if (isset($_SESSION['uid']) && $_SESSION['premission'] == 'Admin') {
    // update db 
    $stmt = $db->prepare('UPDATE users SET user_premission="Teacher", user_request=0 WHERE user_id=?');
    $stmt->execute(array($_POST['id']));

    $res = [];
    $res["status"] = "SUCCESS";

    echo json_encode($res);
}