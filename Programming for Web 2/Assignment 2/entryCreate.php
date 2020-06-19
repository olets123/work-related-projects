<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREATE ENTRY</title>
</head>
<body>
    <!-- Form to create an entry -->
    <form action="entryCreate.php" method="post">
        Entry title: <input type="text" name="title">
        Entry description: <input type="text" name="desc">
     <!-- include the file createDropdown.php to make an dropdown list -->
        <?php include('createDropdown.php'); ?>
        <input type="submit" value="create" name="createEntry">
    </form>
</body>
</html>