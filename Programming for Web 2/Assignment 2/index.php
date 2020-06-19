<!--include the server file to connect with server.php-->
<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Urban dictionary</title>
</head>
<body>
    <?php if (!isset($_SESSION['user'])) { ?>
        <!-- Div that contains form and headlines for the dictionary  -->
    <div class="contentDiv">
    <h1>Login</h1>
    <p>Fill in the forms to login.</p>
        <form action="index.php" method="post">
            <label for="username">Username: </label><input type="text" name="username">
            <label for="password">Password: </label><input type="password" name="password">
            <input type="submit" name="login" value="Login">
            <a href="signup.php?display=1" class="menuBtn">Not a user?</a>
        </form>
    <h2>Urban Dictionary</h2>

    </div>
    <?php } ?>

    <?php if(isset($_SESSION['user'])) { ?>
        <div class="menuDiv">
            <a href="topicCreate.php" class="menuBtn">Create Topic</a>
            <a href="entryCreate.php" class="menuBtn">Create Entry</a>
            <a href="index.php" name="logout" class="menuBtn">Log Out</a>
        </div>
        <div class="contentDiv">
        <!-- 'echo $_SESSION['user'];' sets the username that are logged in to heading number 1.  -->
            <h1>Welcome to the Urban Dictionary, <?php echo $_SESSION['user']; ?></h1>
            <?php if(isset($_SESSION['success'])) { ?>
                <p><?php echo $_SESSION['success']; ?></p>
            <?php } ?>
        </div>
    <?php } ?>
    <!-- include the file topic.php to show which topics that are made-->
    <?php include_once('topics.php'); ?>
</body>
</html>