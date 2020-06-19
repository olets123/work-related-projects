<?php
    /* Function finds each student with course code,
     and count the total amount of students*/
    function findNumStud($findStuds, $c) {
        $count = 0;
        foreach($findStuds as $f) {
            if ($f->cCode == $c->cCode) {
                $count++;
            }
        }
        return $count;
    }
    /* Function to find all the students that passed a course
    * $stcArr and $stcGrade -> comes from the class StudentTakesCourse.
    * $cCode are used to find which course it is. 
    */
    function findStudentsPassed($stcArr, $course){

        $gradeArr = array();
        foreach($stcArr as $s){
            if ($s->stcGrade != 'F' && $s->cCode == $course->cCode) {
                array_push($gradeArr, $s);
            }
        }
        return count($gradeArr);
    }

    /* Function for how many students that has failed course. 
    * $stcArr -> comes from the class StudentTakesCourse.
    * $cCode -> comes from the class Course.
    */
    function findStudentsFailed($stcArr, $course){

        $gradeArr = array();
        foreach($stcArr as $s){
            if ($s->stcGrade == 'F' && $s->cCode == $course->cCode) {
                array_push($gradeArr, $s);
            }
        }
        return count($gradeArr);
    }

    /* Function to find the average grade for each student.
    * $grades shows all the six grades for a student.
    * $cCode and $stcGrade -> comes from the class studentTakesCourse.
    * $gp comes from the function to findGPA in the calc.php for students.
    */
    function findAvgGrade($avg, $course) {
        $grades = ['F', 'E', 'D', 'C', 'B', 'A']; 
        $sumArr = array();
        foreach($avg as $s) {
            if($s->cCode == $course->cCode){
               $gp = array_search($s->stcGrade, $grades); 
               array_push($sumArr, $gp);
            }
        }
        if (count($sumArr)) {
            return $grades[round(array_sum($sumArr)) / count($sumArr)];
        }
    }

    
?>
