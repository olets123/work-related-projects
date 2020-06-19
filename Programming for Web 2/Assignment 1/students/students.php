
<body>
    <div>
        <a href="../index.php">BACK</a>
    </div>
</body>

<?php

// Include files
include_once '../classes/Student.php';
include_once 'calc.php';
include_once '../studentTakesCourse/studentTakesCourse.php';

/* Make table for stuednts to display at HTML page */
if(isset($_GET['display'])) {

    $studCSVArray = array_map('str_getcsv', file('../csv/students.csv'));
    $object = studentsToArrObj($studCSVArray);
    echo '<table>
    <tr> 
        <th>Student Number</th>
        <th>First name</th>
        <th>Last Name</th>
        <th>Birthdate</th>
        <th>Courses Completed</th>
        <th>Courses Failed</th>
        <th>GPA</th>
        <th>Satus</th>
    </tr>';
    foreach($object as $o) {
        $o->createHTML();
    }
    echo '</table>';
    
}

/* Function to make studentInClass.csv as objects */
function studentsToArrObj($sArr, $stcArr = array()) {
     if(count($stcArr) == 0) {
        $stcArr = array();
        $stcArr = array_map('str_getcsv', file('../csv/studentInClass.csv'));
        $stcArr =  takesCourseToArrObj($stcArr);
    } 

    $objectArray = array();
    foreach($sArr as $s) {
        $newStudent = new Student($s[0], $s[1], $s[2], $s[3], 0, 0, 0, 0);
        /*run function for students in class to calculate
        * courses completed *Courses failed *GPA *Status
        */
        $newStudent->cCompleted = findCoursesCompleted($stcArr, $newStudent);
        $newStudent->cFailed = findCoursesFailed($stcArr, $newStudent);
        $newStudent->GPA = findGPA($stcArr, $newStudent);
        $newStudent->studentStatus = findStatus($newStudent->GPA);
        array_push($objectArray, $newStudent);
    }
    return $objectArray;
}


?>
<body>
    <div></div>
</body>
