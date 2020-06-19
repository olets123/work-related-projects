<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>CREATE TOPIC</title>
</head>
<body>
    <!-- Form to create topic title and description-->
    <form action="topicCreate.php" method="POST">
    Topic title: <input type="text" name="title">
    Topic description: <input type="text" name="desc">
    Create topic: <input type="submit" name="createTopic" value="create">
    </form>
</body>
</html>