<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- Form for Upload -->
<form method="POST" action="./data/data.php" enctype="multipart/form-data">
    Upload new file: <input type="file" accept=".csv" name="file" ><br>
    <button type="submit"   id="submit" name="submit">Upload</button>
    </form>
    <a href="./students/students.php?display=1">Show Students</a>
    <a href="./courses/courses.php?display=1">Show Courses</a>
</body>
</html>