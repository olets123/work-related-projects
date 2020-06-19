<?php

/**
 * register.php 
 * insert userinformation into db and creates a user
 */


header("Access-Control-Allow-Origin: http://localhost:8081");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=utf-8");

require_once '../classes/db_connect.php';
$db = DB::getDBConnection();

$firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;   
$lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$email = strtolower($email);
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;

$checkbox = "";
$premission = "Student";
if(isset($_POST['checkbox'])){
    $checkbox = "1";
} else {
    $checkbox = "0";
}

$sql = "SELECT (user_email) FROM users";
$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$res = [];
$res['status'] = "FAILED";
if($row['user_email'] == $email){
    $res['status'] = "Email are taken";
} else {
    // encrypt password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_pwd, user_premission, user_request) VALUES (:firstname, :lastname, :email, :pwd, :premission, :request)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $passwordHash);
    $stmt->bindParam(":premission", $premission);
    $stmt->bindParam("request", $checkbox);

    $result = $stmt->execute();

    // if database empty, an empty array will appear in console
    // thats why we add user manually

    if(!$result){
        $res['status'] = "DEFAULT";
    } else {
        $res['status'] = "SUCCESS";
    }
}

echo json_encode($res);
 








