<?php

class News {
    // DB stuff
    private $conn;
    private $table = 'news';

    // news properties
    public $newsId;
    public $content;


    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get news
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

    // get single news
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                newsId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->newsId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->newsId = utf8_encode(html_entity_decode($row['newsId']));
        $this->content = utf8_encode(html_entity_decode($row['content']));
    }

    // create news
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

    // Update news
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET content = :content
            WHERE newsId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->content = utf8_decode(htmlspecialchars(strip_tags($this->content)));


        // Bind data
        $stmt->bindParam(':content', $this->content);

        $stmt->bindParam(':id', $this->newsId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE newsId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->newsId = utf8_decode(htmlspecialchars(strip_tags($this->newsId)));

        // Bind data
        $stmt->bindParam(':id', $this->newsId);
        
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
