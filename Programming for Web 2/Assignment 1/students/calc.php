<?php 

   /* Functions to calculate which courses are completed */
    function findCoursesCompleted($stcArr, $stud){
        $gradeArr = array();
        foreach($stcArr as $s){
            if ($s->stcGrade != 'F' && $s->studentNo == $stud->studentNo) {
                array_push($gradeArr, $s);
            }
        }
        return count($gradeArr);
    }

    /* Function to calculate how many courses are failed. */
    function findCoursesFailed($stcArr, $stud){
        $gradeArr = array();
        foreach($stcArr as $s){
            if ($s->stcGrade == 'F' && $s->studentNo == $stud->studentNo) {
                array_push($gradeArr, $s);
            }
        }
        return count($gradeArr);
    }

    /* Function to calculate for finding the GPA per student */
    function findGPA($stcArr, $stud){
        $creditAcc = 0;
        foreach($stcArr as $c) {
            if($c->studentNo == $stud->studentNo) {
                $creditAcc += $c->stcCredit;
            }
        }
        $grades = ['F', 'E', 'D', 'C', 'B', 'A'];
        $sumArr = array();
        foreach($stcArr as $s) {
            if($s->studentNo == $stud->studentNo){
               $gp = array_search($s->stcGrade, $grades); 
               $m = $gp * $s->stcCredit;
               array_push($sumArr, $m);
            }
        }
        // calculate he GPA with the sum from the grades and divided on their credit from course.
        $gpa = 0;
        $gpa = array_sum($sumArr) / $creditAcc;
        return round($gpa, 2);
   } 

    /* Function to find and calculate the status each student has */
    function findStatus($GPA){
        if( $GPA >= 0 && $GPA <= 1.9 ) 
            $status = 'Unsatisfactory';
        else if( $GPA >= 2 && $GPA <= 2.9 ) 
            $status = 'Satisfactory';
        else if( $GPA >= 3 && $GPA <= 3.9 ) 
            $status = 'Honour';
        else if( $GPA >= 4 && $GPA <= 5 ) 
            $status = 'High honour';
        // Return the status
        return $status;
    
    }

?>