<?php

class Gallery {
    // DB stuff
    private $conn;
    private $table = 'gallery';

    // gallery properties
    public $galleryId;
    public $timeId;
    public $picture_url;
    public $picture_alt;
    public $copyright;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get gallery
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

    // get single gallery item
    public function read_single($readId) {
        // create query
        if ($readId === 0) {
            $query = 
                'SELECT *
                FROM ' . $this->table . '
                WHERE 
                    galleryId = :galleryId
                    AND
                    timeId = :timeId';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':galleryId', $this->galleryId);
            $stmt->bindParam(':timeId', $this->timeId);
        } else if ($readId === 1) {
            // create query
            $query = 
                'SELECT * FROM ' . $this->table . '
                WHERE 
                    galleryId = :galleryId';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':galleryId', $this->galleryId);
        } else if ($readId === 2) {
        // create query
            $query = 
                'SELECT * FROM ' . $this->table . '
                WHERE 
                    timeId = :timeId';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':timeId', $this->timeId);
        }
        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create Gallery
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET timeId = :timeId, 
            picture_url = :picture_url, picture_alt = :picture_alt, copyright = :copyright';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->timeId = utf8_decode(htmlspecialchars(strip_tags($this->timeId)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));
        $this->copyright = utf8_decode(htmlspecialchars(strip_tags($this->copyright)));

        // Bind data
        $stmt->bindParam(':timeId', $this->timeId);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);
        $stmt->bindParam(':copyright', $this->copyright);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update Gallery
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . '  SET timeId = :timeId, 
            picture_url = :picture_url, picture_alt = :picture_alt, copyright = :copyright
            WHERE galleryId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->galleryId = utf8_decode(htmlspecialchars(strip_tags($this->galleryId)));
        $this->timeId = utf8_decode(htmlspecialchars(strip_tags($this->timeId)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));
        $this->copyright = utf8_decode(htmlspecialchars(strip_tags($this->copyright)));

        // Bind data
        $stmt->bindParam(':id', $this->galleryId);
        $stmt->bindParam(':timeId', $this->timeId);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);
        $stmt->bindParam(':copyright', $this->copyright);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE galleryId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->galleryId = utf8_decode(htmlspecialchars(strip_tags($this->galleryId)));

        // Bind data
        $stmt->bindParam(':id', $this->galleryId);
        
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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE picture_url = "' . $search . '";' ;
        

        $stmt = $this->conn->prepare($query);
        // clean data
        $this->galleryId = utf8_decode(htmlspecialchars(strip_tags($this->galleryId)));
        $this->timeId = utf8_decode(htmlspecialchars(strip_tags($this->timeId)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));
        
        // execute query
        $stmt->execute();
        return $stmt;
    }
}

?>
