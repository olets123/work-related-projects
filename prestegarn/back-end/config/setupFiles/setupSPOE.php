<?php 

function createSPOE ($mysqli) {
    $spoeQuery = "CREATE TABLE `friendspartofevents` (
        `eventId` int(11) NOT NULL,
        `friendId` int(11) NOT NULL,
        CONSTRAINT pk_spoe PRIMARY KEY (eventId, friendId),
        CONSTRAINT `fk_event_partOf` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventId`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_friends_partOf` FOREIGN KEY (`friendId`) REFERENCES `friends` (`friendId`) ON DELETE CASCADE ON UPDATE CASCADE
    );";
    try {
        $mysqli->query($spoeQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $spoeInsertQuery = "INSERT INTO `friendspartofevents` (`eventId`, `friendId`) VALUES
    (1, 1),
    (1, 2),
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 4),
    (2, 5),
    (3, 4),
    (3, 2),
    (4, 2),
    (5, 1),
    (5, 2);";
    try {
        $mysqli->query($spoeInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}
?>