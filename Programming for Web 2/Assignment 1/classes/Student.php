<?php
/* Class for student
* this class and the constructor defines the:
* Studentnumber, first name of the student, last name of the student, birthday,
* which courses is completed, which courses is failed, shows the GPA score and status for the student. 
*/
class Student {
    /* Function to define the objects */
    function __construct($studentNo, $sFname, $sLname, $bofDate, 
    $cCompleted, $cFailed, $GPA, $studentStatus) {
      $this->studentNo = $studentNo;
      $this->sFname = $sFname;
      $this->sLname = $sLname;
      $this->bofDate = $bofDate;
      $this->cCompleted = $cCompleted;
      $this->cFailed = $cFailed;
      $this->GPA = $GPA;
      $this->studentStatus = $studentStatus;

    }

    // Function to create an table. 
    public function createHTML() {
        // "echo" the HTML elements to display table for student.
        echo '<tr>
        <td>' . $this->studentNo . '</td>
        <td>' . $this->sFname . '</td>
        <td>' . $this->sLname . '</td>
        <td>' . $this->bofDate . '</td>
        <td>' . $this->cCompleted . '</td>
        <td>' . $this->cFailed . '</td>
        <td>' . $this->GPA . '</td>
        <td>' . $this->studentStatus . '</td>
    </tr>';
    }
}

?> 