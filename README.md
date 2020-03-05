# Lab 5
php website that validates using mySQL and HTML form to login and save sessions. Because sessions are persisted, it is impossible to login multiple times. Any time the login page is navigated to, it first checks if a session is started, if so, it navigates to the user's page. 

## login page
This website uses a mySQLI class to query a database for a user entered username and password combination. If `false` an error appears, else it will navigate to either `user_page.php` or `admin_page.php`. Main challenge is to sanitize the inputs, as well as properly utilizing the mySQLI functions to check if the username password combination exists in the database

## user page 
This page displays the current Users orders, as well as greets them by username. This is accomplished through php sessions. If navigated to improperly, will Show a relevant error message. 

## admin page
This page displays the admin page, which displays **ALL** orders within the database, as well as who made the order. Accomplished similar to user_page through the use of php sessions. If navigated to improperly, will Show a relevant error message. 

## logout page
This page just takes the sessions and destroys them while also giving the user a chance to return to the login screen. 
