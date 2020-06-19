<?php

function createProgram($mysqli) {
    $programQuery = "CREATE TABLE `program` (
        `programId` int(11) NOT NULL AUTO_INCREMENT,
        `eventId` int(11) NOT NULL,
        `time` DATETIME NOT NULL,
        `content` varchar(255) NOT NULL,
        CONSTRAINT pk_program PRIMARY KEY (programId),
        CONSTRAINT fk_event_program FOREIGN KEY (`eventId`) REFERENCES `events`(`eventId`) ON DELETE CASCADE ON UPDATE CASCADE
    );";
    try {
        $mysqli->query($programQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $programInsertQuery = "INSERT INTO `program` (`eventId`, `time`, `content`) VALUES
    ('1', '2019-02-14 12:00:00', 'Oppstart'),('1', '2019-02-14 13:30:00', 'Pause'),('1', '2019-02-14 14:00:00', 'Diskusjon/Debatt'),
    ('2', '2019-06-28 15:00:00', 'Oppstarts konsert med resonans gruppa'),('2', '2019-06-28 15:40:00', 'Hanen stend på stabburshella'),
    ('2', '2019-06-28 16:00:00', 'Sommerkonsert med Vesoppland kammerkor'),('2', '2019-06-28 17:00:00', 'Prestegårdsliv på 1990-tallet'),
    ('2', '2019-06-28 18:00:00', 'Konsert ved countrymusiker og prestesønn Lars Kolberg'),('2', '2019-06-29 11:00:00', 'Åpning dag 2: Eva Baumane (9 år) spiller Cello'),
    ('2', '2019-06-29 12:00:00', 'Snertingdal som døråpner'),('2', '2019-06-29 13:00:00', 'Et hus for presten I Snertingdal'),
    ('2', '2019-06-29 13:00:00', 'Dokumentarfilmskaperen Anto Ligaarden'),('2', '2019-06-29 15:00:00', 'Tidsbilde: Snertingdal på 1950-tallet'),
    ('2', '2019-06-29 16:00:00', 'Grillfest'),('2', '2019-06-29 19:00:00', 'Avsluttnigskonsert med lokale godbiter'),
    ('3', '2019-08-03 17:00:00', 'Oppstart med kaffe og kaker'),('3', '2019-08-03 18:00:00', 'Kåring av det beste strikkeplagget'),('3', '2019-08-03 19:00:00', 'Avsluttningskake'),
    ('4', '2019-06-23 19:00:00', 'Oppstart dag 1'),('4', '2019-06-23 22:00:00', 'Avsluttning'),('4', '2019-06-24 19:00:00', 'Oppstart dag 2'),('4', '2019-06-24 22:00:00', 'Avsluttning'),
    ('5', '2019-07-02 08:00:00', 'Oppstart'),('5', '2019-07-02 09:00:00', 'Opplæring for store og små'),
    ('5', '2019-07-02 13:00:00', 'Avsluttning med ost og kaker');";
    try {
        $mysqli->query($programInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>