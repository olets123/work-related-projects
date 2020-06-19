<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../admin.index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/index.css">
    <script>const host = `${window.location.protocol}//${window.location.hostname}:8080`; </script>
    <title>Præstgar'n - Admin/Brukere</title>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
        <a href="../history/history.php" class="menuBtn">Historie</a>
        <a href="../tags/tags.php" class="menuBtn">Knagger</a>
        <a href="../users/users.php" class="menuBtn active">Brukere</a>
        <a href="../reservation/reservation.php" class="menuBtn">Reservasjoner</a>
        <a href="../admin.index.php" class="menuBtn">Tilbake</a>
    </div>
    <div>
        <table>
            <tHead>
                <tr>
                    <th>Username</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="./users.js"></script>
</body>
</html>


<?php



?>