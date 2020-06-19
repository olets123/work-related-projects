    Project 2

    WWW-Teknologi, IMT2291, Vår 2020

    Gruppemedlemmer:

    Odd Arne Hagelund, Kristoffer Lindbak og Ole Thomas Skogli


    --- Step by Step Guide for Project 2 ---


        Step 1) Open project in code editor and open your database:
                - import project2.SQL into your DB
        
        Step 2) Launch the terminal 


        Step 3) Type inn: cd app in terminal


        Step 4) When inside the folder "app", type inside terminal: npm install to install all dependencies for polymer project 2


        Step 5) Type inside terminal: polymer serve


        Step 6)  Go to main browser, NB! open at localhost:8081/
                    (if open from terminal CORS problem will appear)


        Step 7) When Polymer Application launched, you can eihter register a user or you can login


        Step 8) Go to Login, type in created user -> we have created three users. 
                One with admin premissions and one with teacher premissions and one with student premissions.
                (username: admin@admin password: passord)
                (username: teacher@teacher password: passord)
                (username: student@student password: passord)


        Step 9) If admin: access to all pages. 
                If teacher: possibility to upload videos and playlist. 
                If student: access to watch videos and playlists. 
                If not user: Watch videos and search for them



        Step 10) Click on videos/videolist to access the selected video with VTT-text
        



    --- Prosjekt 2 contains of 6 main folders ---

        api: contains of two folders: classes and php:
        - these folders contains files for api part of the project
    
        images:
        - contains images uploaded
    
        node_modules:
        - Polymer 3.0 folder, contains web components
    
        src:
        - contains all javascript files for the polymer clientside application

        test:
        - files from polymer test
    
        wireframes:
        - contains wireframes from the project

        Other files outside folders:
        - files from installing Polymer 3.0
        - DOM structure of the project
        
        
    --- DOM structure (See the picture in app/DOM/DOM.jpg) ---
        All of the LitElement/JS classes extends LitElement. 
        my-app connects everything together, and calls the other classes as needed.
        user-handler handles everything about the user: Login, Logout, Register, Loginstatus. Each one of these functions have a seperate php file which handles the data transfer to the DB: register, logout, loginStatus.php.
        admin-request handles the registered members who wants to become a teacher and gives them teacher permission if an admin aproves it. Data for showing the registered members who wants teacher privilege comes thtrough request.php. Granting them this privilege is done through updatePremission.php.
        video-view is dependent on cue-viewer, video-viewer and texted-video to get everything to work. These classes handles showing video and text. The video and text data from the db and files comes from video.php through the video-view class.
        video-upload handles the video uploads, it updates the database and moves the files to the correct folder through upload.php.
        teacher-playlist can both create playlist and add a video to a selected playlist. It creeates playlist through playlist.php and it adds a video to a playlist through spilleliste.php.
        student-playlist shows all the playlists, it gets it data from the db through playlist-view.php.

    

    --- Description of our experience of the project ---

       
        Positive things about the project:

            - All of the group members learned a lot when working with the Polymer and PHP together
            - We developed our own programming skills

       
        Negative things with the project:

            - We didn't manage to finish the hole project, but we tried our best and managed to complete    some of the core functions