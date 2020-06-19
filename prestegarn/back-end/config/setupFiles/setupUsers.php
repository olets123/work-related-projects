<?php

function createUsers($mysqli) {
    
    $userQuery = "CREATE TABLE `users` (
        `username` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        CONSTRAINT pk_users PRIMARY KEY (username)
    );";
    try {
        $mysqli->query($userQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $userInsertQuery = "INSERT INTO `users` (`username`, `password`) VALUES
    ('admin', '2c1050ed652eeb91d3db4e1153c367a2');";
    try {
        $mysqli->query($userInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

}

?>