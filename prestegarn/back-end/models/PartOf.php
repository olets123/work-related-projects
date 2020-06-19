<?php

class PartOf {
    // DB stuff
    private $conn;
    private $table = 'friendspartofevents';

    // partOf properties
    public $eventId;
    public $friendId;
    public $eventTitle;
    public $friendName;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get partOf
    public function read() {
        // create query
        $query = 
            'SELECT p.*, e.title "eventTitle", s.name "friendName" 
                FROM ' . $this->table . ' p INNER JOIN events e 
                ON p.eventId = e.eventId INNER JOIN friends s 
                ON p.friendId = s.friendId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single partOf
    public function read_single($readId) {
        // create query
        if ($readId === 0) {
            $query = 
                'SELECT p.*, e.title "eventTitle", s.name "friendName" 
                FROM ' . $this->table . ' p INNER JOIN events e 
                ON p.eventId = e.eventId INNER JOIN friends s 
                ON p.friendId = s.friendId
                WHERE 
                    p.eventId = :eventId
                    AND
                    p.friendId = :friendId';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
            $stmt->bindParam(':friendId', $this->friendId);
        } else if ($readId === 1) {
            $query = 
                'SELECT p.*, e.title "eventTitle", s.name "friendName" 
                FROM ' . $this->table . ' p INNER JOIN events e 
                ON p.eventId = e.eventId INNER JOIN friends s 
                ON p.friendId = s.friendId
                WHERE 
                    p.eventId = :eventId';
        
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
        } else if ($readId === 2) {
            $query = 
                'SELECT p.*, e.title "eventTitle", s.name "friendName" 
                FROM ' . $this->table . ' p INNER JOIN events e 
                ON p.eventId = e.eventId INNER JOIN friends s 
                ON p.friendId = s.friendId
                WHERE 
                    p.friendId = :friendId';
        
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':friendId', $this->friendId);
        }
        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create partOf
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' 
            SET eventId = :eventId, 
            friendId = :friendId';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->friendId = utf8_decode(htmlspecialchars(strip_tags($this->friendId)));

        // Bind data
        $stmt->bindParam(':eventId', $this->eventId);
        $stmt->bindParam(':friendId', $this->friendId);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
    // delete friend part of event

    public function delete() {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE eventId= :eId AND friendId= :fId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->friendId = utf8_decode(htmlspecialchars(strip_tags($this->friendId)));

        // Bind data
        $stmt->bindParam(':eId', $this->eventId);
        $stmt->bindParam(':fId', $this->friendId);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}

?>
