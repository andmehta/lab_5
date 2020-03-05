# Lab 5
php website that validates using mySQL and HTML form to login and save sessions. 

## login_page
This website uses a mySQLI class to query a database for a user entered username and password combination. If `false` an error appears, else it will navigate to either `user_page.php` or `admin_page.php`. Main challenge is to sanitize the inputs, as well as properly utilizing the mySQLI functions to check if the username password combination exists in the database
