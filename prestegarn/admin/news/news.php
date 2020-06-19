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
    <link rel="stylesheet" href="../style/news.css">
    <link rel="stylesheet" href="../style/index.css">
    <script>const host = `${window.location.protocol}//${window.location.hostname}:8080`; </script>
    <title>Præstgar'n - Admin/Nyheter</title>
</head>
<body>

<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn active">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
        <a href="../history/history.php" class="menuBtn">Historie</a>
        <a href="../tags/tags.php" class="menuBtn">Knagger</a>
        <a href="../users/users.php" class="menuBtn">Brukere</a>
        <a href="../reservation/reservation.php" class="menuBtn">Reservasjoner</a>
        <a href="../admin.index.php" class="menuBtn">Tilbake</a>
    </div>
    <?php if (!isset($_GET['id'])) { ?> 
    <div>
        <table>
            <tHead>
                <tr>
                    <th>Id</th>
                    <th>Innhold</th>
                    <th>Endre?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="./news.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="newsForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="content">Innhold </label> <textarea name="content" id="content" cols="30" rows="10"></textarea>
            <input type="submit" name="updateNews" value="oppdater nyhet">

        </form>
        <script type="text/javascript" src="./singleNews.js"></script>
        <script type="text/javascript" src="./NewsClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const newsHandler = new NewsClass(data);
                newsHandler.isLoaded = true;
                newsHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
    <?php } ?>
</body>
</html>
