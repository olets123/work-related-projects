<?php

class Tag {
    // DB stuff
    private $conn;
    private $table = 'tags';

    // tag properties
    public $tagId;
    public $content;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get tag
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

    // get single tag
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                tagId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->tagId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->tagId = utf8_encode(html_entity_decode($row['tagId']));
        $this->content = utf8_encode(html_entity_decode($row['content']));

    }

    // create tag
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET content = :content';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));

        // Bind data
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

    // Update tag
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET content = :content
            WHERE tagId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));

        // Bind data
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':id', $this->tagId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE tagId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->tagId = utf8_decode(htmlspecialchars(strip_tags($this->tagId)));

        // Bind data
        $stmt->bindParam(':id', $this->tagId);
        
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