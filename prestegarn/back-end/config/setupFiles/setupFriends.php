<?php

function createFriends($mysqli) {
    $sponsorQuery = "CREATE TABLE `friends` (
        `friendId` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `facebookLink` varchar(255),
        `instagramLink` varchar(255),
        `email` varchar(255) NOT NULL,
        `picture_url` varchar(255) DEFAULT NULL,
        `picture_alt` varchar(255) NOT NULL,
        `contact_phone` int(20),
        `contact_name` varchar(255),
        CONSTRAINT pk_friends PRIMARY KEY (friendId)
    );";
    try {
        $mysqli->query($sponsorQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $sponsorInsertQuery = "INSERT INTO `friends` (`name`, `description`, `facebookLink`, `instagramLink`, `email`, `picture_url`, `picture_alt`, `contact_phone`, `contact_name`) VALUES
    ('Kyr og CO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facilis, magni rerum ratione delectus quae quos sed molestiae reprehenderit vero, deserunt porro! Ipsum reprehenderit, consequatur ut ipsa incidunt veniam perferendis.', 'https://www.facebook.com/snertingdalprestegaard/', 'https://www.instagram.com/praestgarden/', 'prestgarn@gmail.com', 'friend1logo.png', 'venn1 logo vises her', '12345678', 'Ola Nordmann'),
    ('Griser og CO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facilis, magni rerum ratione delectus quae quos sed molestiae reprehenderit vero, deserunt porro! Ipsum reprehenderit, consequatur ut ipsa incidunt veniam perferendis.', 'https://www.facebook.com/snertingdalprestegaard/', 'https://www.instagram.com/praestgarden/', 'prestgarn@gmail.com', 'friend2logo.png', 'venn2 logo vises her', '87654321', 'Kari Sørdame'),
    ('Sauer og CO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facilis, magni rerum ratione delectus quae quos sed molestiae reprehenderit vero, deserunt porro! Ipsum reprehenderit, consequatur ut ipsa incidunt veniam perferendis.', 'https://www.facebook.com/snertingdalprestegaard/', 'https://www.instagram.com/praestgarden/', 'prestgarn@gmail.com', 'friend3logo.png', 'venn3 logo vises her', '12345678', 'Ola Nordmann'),
    ('Poteter og CO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facilis, magni rerum ratione delectus quae quos sed molestiae reprehenderit vero, deserunt porro! Ipsum reprehenderit, consequatur ut ipsa incidunt veniam perferendis.', 'https://www.facebook.com/snertingdalprestegaard/', 'https://www.instagram.com/praestgarden/', 'prestgarn@gmail.com', 'friend4logo.png', 'venn4 logo vises her', '87654321', 'Kari Sørdame'),
    ('Elger og CO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facilis, magni rerum ratione delectus quae quos sed molestiae reprehenderit vero, deserunt porro! Ipsum reprehenderit, consequatur ut ipsa incidunt veniam perferendis.', 'https://www.facebook.com/snertingdalprestegaard/', 'https://www.instagram.com/praestgarden/', 'prestgarn@gmail.com', 'friend5logo.png', 'venn5 logo vises her', '12345678', 'Ola Nordmann')";
    try {
        $mysqli->query($sponsorInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}
?>