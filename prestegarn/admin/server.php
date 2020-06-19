<?php
include('../back-end/models/User.php');
include('../back-end/config/Database.php');
include('./serverClass.php');
$server = new Server();
if (isset($_POST['login'])) {
    // instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate user object
    $user = new User($db);

    $user->username = isset($_POST['username']) ? $_POST['username'] : die();
    $user->password = isset($_POST['password']) ? $_POST['password'] : die();

    // User query
    $result = $user->read_single();
    // get row count
    $num = $result->rowCount();
    $exists = false;

    // checkUser
    if ($num === 0) {
        $_SESSION['success'] = 'failure';
    } else {
        $server->setSession($user->username);
    }
}
if (isset($_GET['logout'])) {
    $server->unsetSession();
}
?>