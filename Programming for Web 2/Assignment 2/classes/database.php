<?php
// inlcude the file setup.php
include_once('./configuration/setup.php');

/* The class Database connects with the database in phpmyadmin.
* $host finds localhost
* $db_name finds det name of the database
*/
class Database {

    // Database params
    private $host = 'localhost';
    private $db_name = 'dictionary';
    private $username = 'root';
    private $password = ''; 
    private $conn;


    // Public function for database connect
    public function connect() {
        $this->conn = null;

        try { 
            $this->conn = new PDO('mysql:host=' . $this->host . 
                ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        
        return $this->conn;
    }
}

?>