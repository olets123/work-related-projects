<?php
// include the database class.
include('./classes/database.php');

// Start session
session_start();

// connect the database.
$database = new Database();
$db = $database->connect();

// Login through forms and check if the username and password
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // hash the password
    $password = md5($password);
    $userArr = array();
    // the same username and password can only occure one time.
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='$password' LIMIT 1;";
    $result = $db->query($query);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                array_push($userArr, array($row['username'], $row['type']));
            }
            // show the user that the user is logged in and send back to index.php.
            $user = $userArr[0];
            $_SESSION['user'] = $user[0];
            $_SESSION['uType'] = $user[1];
            $_SESSION['success'] = 'logged in';
            header('Location: index.php');
        }
}
// if user logged out, send user back to index.php (mainpage).
if (isset($_GET['logout'])) {
    $server->session_destroy();
    header("location: index.php");
}


// Create a user through register form.
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = $_POST['confirm_password'];
    // check if the users and passwords are equal.
    if (!empty($username) && !empty($password1) && !empty($password2)) {
        // if equal hash password.
        if ($password1 === $password2) {
            $error = false;
            $password = md5($password1);
            // if not equal, give error.
        } else {
            $error = true;
        }
    } else { $error = true; }
    // hash the password
    $password = md5($password);
     // The same username and password is just allowed to use one time. 
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='$password' LIMIT 1;";
    $db->prepare($query);
    $result = $db->query($query);
    if ($error == false) {
        if($result->rowCount() > 0){
        } else {
        // SQL query for where to insert the information from the input fields in the registration form.            
            $insertQuery = "INSERT INTO `users` (username, password) VALUES ('$username', '$password');";
            $insertResult = $db->query($insertQuery);
            if ($insertResult) {
                $_SESSION['user'] = $username;
                $_SESSION['uType'] = 'author';
                // if logged in send message succsess and send back to index.php.
                $_SESSION['success'] = 'logged in';
                header('Location: index.php');
            }
        }
    }
}

// Creates topics from the text that is typed in the form.
if (isset($_POST['createTopic'])) {
    if (isset($_SESSION['user'])) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $createdBy = $_SESSION['user'];
        // if the title, description  is empty, call an error
        if (!empty($title) && !empty($desc)) { $error = false; } else { $error = true; }
        if ($error == false) {
            // SQL query for where to insert the information based from the input fields in topics
            $topicQuery = "INSERT INTO `topics` (Headline, Information, createdBy) VALUES ('$title', '$desc', '$createdBy');";
            $db->prepare($topicQuery);
            $insertResult = $db->query($topicQuery);
            if ($insertResult) {
                $_SESSION['success'] = 'Topic Created';
                header('Location: index.php');
            }
        }
        // If not logged in, you can't create topics.
    } else {
        $_SESSION['success'] = 'must be logged in to create topics';
        header('Location: index.php');
    }
}

// Creates entries from the text in the form.
if (isset($_POST['createEntry'])) {
    if (isset($_SESSION['user'])) {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $topicId = $_POST['topic'];
        $createdBy = $_SESSION['user'];
        // if the title, description and topicId is empty, call an error
        if (!empty($title) && !empty($desc) && !empty($topicId)) { $error = false; } else { $error = true; }
        if ($error == false) {
            // SQL query for where to insert the information from the input fields
            $entryQuery = "INSERT INTO `entries` (Headline, Information, topicID, createdBy) VALUES ('$title', '$desc', '$topicId', '$createdBy');";
            $db->prepare($entryQuery);
            $insertResult = $db->query($entryQuery);
            // if success with creating an entry, display that an entry is created. 
            if ($insertResult) {
                $_SESSION['success'] = 'Entry Created';
                header('Location: index.php');
            }
        }
        // If not logged in, you can't create an entry.  
    } else {
        $_SESSION['success'] = 'must be logged in to create Entry';
        header('Location: index.php');
    }
}

// Delete topics that was created.
if (isset($_GET['deleteTopics'])) {
    $deleteID = $_GET['deleteTopics'];
    if (isset($_SESSION['user'])) {
        $deleteQuery = "DELETE FROM `topics` WHERE topicID ='$deleteID'";
        $db->prepare($deleteQuery);
        $deleteResult = $db->query($deleteQuery);
        // if topic deleted, send message for topic deleted.
        if ($deleteResult) {
            $_SESSION['success'] = 'topic deleted';
            header('Location: index.php');
        }
        // If not logged in, you can't deleted.
    } else {
        $_SESSION['success'] = 'must be logged in to delete';
        // send to index.php
        header('Location: index.php');
    }
}

// Delete entries that was created.
if (isset($_GET['deleteEntries'])) {
    $deleteID = $_GET['deleteEntries'];
    if (isset($_SESSION['user'])) {
        $deleteQuery = "DELETE FROM `entries` WHERE entriesID ='$deleteID'";
        $db->prepare($deleteQuery);
        $deleteResult = $db->query($deleteQuery);
        // if the entry is deleted, send a message 'entry deleted'.
        if ($deleteResult) {
            $_SESSION['success'] = 'entry deleted';
            header('Location: index.php');
        }
        // If not logged in, you can't delete entries. 
    } else {
        $_SESSION['success'] = 'must be logged in to delete';
        // send to index.php
        header('Location: index.php');
    }
}

?> 