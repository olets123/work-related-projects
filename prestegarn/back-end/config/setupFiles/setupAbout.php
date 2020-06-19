<?php

function createAbout ($mysqli) {
    $aboutQuery = "CREATE TABLE `about` (
        `aboutId` INT(11) NOT NULL AUTO_INCREMENT,
        `hansContent` text NOT NULL,
        `anitaContent` text NOT NULL,
        `mainContent` text NOT NULL,
        `anitaPicture_url` varchar(255) NOT NULL,
        `anitaPicture_alt` varchar(255) NOT NULL,
        `hansPicture_url` varchar(255) NOT NULL,
        `hansPicture_alt` varchar(255) NOT NULL,
        `mainPicture_url` varchar(255) NOT NULL,
        `mainPicture_alt` varchar(255) NOT NULL,
        CONSTRAINT pk_about PRIMARY KEY (`aboutId`)
    );";
    try {
        $mysqli->query($aboutQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }

    $aboutInsertQuery = "INSERT INTO `about` (`hansContent`, `anitaContent`, `mainContent`, `anitaPicture_url`, 
                `anitaPicture_alt`, `hansPicture_url`, `hansPicture_alt`, `mainPicture_url`, `mainPicture_alt`)  
        VALUES
            ('HANS: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laudantium labore quam corporis molestias doloribus fuga sapiente autem quas, error veritatis veniam perspiciatis voluptate aperiam et aspernatur aut similique.', 
            'ANITA: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laudantium labore quam corporis molestias doloribus fuga sapiente autem quas, error veritatis veniam perspiciatis voluptate aperiam et aspernatur aut similique.', 
            'MAIN: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rutrum massa turpis, sed feugiat metus viverra ut. Fusce bibendum mi efficitur consequat blandit. Nunc vel sem tincidunt, blandit leo ac, condimentum diam. Suspendisse efficitur auctor libero, a congue velit molestie sit amet. Donec luctus tristique tellus, nec lobortis libero mattis sed. Donec in luctus lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut tortor elit, imperdiet vitae purus sed, pulvinar rhoncus diam.
            vitae purus sed, pulvinar rhoncus diam. Vivamus elementum scelerisque facilisis. Integer sed turpis facilisis arcu ullamcorper ultrices. Pellentesque commodo erat in elit placerat, sit amet convallis mi consequat. Integer cursus volutpat purus ultrices sagittis. Etiam at elit velit. Duis tristique, augue gravida semper egestas, elit felis tincidunt libero, sit amet pulvinar enim urna tincidunt urna. Aliquam in mauris vehicula, sollicitudin arcu in, congue lectus. Suspendisse sapien purus, rutrum vitae eros nec, auctor semper justo.
            utrum vitae eros nec, auctor semper justo. Praesent enim dui, efficitur id dolor quis, accumsan pulvinar ligula. Donec at dui a leo scelerisque luctus et ac erat. Aenean malesuada et magna sed interdum. Quisque dignissim ultricies massa a venenatis. Fusce enim est, ornare eget ultricies id, mattis eget quam. Sed neque neque, vehicula quis rhoncus a, eleifend vel erat. Aenean euismod vehicula dui sed vehicula. Mauris nec bibendum ex. Quisque suscipit porttitor dapibus. Pellentesque nisi risus, eleifend sit amet iaculis in, commodo ac tellus.
            eifend sit amet iaculis in, commodo ac tellus. Praesent eget nisl at ipsum malesuada tincidunt in eget sem. Vivamus pulvinar elit at ornare malesuada. Curabitur at enim sodales, iaculis augue quis, imperdiet purus. Nulla ut leo purus. Nullam vitae finibus erat. Donec sit amet dui vitae lorem ultricies cursus quis vel arcu. Duis aliquam urna ac pellentesque porta. Aenean efficitur urna et est rutrum, in vehicula enim luctus. Sed eros felis, venenatis non orci eget, ultrices maximus massa. Aenean sit amet fringilla risus, vitae elementum nisl.',
            'anita02.jpg', 'Anita Krohn Traaseth', 'hansOlav03.jpg', 'Hans Olav Brenner', 'anitaHans02.jpg', 'Anita til høyre og Hans til venstre')";
    try {
        $mysqli->query($aboutInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
} 

?>