<?php

/**
 * upload.php,
 * upload files to database and moves the image,video and vtt files to according folders     
 */

    session_start();

    header("Access-Control-Allow-Origin: http://localhost:8081"); // give access for polymer, prevent cors problem
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=utf-8");

    require_once '../classes/db_connect.php';   
    $db = DB::getDBConnection();

    $res = [];
    $res['status'] = 'FAILED';
    if(isset($_FILES['vtt']['name'])){ 
    // move files to folder
    move_uploaded_file($_FILES['vtt']['tmp_name'], '../../vtt/' . $_FILES['vtt']['name']); 
    move_uploaded_file($_FILES['image']['tmp_name'], '../../pictures/' . $_FILES['image']['name']); 
    move_uploaded_file($_FILES['video']['tmp_name'], '../../videos/' . $_FILES['video']['name']);
    // insert files into db
    $sql = "INSERT INTO video_2 (video_text, image_filnavn, video_filnavn, video_beskrivelse, video_tittel, video_kategori) VALUES (:filnavn, :bildenavn, :videonavn, :beskrivelse, :tittel, :kategori)"; 
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(":filnavn", $_FILES['vtt']['name']);
    $stmt->bindParam(":bildenavn", $_FILES['image']['name']);
    $stmt->bindParam(":beskrivelse", $_POST['beskrivelse']);
    $stmt->bindParam(":tittel", $_POST['tittel']);
    $stmt->bindParam(":kategori", $_POST['kategori']);
    $stmt->bindParam(":videonavn", $_FILES['video']['name']);
    $result = $stmt->execute();
    if($result) {
        // check if success
        $res['status'] = 'SUCCESS';
        } 
    } 
    echo json_encode($res);
