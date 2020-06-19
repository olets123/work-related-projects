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
    <link rel="stylesheet" href="../style/history.css">
    <link rel="stylesheet" href="../style/index.css">
    <script>const host = `${window.location.protocol}//${window.location.hostname}:8080`; </script>
    <title>Præstgar'n - Admin/History</title>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
        <a href="../history/history.php" class="menuBtn active">Historie</a>
        <a href="../tags/tags.php" class="menuBtn">Knagger</a>
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
                    <th>Årstall</th>
                    <th>Tittel</th>
                    <th>Beskrivelse</th>
                    <th>Bilder</th>
                    <th>Bilde beskrivelser</th>
                    <th>Bilde opphavsrett</th>
                    <th>Endre?</th>
                    <th>Slette?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <div>
        <a href="history.php?new=1">Lag nytt historie element</a>
    </div>
    <script type="text/javascript" src="./history.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="historyForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="year">årstall </label><input type="number" id="year" name="year">
            <label for="title">tittel </label><input type="text" id="title" name="title">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <fieldset id="gallery" name="gallery"></fieldset>
    

            <input type="submit" name="updateHistory" value="oppdater historie">
        </form>
        <script type="text/javascript" src="./singleHistory.js"></script>
        <script type="text/javascript" src="./HistoryClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const historyHandler = new HistoryClass(data);
                historyHandler.isLoaded = true;
                historyHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
        
    <?php } else if (isset($_GET['new'])) { ?> 
        <form onSubmit="handleFormCreate(event, this)" method="POST" id="historyForm">

            <label for="year">årstall </label><input type="number" id="year" name="year">
            <label for="title">tittel </label><input type="text" id="title" name="title">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <fieldset id="gallery" name="gallery"></fieldset>

            <input type="submit" name="createHistory" value="lag historie element">
        </form>
        <script type="text/javascript" src="./HistoryClass.js"></script>
        <script type="text/javascript" src="./newHistory.js"></script>

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