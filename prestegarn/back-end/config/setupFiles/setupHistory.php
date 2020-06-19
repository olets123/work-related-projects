<?php

function createHistory($mysqli) {
    $historyQuery = "CREATE TABLE `history` (
        `timeId` int(11) NOT NULL AUTO_INCREMENT,
        `year` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `description` text NOT NULL,
        CONSTRAINT pk_history PRIMARY KEY (timeId),
        CONSTRAINT year_unique UNIQUE (year)
    );";
    try {
        $mysqli->query($historyQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $historyInsertQuery = "INSERT INTO `history` (`year`, `title`, `description`) VALUES
    ('1821', 'prestefamilien flytter inn', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.'),
    ('1841', 'brann i kirka', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.'),
    ('1851', 'Ny kirke', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.'),
    ('1861', 'Snertingdals nye prestefamile', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.'),
    ('1902', 'Gården får kyr og okser', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.'),
    ('1921', 'Hest er best', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Ea esse dolor perferendis reprehenderit reiciendis dolorem repellat assumenda, iusto ut illo veniam recusandae odio culpa cupiditate eligendi ab similique natus? Saepe.');
    ";
    try {
        $mysqli->query($historyInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
    
    // add fulltext index for searching and filtering
    $historyFulltext = "ALTER TABLE history ADD FULLTEXT KEY ft_history (title, description);";
    try {
        $mysqli->query($historyFulltext);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    // add index for searching and filtering with year
    $historyFulltext = "ALTER TABLE history ADD INDEX i_history (year);";
    try {
        $mysqli->query($historyFulltext);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>