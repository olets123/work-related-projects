
<!-- Make a button to get back to index.php. -->
<body>
    <div>
        <a href="../index.php">BACK</a>
    </div>
</body>

<?php

// Include files 
include_once '../classes/Course.php';
include_once 'calc.php';
include_once '../studentTakesCourse/studentTakesCourse.php';


/* Get tables for course and make a HTML table to display table from courses. 
* $studCSVArray - gets the csv file from courses.
* $object make an object of courses csv file.
*/
if(isset($_GET['display'])) {

    $studCSVArray = array_map('str_getcsv', file('../csv/course.csv'));
    $object = courseToArrObj($studCSVArray);
    echo '<table>
    <tr> 
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Teacher</th>
        <th>Credits</th>
        <th>N.O Students</th>
        <th>N.O Students passed</th>
        <th>N.O Students failed</th>
        <th>Average Grade</th>

    </tr>';
    // Go through $object and run function for create a HTML table, and display it.
    foreach($object as $o) {
        $o->createHTML();
    }
    echo '</table>';
    
}

/* Function to create objects of course.
 * $stcArr is from studentTakesCourse class.
 */
function courseToArrObj($sArr, $stcArr = array()) {
    if(count($stcArr) == 0) {
        $stcArr = array();
        $stcArr = array_map('str_getcsv', file('../csv/studentInClass.csv'));
        $stcArr =  takesCourseToArrObj($stcArr);
    } 
    /* Find total amount of sutdents in course, which students has passed the course,
    *  which students has failed and the average grade of the students in each course.
    */
     $objectArray = array();
     foreach($sArr as $s) {
         $newCourse = new Course($s[0], $s[1], $s[2], $s[3], $s[4], $s[5], 0, 0, 0, 0);
         $numStud = findNumStud($stcArr, $newCourse);
         $newCourse->nofStudents = $numStud;
        $studPassed = findStudentsPassed($stcArr, $newCourse);
        $newCourse->nofStudentsPassed = $studPassed;
        $studFailed = findStudentsFailed($stcArr, $newCourse);
        $newCourse->nofStudentsFailed = $studFailed;
        $avgGrade = findAvgGrade($stcArr, $newCourse);
        $newCourse->avgGrade = $avgGrade;
         array_push($objectArray, $newCourse);
     }
     return $objectArray;
 }

?>