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
    <title>Præstgar'n - Admin/Arrangementer</title>
    <script>const host = `${window.location.protocol}//${window.location.hostname}:8080`; </script>
</head>
<body>
<div class="menuDiv">
        <a href="../news/news.php" class="menuBtn">Nyheter</a>
        <a href="../about/about.php" class="menuBtn">Om oss</a>
        <a href="../event/events.php" class="menuBtn active">Arrangementer</a>
        <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
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
                    <th>Tittel</th>
                    <th>Beskrivelse</th>
                    <th>Dato</th>
                    <th>Billettnummer</th>
                    <th>Billetter solgt</th>
                    <th>Pris (NOK)</th>
                    <th>Bilde link</th>
                    <th>Bilde beskrivelse</th>
                    <th>Emneknagger</th>
                    <th>Venner</th>
                    <th>Endre?</th>
                    <th>Slette?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <div>
        <a href="events.php?new=1">Legg til ny arrangement</a>
    </div>
    <script type="text/javascript" src="./events.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="eventForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <label for="title">tittel </label><input type="text" id="title" name="title">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <label for="date">dato </label><input type="date" id="date" name="date">
            <label for="numTickets">antall billetter </label><input type="number" id="numTickets" name="numTickets">
            <label for="ticketsSold">billetter solgt </label><input type="number" id="ticketsSold" name="ticketsSold">

            <label for="price">pris </label><input type="number" id="price" name="price">
            <label for="picture_url">bilde link </label><input type="text" id="picture_url" name="picture_url">
            <label for="picture_alt">bilde beskrivelse </label><textarea name="picture_alt" id="picture_alt" cols="30" rows="10"></textarea>
            <fieldset id="tags" name="tags"></fieldset>
            <fieldset name="friends"></fieldset>
            <fieldset name="program"></fieldset>
            <input type="submit" name="updateEvent" value="oppdater event">
        </form>
        <script type="text/javascript" src="./singleEvent.js"></script>
        <script type="text/javascript" src="./EventClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const eventHandler = new EventClass(data[0], data[1], data[2]);
                eventHandler.isLoaded = true;
                eventHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>
        
    <?php } else if (isset($_GET['new'])) { ?> 
        <form onSubmit="handleFormCreate(event, this)" method="POST" id="eventForm">
            
            <label for="title">tittel </label><input type="text" id="title" name="title">
            <label for="description">beskrivelse </label> <textarea name="description" id="description" cols="30" rows="10"></textarea>

            <label for="date">dato </label><input type="date" id="date" name="date">
            <label for="numTickets">antall billetter </label><input type="number" id="numTickets" name="numTickets">
            <label for="ticketsSold">billetter solgt </label><input type="number" id="ticketsSold" name="ticketsSold">

            <label for="price">pris </label><input type="number" id="price" name="price">
            <label for="picture_url">bilde link </label><input type="text" id="picture_url" name="picture_url">
            <label for="picture_alt">bilde beskrivelse </label><textarea name="picture_alt" id="picture_alt" cols="30" rows="10"></textarea>
            <fieldset id="tags" name="tags"></fieldset>
            <fieldset name="friends"></fieldset>
            <fieldset name="program"></fieldset>
            <input type="submit" name="createEvent" value="lag event">
        </form>
        <script type="text/javascript" src="./newEvent.js"></script>
        <script type="text/javascript" src="./EventClass.js"></script>
        <script>
        getNewObj().then((data) => {
            const eventHandler = new EventClass(data[0], data[2], data[1]);
            eventHandler.isLoaded = true;
            eventHandler.newEvent = true;
            eventHandler.updateForm();
            })
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