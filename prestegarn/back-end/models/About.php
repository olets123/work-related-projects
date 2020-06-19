<?php

class About {
    // DB stuff
    private $conn;
    private $table = 'about';

    // about properties
    public $aboutId;
    public $hansContent;
    public $anitaContent;
    public $mainContent;
    public $anitaPicture_url;
    public $anitaPicture_alt;
    public $hansPicture_url;
    public $hansPicture_alt;
    public $mainPicture_url;
    public $mainPicture_alt;


    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get about
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

    // create about
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET hansContent = :hansContent, anitaContent = :anitaContent, mainContent = :mainContent, 
            anitaPicture_url = :anitaPicture_url, anitaPicture_alt = :anitaPicture_alt, hansPicture_url = :hansPicture_url, 
            hansPicture_alt = :hansPicture_alt, mainPicture_url = :mainPicture_url, mainPicture_alt = :mainPicture_alt';
        
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

    // Update about
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET hansContent = :hansContent, anitaContent = :anitaContent, mainContent = :mainContent, 
            anitaPicture_url = :anitaPicture_url, anitaPicture_alt = :anitaPicture_alt, hansPicture_url = :hansPicture_url, 
            hansPicture_alt = :hansPicture_alt, mainPicture_url = :mainPicture_url, mainPicture_alt = :mainPicture_alt
            WHERE aboutId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->hansContent = utf8_decode(htmlspecialchars(strip_tags($this->hansContent)));
        $this->anitaContent = utf8_decode(htmlspecialchars(strip_tags($this->anitaContent)));
        $this->mainContent = utf8_decode(htmlspecialchars(strip_tags($this->mainContent)));
        $this->anitaPicture_url = utf8_decode(htmlspecialchars(strip_tags($this->anitaPicture_url)));
        $this->anitaPicture_alt = utf8_decode(htmlspecialchars(strip_tags($this->anitaPicture_alt)));
        $this->hansPicture_url = utf8_decode(htmlspecialchars(strip_tags($this->hansPicture_url)));
        $this->hansPicture_alt = utf8_decode(htmlspecialchars(strip_tags($this->hansPicture_alt)));
        $this->mainPicture_url = utf8_decode(htmlspecialchars(strip_tags($this->mainPicture_url)));
        $this->mainPicture_alt = utf8_decode(htmlspecialchars(strip_tags($this->mainPicture_alt)));

        // Bind data
        $stmt->bindParam(':hansContent', $this->hansContent);
        $stmt->bindParam(':anitaContent', $this->anitaContent);
        $stmt->bindParam(':mainContent', $this->mainContent);
        $stmt->bindParam(':anitaPicture_url', $this->anitaPicture_url);
        $stmt->bindParam(':anitaPicture_alt', $this->anitaPicture_alt);
        $stmt->bindParam(':hansPicture_url', $this->hansPicture_url);
        $stmt->bindParam(':hansPicture_alt', $this->hansPicture_alt);
        $stmt->bindParam(':mainPicture_url', $this->mainPicture_url);
        $stmt->bindParam(':mainPicture_alt', $this->mainPicture_alt);

        $stmt->bindParam(':id', $this->aboutId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE aboutId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->aboutId = utf8_decode(htmlspecialchars(strip_tags($this->aboutId)));

        // Bind data
        $stmt->bindParam(':id', $this->aboutId);
        
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
