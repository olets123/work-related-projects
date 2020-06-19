* Assignment 1 * NTNU GJOEVIK * WEB DEVELOPMENT * #studentnumber: 473458 *

*** ABOUT: ***


This assignment is about creating a page where you can create a course management system for a university and have the possibility to
managing data about students, courses, instructors and grades. The page contains of a button where you can
upload csv-files and display two tables with information from tables: students and courses. If you change the values in 
the tables, the changes will be updated when uploaded. 



*** STRUCTURE: *** 

# This assignment contains of 12 files and 6 folders,
  in the csv folder you can find csv files for input, students, courses, and students that takes course.
  The folder of students and data contains a calculator to calculate the file that is uploaded. The functions in the calc.php for students and courses,
  will calculate and find the GPA, average GPA, students that passed and failed the course, total amount of studens in each course. 
    * Structure given below.

The files that are structured in folders are the classes, courses, csv, data, students and studentTakesCourse:
* folders:

    classes:
        - Course.php
        - Student.php
        - StudentCourse.php
 *courses
        - calc.php
        - courses.php
* csv 
        - input.csv 
        - course.csv
        - studentInClass.csv
        - students.csv
* data
        - data.php
        - style.css
* students
        - calc.php
        - students.php
* studentTakesCourse
        - studentTakesCourse.php

The other files are structured outside the map, well as the index file: 
        - index.php 
        - readme.txt




*** INSTRUCTIONS: ****


* First step: 
    Open the csv folder and change the values you want and save it. 
    Go to the mainpage, index.php and choose file you want to upload.
    After chosen file, click upload. 

    * Second step: 
    When you have clicked Upload, the button will let you still be on the mainpage.
    Click on one of the two blue buttons: Show students and Show courses, under Upload-button, 
    it will send you to the page where you clicked.

    * Third step:
    The page you clicked will show tables with an overview for either students or courses. 
    If you want to switch table, click the back button back to index and click on the table you want. 

    * Fourth step:
    Try to change the lines again in the input.csv file,
    try to upload again if wanted. 

* INSTRUCTIONS end;