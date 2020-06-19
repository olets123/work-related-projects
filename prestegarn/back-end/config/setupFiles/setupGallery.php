<?php

function createGallery ($mysqli) {
    $galleryQuery = "CREATE TABLE `gallery` (
        `galleryId` INT(11) NOT NULL AUTO_INCREMENT,
        `timeId` int(11) NOT NULL,
        `picture_url` varchar(255) NOT NULL,
        `picture_alt` varchar(255) NOT NULL,
        `copyright` varchar(255),
        CONSTRAINT pk_gallery PRIMARY KEY (`galleryId`),
        CONSTRAINT fk_history_gallery FOREIGN KEY (`timeId`) REFERENCES `history`(`timeId`) ON UPDATE CASCADE ON DELETE CASCADE
    );";
    try {
        $mysqli->query($galleryQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
    $galleryInsertQuery = "INSERT INTO `gallery` (`timeId`, `picture_url`, `picture_alt`, `copyright`)  VALUES
        (1, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (1, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (1, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (2, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (2, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (2, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (3, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (3, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (3, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (3, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (4, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (4, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (4, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (4, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (4, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'),
        (5, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (5, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (5, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (5, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (5, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'),
        (6, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (6, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019'), 
        (6, 'oldPrestegarn01.jpg', 'prestefamilien flytter inn', 'snertingdal museum - 2019'), 
        (6, 'prestegarn01-sepia.jpg', 'bilde av gården', 'snertingdal museum - 2019'), 
        (6, 'bukkendeBruse01-sepia.jpg', 'bilde av broen fra eventyret de tre bukkende bruse', 'snertingdal museum - 2019');
    ";
    try {
        $mysqli->query($galleryInsertQuery);
    } catch (\Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
}

?>