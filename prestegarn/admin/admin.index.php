<?php 
include('server.php'); 
// password prestgarn
/* if (isset($_GET['logout'])) {     
    session_destroy();
    unset($_SESSION['username']);
    header('location: admin.index.php'); 
} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/index.css">
    <title>Præstgar'n - Admin/Home</title>
</head>
<body>
    <?php if (!isset($_SESSION['username'])) { ?>
    <div class="contentDiv">
    <h1>Admin Login</h1>
        <form action="admin.index.php" method="post">
            <label for="username">Brukernavn: </label><input type="text" name="username">
            <label for="password">Passord: </label><input type="password" name="password">
            <input type="submit" name="login" value="login">
        </form>
    </div>
    <?php } ?>

    <?php if(isset($_SESSION['username'])) { ?>
        <div class="menuDiv">
            <a href="./news/news.php" class="menuBtn">Nyheter</a>
            <a href="./about/about.php" class="menuBtn">Om oss</a>
            <a href="./event/events.php" class="menuBtn">Arrangementer</a>
            <a href="./friends/friends.php" class="menuBtn">Våre venner</a>
            <a href="./history/history.php" class="menuBtn">Historie</a>
            <a href="./tags/tags.php" class="menuBtn">Knagger</a>
            <a href="./users/users.php" class="menuBtn">Brukere</a>
            <a href="./reservation/reservation.php" class="menuBtn">Reservasjoner</a>
            <a href="admin.index.php?logout='1'" class="menuBtn logout">logout</a>
        </div>
        <div class="contentDiv">
            <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
            <?php if(isset($_SESSION['success'])) { ?>
                <p><?php echo $_SESSION['success']; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

</body>
</html>