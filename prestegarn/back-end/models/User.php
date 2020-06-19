<?php
class User {
    // DB stuff
    private $conn;
    private $table = 'users';

    // user properties
    public $username;
    public $password;


    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // get user
    public function read_single() {
        // create query
        $query = 
            'SELECT username FROM ' . $this->table . ' 
            WHERE 
                username = :username 
                AND
                password = :password
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // validate
        $userError = $this->__validateLoginData();
        print_r($userError);
        if ($userError[0] == 1) {
            $this->password = md5($this->password); // encrypt password 
    
            // Bind param
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
    
            // execute query
            $stmt->execute();
    
            return $stmt;
        } else { $_SESSION['success'] = 'failure, because of: ' . $userError[1]; header('location: admin.index.php');}
    }

    // Get user
    public function read() {
        // create query
        $query = 
            'SELECT username FROM ' . $this->table . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function __validateUserData($username, $password_1, $password_2) {
        // check if empty
        if (empty($username)) { return array(false, "username is requried"); }
        if (empty($password_1)) { return array(false, "password is required"); }
        if ($password_1 != $password_2) { return array(false, "The two passwords do not match"); } 
        $password = $password_1;
        
        // regex password check
        // check if password is longer than 5 characters
        if (!preg_match("/^.{5,}$/", $password)) {
            return array(false, "Password must be longer than 5 letters"); 
        } 
        // check if there is at least one lowercase character
        if (!preg_match("/[a-z]/", $password)) {
            return array(false, "Password must have at least one lowercase character!");
        }
        // check if there is at least one uppercase character 
        if (!preg_match("/[A-Z]/", $password)) { 
            return array(false, "Password must have at least one uppercase character!");
        }
        // regex username check
        // check if username is between 3-8 characters
        if (!preg_match("/^.{3,8}$/", $username)) {
            return array(false, "Username must be between 3-8 characters!");
        }
        // check if username only includes letters, number and '_'
        if (preg_match("/[^a-zA-Z0-9_-]/", $username)) {
            return array(false, "Username must only include letters, numbers and underscores!");
        }
        return array(true, "success!");
    }

    public function __validateLoginData() {
        // check if empty
        if (empty($this->username)) { return array(false, "username is requried"); }
        if (empty($this->password)) { return array(false, "password is required"); }

        return array(true, "success!");
    }
}

?>
