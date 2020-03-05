<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Log in to Website</title>

  <style>
    input {
      margin-bottom: 0.5em;
    }
  </style>
</head>

<body>

  <!-- Put your PHP to log someone in here... Includes forwarding, storing sessions, etc. -->
  <?php
    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error)
      die($conn->connect_error);

    // ensure that sessions haven't already been established, if so, navigate user to their respective page
    session_start();
    if(isset($_SESSION['currentUser']) && isset($_SESSION['type'])) {
      $location = $_SESSION['type'] == 'user' ? 'Location: user_page.php' : 'Location: admin_page.php';
      header($location);
    }

      // santize input strings to prevent funny business
      function sanitizeString($var) {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
      }

      // get the username in a usable state
      $username = sanitizeString($_POST['username']);

      // Hide the password using hashing and salt
      $salt1    = "qm&h*";
      $salt2    = "pg!@";
      $password = sanitizeString($_POST['password']);
      $token    = hash('ripemd128', "$salt1$password$salt2");

      // query the database for the matching username and password
      $query = "SELECT username, type
                FROM lab5_users
                WHERE username = '$username'
                AND password = '$token'";


      // send query to the sql database and return True or False if the
      // username/password combo exists in the database
      $result = $conn->query($query);

      //first make sure that the form has actually been submitted
      if(isset($_POST['username'])) {
        // if the result number of rows is 1, then this user exists within the db
        if($result->num_rows == 1) {
          $row = $result->fetch_array();
          $_SESSION['currentUser'] = $row["username"];
          $_SESSION['type'] = $row["type"];

          //using the type returned from the database, navigate user to their respective page
          $location = $_SESSION['type'] == 'user' ? 'Location: user_page.php' : 'Location: admin_page.php';
          header($location);
        } else {
          $failToLog = True;
        }
      }
  ?>

  <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
  Great Web Application</span>!</h1>


    <!--Placeholder for error messages-->
    <?php
      if(isset($_POST['username']) && isset($_POST['password']) && $failToLog === True) {
        echo "<p style=\"color: red\">ERROR username and password combination does not exist</p>";
      }
    ?>


  <form method="post" action="login_page.php">
    <label>Username: </label>
    <input type="text" name="username" value="<?php echo $username;?>"> <br>
    <label>Password: </label>
    <input type="password" name="password" value="<?php echo $password;?>"> <br>
    <input type="submit" value="Log in">
  </form>

  <p style="font-style:italic">
    Placeholder for "forgot password" link<br><br>
    Placeholder for "create account" link
  </p>

</body>

</html>
