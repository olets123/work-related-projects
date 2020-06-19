<?php

/* Class for Students that takes courses, 
  *the constructor for the class "StudentTakesCourse" includes:
  * Studentnumber, course code, year, semester, credit and grade in that specific course.
*/
class StudentTakesCourse {
    /* 
    * Function with a constructor to define objects in class
    */
    function __construct($studentNo, $cCode, $stcYear, $stcSemester, $stcCredit, $stcGrade) {
      $this->studentNo = $studentNo;
      $this->cCode = $cCode;
      $this->stcYear = $stcYear;
      $this->stcSemester = $stcSemester;
      $this->stcCredit = $stcCredit;
      $this->stcGrade = $stcGrade;


    }

    // Public function to create an table to show which students takes which courses.
    public function createHTML() {
      // "echo" HTML elements to display it in the studentTakesCourse.php page.
        echo '<tr>
        <td>' . $this->studentNo . '</td>
        <td>' . $this->cCode . '</td>
        <td>' . $this->stcYear . '</td>
        <td>' . $this->stcSemester . '</td>
        <td>' . $this->stcCredit . '</td>
        <td>' . $this->stcGrade . '</td>
    </tr>';
    }
}

?>  