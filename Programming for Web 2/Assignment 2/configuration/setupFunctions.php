<?php

/* SetupFunctions.php contains functions to create tables for
 users, topics and entries in phpmyadmin. */

// Create table users
function createUsers($mysqli) {
    // Query for the table, adds also Primary key to username.
    $userQuery = "CREATE TABLE `users` (
        `username` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `type`  varchar(255) DEFAULT 'author',
        CONSTRAINT pk_users PRIMARY KEY (username)
    );";
    try {
        $mysqli->query($userQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $userInsertQuery = "INSERT INTO `users` (`username`, `password`, `type`) VALUES
    ('admin', 'e3afed0047b08059d0fada10f400c1e5', 'admin');";
    try {
        $mysqli->query($userInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

}

// Create table topics
function createTopics($mysqli) {
    // Make a query for the database, to create a table that contains Primary key and foreign key,
    // also added 'ON UPDATE ON CASCADE ON DELETE CASCADE', it UPDATES or DELETE the parent, the change is cascaded to the child.
    $topicsQuery = "CREATE TABLE `topics` (
        `topicID` int(11) NOT NULL AUTO_INCREMENT,
        `Headline` varchar(255) NOT NULL,
        `Information` varchar(255) DEFAULT NULL,
        `createdBy` varchar(255) NOT NULL,
        CONSTRAINT pk_topics PRIMARY KEY (topicID),
        CONSTRAINT `user created by` FOREIGN KEY (`createdBy`) REFERENCES `users` (`username`) ON UPDATE CASCADE ON DELETE CASCADE
    );";
    try {
        $mysqli->query($topicsQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }   
}

// Create table for entries
function createEntries($mysqli) {
    // Query for the last table to create a table that contains Primary key and Foreign key,
    // also added 'ON UPDATE ON CASCADE ON DELETE CASCADE', it UPDATES or DELETE the parent, the change is cascaded to the child.
    $entriesQuery = "CREATE TABLE `entries` (
        `entriesID` int(11) NOT NULL AUTO_INCREMENT,
        `Headline` varchar(255) NOT NULL,
        `information` varchar(255) NOT NULL,
        `topicID` int(11) NOT NULL,
        `createdBy` varchar(255) NOT NULL,
        CONSTRAINT pk_entries PRIMARY KEY (entriesID),
        CONSTRAINT `created by user` FOREIGN KEY (`createdBy`) REFERENCES `users` (`username`) ON UPDATE CASCADE ON DELETE CASCADE,
        CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `topics` (`topicID`) ON UPDATE CASCADE ON DELETE CASCADE
    );";
    try {
        $mysqli->query($entriesQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>