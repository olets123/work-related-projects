<?php

// Inlcude files
include_once '../students/students.php';
include_once '../courses/courses.php';
include_once '../studentTakesCourse/studentTakesCourse.php';


/* get csv file turn it into array, split array into three different arrays, 
*  make three arrays into objects and then write to csv file,
* when submit button is clicked.
*/
if(isset($_POST['submit'])){
    if(isset($_FILES['file'])){
        if($_FILES['file']['size'] > 0) {
            $file = fopen($_FILES['file']['tmp_name'], 'r+');
            $csv = array();
            while (($row = fgetcsv($file)) !== FALSE) {
                $csv[] = $row;
            }

            $studArr = array();
            foreach($csv as $stud) {
                array_push($studArr, array($stud[0], $stud[1], $stud[2], $stud[3]));
            }
            // remove duplicates if the the same student shows twice with the same information.
            $studArr = removeDuplicates($studArr);
            $courseArr = array();
            foreach($csv as $course) {
                array_push($courseArr, array($course[4], $course[5], $course[6], $course[7], $course[8], $course[9]));
            }
            // remove duplicates from course.
            $courseArr = removeDuplicates($courseArr);
            $courseStudentArr = array();
            foreach($csv as $courseStudent) {
                array_push($courseStudentArr, array($courseStudent[0], $courseStudent[4], $courseStudent[6], $courseStudent[7], $courseStudent[9], $courseStudent[10]));
            }
            $courseStudentArr = removeDuplicates($courseStudentArr);
            // open csv file and make students to objects
            $studArr = studentsToArrObj($studArr);
            $csv_file = fopen('../csv/students.csv', 'w');
            foreach($studArr as $stud) {
                fputcsv($csv_file, get_object_vars($stud));
            }
            // close csv file
            fclose($csv_file);
        }
        // open csv file course and make information in course to objects.
        $courseArr = courseToArrObj($courseArr);
            $csv_file = fopen('../csv/course.csv', 'w');
            foreach($courseArr as $course) {
                fputcsv($csv_file, get_object_vars($course));
            }
            // close csv file
            fclose($csv_file);
        }
        // open csv file for student that takes course and make information to objects.
        $courseStudentArr = takesCourseToArrObj($courseStudentArr);
            $csv_file = fopen('../csv/studentInClass.csv', 'w');
            foreach($courseStudentArr as $takeCourse) {
                fputcsv($csv_file, get_object_vars($takeCourse));
            }
            // close file and send user to index when clicked 'upload'.
            fclose($csv_file); 
            header('Location: ../index.php');          
        }

        /* Function to remove duplicates in csv file.*/
        function removeDuplicates($arr) {
        $arr = array_values(array_map("unserialize", array_unique(array_map("serialize",  $arr))));
        return $arr;
        }

?>
