<?php

class EventHasTags {
    // DB stuff
    private $conn;
    private $table = 'eventhastags';

    // eventHasTags properties
    public $eventId;
    public $tagId;
    public $tagContent;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get eventHasTags
    public function read() {
        // create query
        $query = 
            'SELECT h.*, t.content "tagContent" 
                FROM ' . $this->table . ' h INNER JOIN tags t 
                ON h.tagId = t.tagId ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single eventHasTags
    public function read_single($readId) {
        // create query
        if ($readId === 0) {
            $query = 
                'SELECT h.*, t.content "tagContent" 
                FROM ' . $this->table . ' h INNER JOIN tags t 
                ON h.tagId = t.tagId 
                WHERE 
                    h.eventId = :eventId
                    AND
                    h.tagId = :tagId';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
            $stmt->bindParam(':tagId', $this->tagId);
        } else if ($readId === 1) {
            $query = 
                'SELECT h.*, t.content "tagContent" 
                FROM ' . $this->table . ' h INNER JOIN tags t 
                ON h.tagId = t.tagId 
                WHERE 
                    h.eventId = :eventId';
        
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
        } else if ($readId === 2) {
            $query = 
                'SELECT h.*, t.content "tagContent" 
                FROM ' . $this->table . ' h INNER JOIN tags t 
                ON h.tagId = t.tagId 
                WHERE
                    h.tagId = :tagId';
        
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':tagId', $this->tagId);
        }
        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create eventHasTags
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' 
            SET eventId = :eventId, 
            tagId = :tagId';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->tagId = utf8_decode(htmlspecialchars(strip_tags($this->tagId)));

        // Bind data
        $stmt->bindParam(':eventId', $this->eventId);
        $stmt->bindParam(':tagId', $this->tagId);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // delete eventHasTags
    public function delete() {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE eventId= :eId AND tagID= :tId';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->tagId = utf8_decode(htmlspecialchars(strip_tags($this->tagId)));

        // Bind data
        $stmt->bindParam(':eId', $this->eventId);
        $stmt->bindParam(':tId', $this->tagId);
        
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
