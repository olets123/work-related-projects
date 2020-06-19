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
    <title>Præstgar'n - Admin/Om oss</title>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn active">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
        <a href="../history/history.php" class="menuBtn">Historie</a>
        <a href="../tags/tags.php" class="menuBtn">Knagger</a>
        <a href="../users/users.php" class="menuBtn">Brukere</a>
        <a href="../reservation/reservation.php" class="menuBtn">Reservasjoner</a>
        <a href="../admin.index.php" class="menuBtn">Tilbake</a>
    </div>
    <?php if (!isset($_GET['id'])) { ?> 
    <div class="contentDiv">
        <table>
            <tHead>
                <tr>
                    <th class="id">Id</th>
                    <th class="hansContent">Hans bio</th>
                    <th class="anitaContent">Anita bio</th>
                    <th class="mainContent">Hovedinnhold</th>
                    <th class="anitaPicture_url">Bilde av Anita</th>
                    <th class="anitaPicture_alt">Anitas bildebeskrivelse</th>
                    <th class="hansPicture_url">Bilde av Hans Olav</th>
                    <th class="hansPicture_alt">Hans Olavs bildebeskrivelse</th>
                    <th class="mainPicture_url">Hovedbilde</th>
                    <th class="mainPicture_alt">hovedbildebeskrivelse</th>
                    <th>Endre?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="./about.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="aboutForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="hansContent">Hans Bio</label> <textarea name="hansContent" id="hansContent" cols="30" rows="10"></textarea>
            <label for="anitaContent">Anita Bio</label> <textarea name="anitaContent" id="anitaContent" cols="30" rows="10"></textarea>
            <label for="mainContent">Hovedinnhold</label> <textarea name="mainContent" id="mainContent" cols="60" rows="20"></textarea>
            <label for="anitaPicture_url">Bilde av Anita</label> <input type="text" name="anitaPicture_url" id="anitaPicture_url"/>
            <label for="anitaPicture_alt">Anita bildebeskrivelse</label> <input type="text" name="anitaPicture_alt" id="anitaPicture_alt"/>
            <label for="hansPicture_url">Bilde av Hans Olav</label> <input type="text" name="hansPicture_url" id="hansPicture_url"/>
            <label for="hansPicture_alt">Hans Olavs bildebeskrivelse</label> <input type="text" name="hansPicture_alt" id="hansPicture_alt"/>
            <label for="mainPicture_url">Hovedbilde</label> <input type="text" name="mainPicture_url" id="mainPicture_url"/>
            <label for="mainPicture_alt">Hovedbildebeskrivelse</label> <input type="text" name="mainPicture_alt" id="mainPicture_alt"/>
            <input type="submit" name="updateAbout" value="oppdater om oss">
        </form>
        <script type="text/javascript" src="./singleAbout.js"></script>
        <script type="text/javascript" src="./AboutClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const aboutHandler = new AboutClass(data);
                aboutHandler.isLoaded = true;
                aboutHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
    <?php } ?>
</body>
</html>


<?php



?>