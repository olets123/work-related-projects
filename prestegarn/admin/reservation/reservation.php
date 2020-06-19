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
    <a href="../about/about.php" class="menuBtn">Om oss</a>
    <a href="../event/events.php" class="menuBtn">Arrangementer</a>
    <a href="../friends/friends.php" class="menuBtn">Våre venner</a>
    <a href="../history/history.php" class="menuBtn">Historie</a>
    <a href="../tags/tags.php" class="menuBtn">Knagger</a>
    <a href="../users/users.php" class="menuBtn">Brukere</a>
    <a href="../reservation/reservation.php" class="menuBtn active">Reservasjoner</a>
    <a href="../admin.index.php" class="menuBtn">Tilbake</a>
    </div>
    <?php if ((!isset($_GET['id'])) && (!isset($_GET['delete']))) { ?> 
    <div class="contentDiv">
        <table>
            <tHead>
                <tr>
                    <th class="id">Id</th>
                    <th class="content">Navn</th>
                    <th class="content">E-Post</th>
                    <th class="content">Arrangement type</th>
                    <th class="content">Mobil nummer</th>
                    <th class="content">Antall gjester</th>
                    <th class="content">Fra dato: </th>
                    <th class="content">Til dato: </th>
                    <th class="content">Godkjent: </th>
                    <th>Endre?</th>
                    <th>Slett?</th>
                </tr>
            </tHead>
            <tbody id="content">
                
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="./reservation.js"></script>

    <?php } else if (isset($_GET['id'])) { ?>
        <form onSubmit="handleFormUpdate(event, this)" method="POST" id="reservationForm">
            
            <input type="hidden" name="var" value='<?php echo $_GET['id'] ?>'>
            <div id="reservationContent">
                <p id="name">Navn: </p>
                <p id="email">Epost: </p>
                <p id="eventType">Arrangement type: </p>
                <p id="mobile">Mobilnummer: </p>
                <p id="quantity">Antall gjester: </p>
                <p id="fromDate">Fra dato: </p>
                <p id="toDate">Til dato: </p>
            </div>
            <label for="accepted">Godkjent</label><input type="checkbox" name="accepted">
            <input type="submit" name="updateReservation" value="oppdater reservasjon">

        </form>
        <script type="text/javascript" src="./singleReservation.js"></script>
        <script type="text/javascript" src="./ReservationClass.js"></script>
        <script>   
            const id = <?php echo $_GET['id']; ?>; 
            defineObjects(id).then((data) => {
                const reservationHandler = new ReservationClass(data);
                reservationHandler.isLoaded = true;
                reservationHandler.updateForm();
            })
        </script>
        <script type="text/javascript" src="./formHandle/update.js"></script>
        <script type="text/javascript" src="./formHandle/validateForm.js"></script>
        <script type="text/javascript" src="./formHandle/formSubmit.js"></script>

    <?php } else if ((!isset($_GET['id'])) && (isset($_GET['delete']))) { ?>
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