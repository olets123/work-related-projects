<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logged Out!</title>
</head>
<body>
    <div>
        <!-- Show the user that the user is logged out -->
        <h2>Your are now logged of the Urban Dictionary, <?php echo $_SESSION['user']; ?></h2>
        <a href="index.php" name="logout" value="" >Want to login again?</a>
    </div>
</body>
</html>