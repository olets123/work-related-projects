<?php
/* 
* The class for Course defines objects in the constructor, it includes:
* Course code of which course, name of the course, which year, which semester, the name of teacher,
* how much credits the course has, total number of students for each course, 
* number of students that passed the course, number of students that failed the course and the average grade.
*/
   class Course {

    // Function to define objects in course.
    function __construct($cCode, $cName, $cYear, $cSemester, $teacher, $credits, 
    $nofStudents, $nofStudentsPassed, $nofStudentsFailed, $avgGrade ) {
      $this->cCode = $cCode;
      $this->cName = $cName;
      $this->cYear = $cYear;
      $this->cSemester = $cSemester;
      $this->teacher = $teacher;
      $this->credits = $credits;
      $this->nofStudents = $nofStudents;
      $this->nofStudentsPassed = $nofStudentsPassed;
      $this->nofStudentsFailed = $nofStudentsFailed;
      $this->avgGrade = $avgGrade;


    }

    // Function to create an table with HTML elements.
    public function createHTML() {
      // "echo" the table to show table for course.
      echo '<tr>
      <td>' . $this->cCode . '</td>
      <td>' . $this->cName . '</td>
      <td>' . $this->cYear . '</td>
      <td>' . $this->cSemester . '</td>
      <td>' . $this->teacher . '</td>
      <td>' . $this->credits . '</td>
      <td>' . $this->nofStudents . '</td>
      <td>' . $this->nofStudentsPassed . '</td>
      <td>' . $this->nofStudentsFailed . '</td>
      <td>' . $this->avgGrade . '</td>
  </tr>';
  }

   }

   
?>