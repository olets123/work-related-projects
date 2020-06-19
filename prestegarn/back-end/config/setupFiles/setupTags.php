<?php

function createTags($mysqli) {
    $tagsQuery = "CREATE TABLE `tags` (
        `tagId` INT(11) NOT NULL AUTO_INCREMENT,
        `content` varchar(255) NOT NULL,
        CONSTRAINT pk_tags PRIMARY KEY (`tagId`),
        UNIQUE KEY (`content`)
    );";
    try {
        $mysqli->query($tagsQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $tagsInsertQuery = "INSERT INTO `tags` (`content`)  VALUES
        ('mat'),
        ('kos'),
        ('konsert'),
        ('festival');
    ";
    try {
        $mysqli->query($tagsInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
    
    // add fulltext index for searching and filtering
    $eventIndex = "ALTER TABLE tags ADD FULLTEXT KEY ft_tags (content);";
    try {
        $mysqli->query($eventIndex);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    } 
}

?>