<?php 
session_start();
Class Server {
    function __construct() {
        $this->loggedIn = isset($_SESSION['username']);
        $this->username = '';
    }

    public function setSession($username) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = 'logged in';
        header('location: admin.index.php');
    }

    public function unsetSession () {
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            header('location: admin.index.php');
        }
    }
}

?>