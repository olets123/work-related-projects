<?php 

function createNews ($mysqli) {
    $newsQuery = "CREATE TABLE `news` (
        `newsId` INT(11) NOT NULL AUTO_INCREMENT,
        `content` text NOT NULL,
        CONSTRAINT pk_news PRIMARY KEY (`newsId`)
    );";
    try {
        $mysqli->query($newsQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $newsInsertQuery = "INSERT INTO `news` (`content`)  VALUES
        ('Høsten 2017 kjøpte Hans Olav Brenner og Anita Krohn Traaseth
        prestegården i Snertingdal. Stedet drives nå som et flerbrukshus
        med både kulturarrangementer, utleie, med mer.
        Præstgarn har en godt dokumentert historie, og denne kan du også oppleve på dette nettstedet.'),
        ('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laudantium labore quam corporis molestias doloribus at fuga sapiente autem quas, error veritatis veniam perspiciatis voluptate aperiam et aspernatur aut similique.'),
        ('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laudantium labore quam corporis molestias doloribus at fuga sapiente autem quas, error veritatis veniam perspiciatis voluptate aperiam et aspernatur aut similique.'),
        ('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laudantium labore quam corporis molestias doloribus at fuga sapiente autem quas, error veritatis veniam perspiciatis voluptate aperiam et aspernatur aut similique.');
    ";
    try {
        $mysqli->query($newsInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
} 

?>