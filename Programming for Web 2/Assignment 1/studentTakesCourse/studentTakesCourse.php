<?php

// Include files
include_once '../classes/StudentCourse.php';

/* Function to make courses to array objects */
function takesCourseToArrObj($sArr, $stcArr = array()) {
    /*  if(count($stcArr) == 0) {
         $stcArr = array();
         $stcArr = array_map('str_getcsv', file('../csv/studentInCourse.csv'));
         $stcArr =  
     } */
 
     $objectArray = array();
     foreach($sArr as $s) {
         // push new courses into array when new courses is made.
         $newCourseTaken = new StudentTakesCourse($s[0], $s[1], $s[2], $s[3], $s[4], $s[5], 0, 0, 0, 0);
         array_push($objectArray, $newCourseTaken);
     }
     return $objectArray;
 }

?>