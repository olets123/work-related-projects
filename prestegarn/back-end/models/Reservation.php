<?php

class Reservation {
    // DB stuff
    private $conn;
    private $table = 'reservations';

    // reservation properties
    public $reservationId;
    public $name;
    public $email;
    public $eventType;
    public $mobile;
    public $quantity;
    public $fromDate;
    public $toDate;
    public $accepted;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get reservation
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

    // get single reservation
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                reservationId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->reservationId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->reservationId = utf8_encode(html_entity_decode($row['reservationId']));
        $this->name = utf8_encode(html_entity_decode($row['name']));
        $this->email = utf8_encode(html_entity_decode($row['email']));
        $this->eventType = utf8_encode(html_entity_decode($row['eventType']));
        $this->mobile = utf8_encode(html_entity_decode($row['mobile']));
        $this->quantity = utf8_encode(html_entity_decode($row['quantity']));
        $this->toDate = utf8_encode(html_entity_decode($row['toDate']));
        $this->fromDate = utf8_encode(html_entity_decode($row['fromDate']));
        $this->accepted = utf8_encode(html_entity_decode($row['accepted']));
    }

    // create reservation
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, 
            email = :email, eventType = :eventType, 
            mobile = :mobile, quantity = :quantity, toDate = :toDate, 
            fromDate = :fromDate, accepted = :accepted';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = utf8_decode(htmlspecialchars(strip_tags($this->name)));
        $this->email = utf8_decode(htmlspecialchars(strip_tags($this->email)));
        $this->eventType = utf8_decode(htmlspecialchars(strip_tags($this->eventType)));
        $this->mobile = utf8_decode(htmlspecialchars(strip_tags($this->mobile)));
        $this->quantity = utf8_decode(htmlspecialchars(strip_tags($this->quantity)));
        $this->toDate = utf8_decode(htmlspecialchars(strip_tags($this->toDate)));
        $this->fromDate = utf8_decode(htmlspecialchars(strip_tags($this->fromDate)));
        $this->accepted = utf8_decode(htmlspecialchars(strip_tags($this->accepted)));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':eventType', $this->eventType);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':toDate', $this->toDate);
        $stmt->bindParam(':fromDate', $this->fromDate);
        $stmt->bindParam(':accepted', $this->accepted);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    // Update reservation
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET accepted = :accepted 
            WHERE reservationId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->accepted = utf8_decode(htmlspecialchars(strip_tags($this->accepted)));

        // Bind data
        $stmt->bindParam(':accepted', $this->accepted);

        $stmt->bindParam(':id', $this->reservationId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE reservationId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->reservationId = utf8_decode(htmlspecialchars(strip_tags($this->reservationId)));

        // Bind data
        $stmt->bindParam(':id', $this->reservationId);
        
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
