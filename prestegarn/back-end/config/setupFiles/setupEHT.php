<?php

function createEHT($mysqli) {
    $tagsQuery = "CREATE TABLE `eventhastags` (
        `eventId` INT(11) NOT NULL,
        `tagId` INT(11) NOT NULL,
        CONSTRAINT pk_EHT PRIMARY KEY (`tagId`, `eventId`),
        CONSTRAINT `fk_event_EHT` FOREIGN KEY (`eventId`) REFERENCES `events`(`eventId`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_tags_EHT` FOREIGN KEY (`tagId`) REFERENCES `tags`(`tagId`) ON DELETE CASCADE ON UPDATE CASCADE
    );";
    try {
        $mysqli->query($tagsQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $tagsInsertQuery = "INSERT INTO `eventhastags` (`eventId`, `tagId`)  VALUES
        (1, 3),
        (2, 3), (2, 1), (2, 4),
        (3, 1), (3, 2),
        (4, 3),
        (5, 1), (5, 2);
    ";
    try {
        $mysqli->query($tagsInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>