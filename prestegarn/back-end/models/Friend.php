<?php

class Friend {
    // DB stuff
    private $conn;
    private $table = 'friends';

    // friend properties
    public $friendId;
    public $name;
    public $description;
    public $facebookLink;
    public $instagramLink;
    public $email;
    public $picture_url;
    public $picture_alt;
    public $contact_phone;
    public $contact_name;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get friend
    public function read($limit) {
        // create query
        if ($limit != null) {
            $query = 'SELECT * FROM ' . $this->table . ' LIMIT ' . $limit;
        } else {
            $query = 'SELECT * FROM ' . $this->table . '';
        }
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single friend
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                friendId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->friendId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->friendId = utf8_encode(html_entity_decode($row['friendId']));
        $this->name = utf8_encode(html_entity_decode($row['name']));
        $this->description = utf8_encode(html_entity_decode($row['description']));
        $this->facebookLink = utf8_encode(html_entity_decode($row['facebookLink']));
        $this->instagramLink = utf8_encode(html_entity_decode($row['instagramLink']));
        $this->email = utf8_encode(html_entity_decode($row['email']));
        $this->picture_url = utf8_encode(html_entity_decode($row['picture_url']));
        $this->picture_alt = utf8_encode(html_entity_decode($row['picture_alt']));
        $this->contact_phone = utf8_encode(html_entity_decode($row['contact_phone']));
        $this->contact_name = utf8_encode(html_entity_decode($row['contact_name']));
    }

    // create History
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, 
            picture_url = :picture_url, picture_alt = :picture_alt, 
            facebookLink = :facebookLink, instagramLink = :instagramLink, 
            email = :email, description = :description, 
            contact_phone = :contact_phone, contact_name = :contact_name';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = utf8_decode(htmlspecialchars(strip_tags($this->name)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));
        $this->facebookLink = utf8_decode(htmlspecialchars(strip_tags($this->facebookLink)));
        $this->instagramLink = utf8_decode(htmlspecialchars(strip_tags($this->instagramLink)));
        $this->email = utf8_decode(htmlspecialchars(strip_tags($this->email)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));
        $this->contact_phone = utf8_decode(htmlspecialchars(strip_tags($this->contact_phone)));
        $this->contact_name = utf8_decode(htmlspecialchars(strip_tags($this->contact_name)));


        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':facebookLink', $this->facebookLink);
        $stmt->bindParam(':instagramLink', $this->instagramLink);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);
        $stmt->bindParam(':contact_phone', $this->contact_phone);
        $stmt->bindParam(':contact_name', $this->contact_name);



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
        $query = 'UPDATE ' . $this->table . '  SET name = :name, 
            picture_url = :picture_url, picture_alt = :picture_alt, 
            facebookLink = :facebookLink, instagramLink = :instagramLink, 
            email = :email, description = :description,
            contact_phone = :contact_phone, contact_name = :contact_name
            WHERE friendId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = utf8_decode(htmlspecialchars(strip_tags($this->name)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));
        $this->facebookLink = utf8_decode(htmlspecialchars(strip_tags($this->facebookLink)));
        $this->instagramLink = utf8_decode(htmlspecialchars(strip_tags($this->instagramLink)));
        $this->email = utf8_decode(htmlspecialchars(strip_tags($this->email)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));
        $this->contact_phone = utf8_decode(htmlspecialchars(strip_tags($this->contact_phone)));
        $this->contact_name = utf8_decode(htmlspecialchars(strip_tags($this->contact_name)));
        
        $this->friendId = utf8_decode(htmlspecialchars(strip_tags($this->friendId)));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':facebookLink', $this->facebookLink);
        $stmt->bindParam(':instagramLink', $this->instagramLink);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);
        $stmt->bindParam(':contact_phone', $this->contact_phone);
        $stmt->bindParam(':contact_name', $this->contact_name);
        $stmt->bindParam(':id', $this->friendId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE friendId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->friendId = utf8_encode(htmlspecialchars(strip_tags($this->friendId)));

        // Bind data
        $stmt->bindParam(':id', $this->friendId);
        
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

