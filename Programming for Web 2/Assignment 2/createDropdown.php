<?php
// SQL statement selects 'topicID' and 'Headline' from table 'topics'
$query = "SELECT topicID, Headline FROM `topics`";
// prepared statement
$db->prepare($query);
$result = $db->query($query);
// if the result is bigger than 0, make a dropdown with all values that contains with $ID and $title
if($result->rowCount() > 0){
    echo '<select name="topic">';
    while($row = $result->fetch()){
        $ID = $row['topicID'];
        $title = $row['Headline'];
        echo "<option value='$ID'>$title</option>";
    }
    echo '</select>';
    // if no topics created, message to the user to create topics before entries
} else {
    echo '<p>Create topics before creating entries</p>';
    // click to create topic
    echo '<a href="topicCreate.php">Create Topic</a>';
}

?>