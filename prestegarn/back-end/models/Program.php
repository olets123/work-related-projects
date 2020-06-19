<?php

class Program {
    // DB stuff
    private $conn;
    private $table = 'program';

    // program properties
    public $programId;
    public $eventId;
    public $time;
    public $content;


    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get program
    public function read() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single program
    public function read_single($readId) {
        // create query
        if ($readId === 0) {
            $query = 
            'SELECT *  FROM ' . $this->table . '
            WHERE 
                eventId = :eventId
                AND
                programId = :programId ORDER BY time';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
            $stmt->bindParam(':programId', $this->programId);
        } else if ($readId === 1) {
            $query = 
            'SELECT *  FROM ' . $this->table . '
            WHERE 
                eventId = :eventId ORDER BY time;';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':eventId', $this->eventId);
        } else if ($readId === 2) {
            $query = 
            'SELECT *  FROM ' . $this->table . '
            WHERE 
                programId = :programId ORDER BY time;';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':programId', $this->programId);
        }

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create program
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET eventId = :eventId, 
            time = :time, content = :content';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->time = utf8_decode(htmlspecialchars(strip_tags($this->time)));
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));


        // Bind data
        $stmt->bindParam(':eventId', $this->eventId);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':content', $this->content);


        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update program
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET eventId = :eventId, 
            time = :time, content = :content
            WHERE programId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->time = utf8_decode(htmlspecialchars(strip_tags($this->time)));
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));

        // Bind data
        $stmt->bindParam(':eventId', $this->eventId);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':id', $this->programId); 

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    public function delete() {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE programId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->programId = utf8_decode(htmlspecialchars(strip_tags($this->programId)));

        // Bind data
        $stmt->bindParam(':id', $this->programId);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    public function search($search) {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE content = "' . $search . '";' ;
        

        $stmt = $this->conn->prepare($query);
        // clean data
        $this->programId = utf8_decode(htmlspecialchars(strip_tags($this->programId)));
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));
        $this->time = utf8_decode(htmlspecialchars(strip_tags($this->time)));
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));
        
        // execute query
        $stmt->execute();
        return $stmt;
    }
}

?>
