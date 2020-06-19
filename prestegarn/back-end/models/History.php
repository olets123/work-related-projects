<?php

class History {
    // DB stuff
    private $conn;
    private $table = 'history';

    // history properties
    public $timeId;
    public $year;
    public $title;
    public $description;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get history
    public function read($limit) {
        // create query
        if ($limit != null) {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY year LIMIT ' . $limit;
        } else {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY year';
        }
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single history
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                timeId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->timeId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->timeId = utf8_encode(html_entity_decode($row['timeId']));
        $this->year = utf8_encode(html_entity_decode($row['year']));
        $this->title = utf8_encode(html_entity_decode($row['title']));
        $this->description = utf8_encode(html_entity_decode($row['description']));

    }

    // create History
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET year = :year, 
            title = :title, description = :description';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->year = utf8_decode(htmlspecialchars(strip_tags($this->year)));
        $this->title = utf8_decode(htmlspecialchars(strip_tags($this->title)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));

        // Bind data
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update History
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . '  SET year = :year, 
            title = :title, description = :description
            WHERE timeId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->year = utf8_decode(htmlspecialchars(strip_tags($this->year)));
        $this->title = utf8_decode(htmlspecialchars(strip_tags($this->title)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));
        $this->timeId = utf8_decode(htmlspecialchars(strip_tags($this->timeId)));

        // Bind data
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->timeId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE timeId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->timeId = utf8_decode(htmlspecialchars(strip_tags($this->timeId)));

        // Bind data
        $stmt->bindParam(':id', $this->timeId);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    public function search($search, $yearSearch, $admin) {
        if (($yearSearch === true) && ($admin === false)) {
            $query =  "SELECT * FROM $this->table WHERE year >= $search && year <= $search + 50 ORDER BY year ASC";
        } else if (($yearSearch === false) && ($admin === false)) {
            $query =  "SELECT * FROM $this->table WHERE MATCH (title, description) AGAINST ('*$search*' IN BOOLEAN MODE) ORDER BY year ASC";
        } else if ($admin === true ) {
            $query =  "SELECT * FROM $this->table WHERE year = $search ORDER BY year ASC";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

?>
