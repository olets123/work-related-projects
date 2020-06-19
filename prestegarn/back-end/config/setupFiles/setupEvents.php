<?php

function createEvents ($mysqli) {
    // create event table
    $eventQuery = "CREATE TABLE `events` (
        `eventId` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `date` date NOT NULL,
        `description` varchar(255) NOT NULL,
        `ticketsSold` int(11) DEFAULT 0,
        `numTickets` int(11) NOT NULL,
        `price` int(11) NOT NULL,
        `picture_url` varchar(255) NOT NULL,
        `picture_alt` varchar(255) NOT NULL,
        CONSTRAINT pk_events PRIMARY KEY (eventId)
      )";
    try {
        $mysqli->query($eventQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    // insert events 
    $eventInsertQuery = "INSERT INTO `events` 
        (`title`, `date`, `description`,  `ticketsSold`, `numTickets`, `price`, 
            `picture_url`, `picture_alt`) VALUES
    ('Norge nå', '2019-02-14', 'Event 1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, 
        iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.', 
        0, 150, 150, 'inniPrestegarn01.jpg', 'mennesker i fart'),
    ('Grønske', '2019-06-28', 'Event 2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, 
        usto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.', 
        0, 200, 150, 'meieri.jpg', 'mennesker på grønskefestivalen'),
    ('Strikkekveld', '2019-08-03', 'Event 3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, 
        iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.', 
        4, 30, 0, 'anita01.jpg', 'strikkegruppa smiler mot kameraet'),
    ('Resonans', '2019-06-23', 'Event 5 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, 
        iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.', 
        100, 400, 100, 'anitaHans01.jpg', 'resonans gruppa smiler mot kameraet'),
    ('Kumelking', '2019-07-02', 'Event 4 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, 
        iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.', 
        200, 400, 100, 'meieri.jpg', 'Hans Olav Brenner melker en ku');
   ;";
    
    try {
        $mysqli->query($eventInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    // add fulltext index for searching and filtering
    $eventIndex = "ALTER TABLE events ADD FULLTEXT KEY ft_events (title, description);";
    try {
        $mysqli->query($eventIndex);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    } 
}

?>