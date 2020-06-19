<?php

class Event {
    // DB stuff
    private $conn;
    private $table = 'events';

    // event properties
    public $eventId;
    public $title;
    public $date;
    public $description;
    public $ticketsSold;
    public $numTickets;
    public $price;
    public $picture_url;
    public $picture_alt;


    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get event
    public function read($limit, $sort) {
        // create query
        if ($limit != null && $sort == null) {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY date DESC LIMIT ' . $limit;
        } else if($limit != null && $sort != null) {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY numTickets DESC LIMIT ' . $limit;
        } else {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY date DESC';
        }
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get single event
    public function read_single() {
        // create query
        $query = 
            'SELECT * FROM ' . $this->table . '
            WHERE 
                eventId = ?
            LIMIT 0,1';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->eventId);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->eventId = utf8_encode(html_entity_decode($row['eventId']));
        $this->title = utf8_encode(html_entity_decode($row['title']));
        $this->date = utf8_encode(html_entity_decode($row['date']));
        $this->description = utf8_encode(html_entity_decode($row['description']));
        $this->ticketsSold = utf8_encode(html_entity_decode($row['ticketsSold']));
        $this->numTickets = utf8_encode(html_entity_decode($row['numTickets']));
        $this->price = utf8_encode(html_entity_decode($row['price']));
        $this->picture_url = utf8_encode(html_entity_decode($row['picture_url']));
        $this->picture_alt = utf8_encode(html_entity_decode($row['picture_alt']));
    }

    // create event
    public function create() {
        // create query
        $query = 'INSERT INTO ' . $this->table . ' SET title = :title, date = :date, 
            description = :description, ticketsSold = :ticketsSold, numTickets = :numTickets, price = :price, 
            picture_url = :picture_url, picture_alt = :picture_alt';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = utf8_decode(htmlspecialchars(strip_tags($this->title)));
        $this->date = utf8_decode(htmlspecialchars(strip_tags($this->date)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));
        $this->ticketsSold = utf8_decode(htmlspecialchars(strip_tags($this->ticketsSold)));
        $this->numTickets = utf8_decode(htmlspecialchars(strip_tags($this->numTickets)));
        $this->price = utf8_decode(htmlspecialchars(strip_tags($this->price)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':ticketsSold', $this->ticketsSold);
        $stmt->bindParam(':numTickets', $this->numTickets);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);


        // execute query
        if ($stmt->execute()) {
            return true;
        } else {

            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update event
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET title = :title, date = :date, 
            description = :description, ticketsSold = :ticketsSold, numTickets = :numTickets, price = :price, 
            picture_url = :picture_url, picture_alt = :picture_alt
            WHERE eventId = :id
        ';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = utf8_decode(htmlspecialchars(strip_tags($this->title)));
        $this->date = utf8_decode(htmlspecialchars(strip_tags($this->date)));
        $this->description = utf8_decode(htmlspecialchars(strip_tags($this->description)));
        $this->ticketsSold = utf8_decode(htmlspecialchars(strip_tags($this->ticketsSold)));
        $this->numTickets = utf8_decode(htmlspecialchars(strip_tags($this->numTickets)));
        $this->price = utf8_decode(htmlspecialchars(strip_tags($this->price)));
        $this->picture_url = utf8_decode(htmlspecialchars(strip_tags($this->picture_url)));
        $this->picture_alt = utf8_decode(htmlspecialchars(strip_tags($this->picture_alt)));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':ticketsSold', $this->ticketsSold);
        $stmt->bindParam(':numTickets', $this->numTickets);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':picture_url', $this->picture_url);
        $stmt->bindParam(':picture_alt', $this->picture_alt);

        $stmt->bindParam(':id', $this->eventId);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE eventId= :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->eventId = utf8_decode(htmlspecialchars(strip_tags($this->eventId)));

        // Bind data
        $stmt->bindParam(':id', $this->eventId);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    public function search($search, $admin) {
        if ($admin === false) {
        $query =  "SELECT e.*, t.content FROM $this->table e INNER JOIN eventhastags h ON e.eventId = h.eventId INNER JOIN tags t ON h.tagId = t.tagId 
            WHERE MATCH (e.title, e.description) AGAINST ('*$search*' IN BOOLEAN MODE) GROUP BY e.eventId ORDER BY e.date DESC";
        } else {
            $query =  "SELECT e.*, t.content FROM $this->table e LEFT OUTER JOIN eventhastags h ON e.eventId = h.eventId LEFT OUTER JOIN tags t ON h.tagId = t.tagId 
            WHERE e.title = '$search' GROUP BY e.eventId ORDER BY e.date DESC";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

?>
