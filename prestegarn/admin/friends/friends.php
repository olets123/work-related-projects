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
    <title>Præstgar'n - Admin/Våre venner</title>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn active">Våre venner</a>
        <a href="../history/history.php" class="menuBtn">Historie</a>
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
                    <th>Navn</th>
                    <th>Beskrivelse</th>
                    <th>Kontaktperson</th>
                    <th>Kontaktperson Tlf</th>
                    <th>Epost</th>
                    <th>Facebook link</th>
                    <th>Instagram link</th>
                    <th>Bilde link</th>
                    <th>Bilde beskrivelse</th>
                    <th>Endre?</th>
                    <th>Slette?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <div>
        <a href="friends.php?new=1">Legg til ny venn</a>
    </div>
    <script type="text/javascript" src="./friends.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="friendForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="name">Navn </label><input type="text" id="name" name="name">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <label for="contact_name">Kontaktperson </label><input type="text" id="contact_name" name="contact_name">
            <label for="contact_phone">Kontaktperson Tlf </label><input type="tel" id="contact_phone" name="contact_phone">
            <label for="email">Epost </label><input type="email" id="email" name="email">

            <label for="facebookLink">Facebook link </label><input type="text" id="facebookLink" name="facebookLink">
            <label for="instagramLink">Instagram link </label><input type="text" id="instagramLink" name="instagramLink">
            <label for="picture_url">Bilde link </label><input name="picture_url" id="picture_url" />
            <label for="picture_alt">Bilde beskrivelse </label> <textarea name="picture_alt" id="picture_alt" cols="30" rows="10"></textarea>
            
            <input type="submit" name="updateFriend" value="oppdater venn">
        </form>
        <script type="text/javascript" src="./singleFriend.js"></script>
        <script type="text/javascript" src="./FriendClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const friendHandler = new FriendClass(data[0]);
                friendHandler.isLoaded = true;
                friendHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
        
    <?php } else if (isset($_GET['new'])) { ?> 
        <form onSubmit="handleFormCreate(event, this)" method="POST" id="friendForm">

            <label for="name">Navn </label><input type="text" id="name" name="name">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <label for="contact_name">Kontaktperson </label><input type="text" id="contact_name" name="contact_name">
            <label for="contact_phone">Kontaktperson Tlf </label><input type="tel" id="contact_phone" name="contact_phone">
            <label for="email">Epost </label><input type="email" id="email" name="email">

            <label for="facebookLink">Facebook link </label><input type="text" id="facebookLink" name="facebookLink">
            <label for="instagramLink">Instagram link </label><input type="text" id="instagramLink" name="instagramLink">
            <label for="picture_url">Bilde link </label><input name="picture_url" id="picture_url" />
            <label for="picture_alt">Bilde beskrivelse </label> <textarea name="picture_alt" id="picture_alt" cols="30" rows="10"></textarea>
            
            <input type="submit" name="createFriend" value="lag venn">
        </form>

        <script type="text/javascript" src="./FriendClass.js"></script>
        <script type="text/javascript" src="./newFriend.js"></script>
        <script>

        </script>
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