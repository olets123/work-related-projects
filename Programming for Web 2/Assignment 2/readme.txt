* Assignment 2 * NTNU GJOEVIK * WEB DEVELOPMENT * #studentnumber: 473458 *

*** ABOUT: ***



This assignment is about creating a Urban Dictionary dynamic webpage with php, where you can login as either admin or as a user. 
Either you're logged in or not, you can see which topics and entries that are displayed on the index file. On the index file, 
as a user or admin you can create a new topics and entries. After them are created they can also be deleted. The page is connected with the MySQL database in phpmyadmin.



*** STRUCTURE: *** 

# This assignment contains of 12 files and 2 folders,
 in the phpmyadmin database you can find the database: 'dictionary',
 it contains three tables: users, topics and entries.
    * Structure given below.

The files that are structured in folders are the classes and setup functions for the project:

* Folders:

    classes:
        - database.php

* configuration
        - setup.php
        - setupFunction.php

The other files are structured outside the folder, well as the index file: 

        - index.php 
        - createDropdown.php    
        - entryCreate.php
        - server.php
        - signup.php
        - style.css 
        - topicCreate.php
        - topics.php
        - logput.php
        - readme.txt




*** INSTRUCTIONS: ****


* First step 

    - is for the login system is to log into the system.

    Login with username & password:

    # username = admin
    # password = Admin (NB! Capital letter A).

    * Sign up as user:
        Under the login input fields, a blue line it stands 'Not a user?'. 
        Click on 'Not a user?', and you will be sent to an page where you can registrate a user.
        Fill in the forms.

    * Second step: 
    When you are logged in, a message will be displayed 'Logged in', and whises you welcome. 
        * when ypu logged in the database for the dictionary, all the functions were runned and the tables in the database 'dictionary' was created. 
    Look around the page, in the left top bar at the site it stands 'Create Topic', 'Create Entry' and 'Log out'.
    There will also be displayed 'no topics found', because you haven't created one topic yet.

* Third step:

    * Topics
    Click on 'Create Topic' in the left top bar in the page.
    When you reach the page where you can see two input fields, one for topic title and one for topic description. Type text in.

    * Entries
    Click on 'Create Entry' in the left top bar in the page.
    When you reach the page where you can see two input fields and a dropdownbar with the TopicID, 
    Two input fields are one for entry title and one for entry description. Type text in and choose topicID.

* Fourth step:

*** You have to create a topic first, or else it you can't create an entry.

    * Create Topic
    Click on the submit button it stands: 'create'. Now it will create an topic with both title and description.
    It will also be saved with topic id, so it connects with entries. 
    All this is connected with the database in phpmyadmin.

    * Create Entry
    Click on the submit button it stands: 'create'. Now it will create an entry with chosen ID and the title and description of the entry.
    It will also be saved with entry id, so it connects with topics. 
    All this is connected with the database in phpmyadmin.


* Fifth step: 
    When you are back on the main page, the topic and entry you created will appear on the main page,
    with title, description and if it created by user or the admin.
    *If it's created by the user, the username will be showned. 
    *If it created with admin, the admin will be shown.

* Sixth step: 
    When you are tired of all the topics and entries that are craeted, you can delete them.
    It appears a blue link with 'Delete topic' & 'Delete entry'.
    Click on them to delete the topics and entries you want. 

* Seventh step:
    Click 'logout' and you will be taken to a page that shows you are logged out.
    Your session is finished.

INSTRUCTIONS end;