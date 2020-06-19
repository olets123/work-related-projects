<?php

function createReservations($mysqli) {
    $reservationQuery = "CREATE TABLE `reservations` (
        `reservationId` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `eventType` varchar(255) NOT NULL,
        `mobile` varchar(255) NOT NULL,
        `quantity` int(11) NOT NULL,
        `fromDate` date NOT NULL,
        `toDate` date NOT NULL,
        `accepted` tinyint(1) default 0,
        CONSTRAINT pk_program PRIMARY KEY (reservationId)
    );";
    try {
        $mysqli->query($reservationQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $reservationInsertQuery = "INSERT INTO `reservations` 
        (`name`, `email`, `eventType`, `mobile`, `quantity`, `fromDate`, `toDate`) VALUES ('12314', 'e@gmail.com', 'asdfawes', '+12345123', '2', '2019-06-02', '2019-06-06');";
    try {
        $mysqli->query($reservationInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>