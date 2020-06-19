<?php

/*
*   This file compares input values from the user against database userinformation.
*   If the login are a match this file returns all the information about this user
*/
session_start();

header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$username = !empty($_POST['username']) ? trim($_POST['username']) : null; 
$password = !empty($_POST['password']) ? trim($_POST['password']) : null; 

$stmt = $db->prepare('SELECT * FROM users WHERE user_email = ?');
$stmt->execute(array($username)); // Checks username from the form up against username in db. 
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$res = [];  
$res['status'] = 'FAILED';
if($result) {
    // checks if password is correct
    $pwdCheck = password_verify($password, $result['user_pwd']);
    if(($pwdCheck == $result['user_pwd'])){
        $res['status'] = 'SUCCESS';
        $res['uid'] = $result['user_id'];
        $res['username'] = $result['user_email'];
        $res['firstname'] = $result['user_firstname'];
        $res['lastname'] = $result['user_lastname'];
        $res['password'] = $pwdCheck;
        $res['premission'] = $result['user_premission'];
        $_SESSION['uid'] = $result['user_id'];
        $_SESSION['premission'] = $result['user_premission'];
    } else {
        $res['status'] = 'Wrong password';
    }
} else {
    $res['status'] = 'The user doesnt exist';
}

echo json_encode($res);
