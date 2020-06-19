<?php 
// connect with the database.
$database = new Database();
$db = $database->connect();

// select all from table topics.  
$query = "SELECT * FROM `topics`";
$db->prepare($query);
$result = $db->query($query);

// if result is result is bigger than zero(0), select all from tables entries.
if ($result->rowCount() > 0) { 
    $entryArr = array();
    $entryQuery = "SELECT * FROM `entries`";
    $db->prepare($entryQuery);
    $entryResult = $db->query($entryQuery);
    // fetch results from entry and push results in rows through an array.
    while($eRow = $entryResult->fetch()) {
        array_push($entryArr, array($eRow['entriesID'], $eRow[3], $eRow['Headline'], $eRow['information'], $eRow['createdBy']));
    }
    // make an div
    echo '<div>';
    // fetch results from row and define objects.
    while($row = $result->fetch()) {
        $topicId = $row['topicID'];
        $title = $row['Headline'];
        $desc = $row['Information'];
        $createdBy = $row['createdBy'];
        // make an div to display the topics that are created to the HTML page.
        echo "<div>
        <h2 class='topicTitle'>$title</h2>
        <p>$desc</p>
        <span>$createdBy</span>
        <h3>Entries: </h3>";
        foreach($entryArr as $e) {
            if ($e[1] === $topicId) {
                echo "<div><h4>". $e[2] ."</h4>
                    <p>" . $e[3] ."</p>
                    <span>" . $e[4] .  "</span>
                    <a href='index.php?deleteEntries=". $e[0] ."'>Delete entry</a>
                    </div>";
            }
        }
        echo "<a href='index.php?deleteTopics=". $topicId ."'>Delete topic</a></div>";
    }
    echo "</div>";
    // if no topics are found, display message: 'no topics found'.
} else {
    echo '<p> no topics found </p>';
}


?>
