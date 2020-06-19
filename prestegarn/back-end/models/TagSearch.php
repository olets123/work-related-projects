<?php

class TagSearch {
    // DB stuff
    private $conn;
    private $table = 'tags';

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

    // tag properties
    public $tagId;
    public $content;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    public function search($search, $admin = false) {
        if ($admin === false) {
            $query =  "SELECT e.*, t.content, t.tagId FROM $this->table t INNER JOIN eventhastags h ON t.tagId = h.tagId INNER JOIN events e ON h.eventId = e.eventId WHERE MATCH (t.content) AGAINST ('*$search*' IN BOOLEAN MODE) ORDER BY e.date DESC";
        } else {
            $query =  "SELECT t.tagId, t.content, e.* from tags t LEFT OUTER JOIN eventhastags h ON t.tagId = h.tagId LEFT OUTER JOIN events e on h.eventId = e.eventId WHERE t.content = '$search'";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

?>

