<?php

/**
 * Connect to the database with Class DB
 * 
 */

class DB {
    
    private static $db = null;
    private $dsn = 'mysql:dbname=project2;host=localhost';      // type in your db
    private $user = 'root';
    private $password = '';
    private $dbh = null;
  
    private function __construct() {
      try {
          $this->dbh = new PDO($this->dsn, $this->user, $this->password);
      } catch (PDOException $e) {
          // If the project is in development, take away if not 
          echo 'Connection failed: ' . $e->getMessage();
      }
    }
  
    public static function getDBConnection() {
        if (DB::$db==null) {
          DB::$db = new self();
        }
        return DB::$db->dbh;
    }
  }