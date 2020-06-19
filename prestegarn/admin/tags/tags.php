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
    <title>Præstgar'n - Admin/Knagger</title>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
        <a href="../history/history.php" class="menuBtn">Historie</a>
        <a href="../tags/tags.php" class="menuBtn active">Knagger</a>
        <a href="../users/users.php" class="menuBtn">Brukere</a>
        <a href="../reservation/reservation.php" class="menuBtn">Reservasjoner</a>
        <a href="../admin.index.php" class="menuBtn">Tilbake</a>
    </div>
    <?php if (!isset($_GET['id']) && (!isset($_GET['new'])) && (!isset($_GET['delete']))) { ?> 
    <div>
        <table>
            <tHead>
                <tr>
                    <th>Id</th>
                    <th>Knagg</th>
                    <th>Endre?</th>
                    <th>Slett?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="./tags.js"></script>
    <div>
        <a href="tags.php?new=1">Lag ny knagg</a>
    </div>
    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="tagForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="content">knagg </label><input type="text" id="content" name="content">

            <input type="submit" name="updateTag" value="oppdater knagg">
        </form>
        <script type="text/javascript" src="./singleTag.js"></script>
        <script type="text/javascript" src="./TagClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const tagHandler = new TagClass(data);
                tagHandler.isLoaded = true;
                tagHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
        
    <?php } else if (isset($_GET['new'])) { ?> 
        <form onSubmit="handleFormCreate(event, this)" method="POST" id="tagForm">

            <label for="content">knagg </label><input type="text" id="content" name="content">

            <input type="submit" name="createTag" value="lag knagg">
        </form>
        <script type="text/javascript" src="./TagClass.js"></script>
        <script type="text/javascript" src="./newTag.js"></script>

        <script type="text/javascript" src="./formHandle/create.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>

    <?php } else if ((!isset($_GET['id'])) && (!isset($_GET['new'])) && (isset($_GET['delete']))) { ?>
        <script>
            const id = <?php echo $_GET['delete']; ?>;
        </script>
        <div id="messageDiv"></div>
        <script type="text/javascript" src="./formHandle/delete.js"></script>

    <?php } ?>
</body>
</html>


<?php



?>