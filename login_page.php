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


  ?>

  <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
  Great Web Application</span>!</h1>


    <!--Placeholder for error messages-->
    <?php
      // TODO needs to possibly be edited to include another parameter if the query was a success? maybe not
      // as the page should navigate away if succesful?
      if(isset($_POST['username']) && isset($_POST['password'])) {
        echo "<p style=\"color: red\">ERROR username and password combination does not exist</p>";
      }
    ?>


  <form method="post" action="login_page.php">
    <label>Username: </label>
    <input type="text" name="username"> <br>
    <label>Password: </label>
    <!-- TODO temporarily plaintext change type back to password -->
    <input type="text" name="password"> <br>
    <input type="submit" value="Log in">
  </form>

  <?php
    // santize input strings to prevent funny business
    function sanitizeString($var) {
      $var = stripslashes($var);
      $var = strip_tags($var);
      $var = htmlentities($var);
      return $var;
    }

    // TESTING
    var_dump($_POST);

    // get the username in a usable state
    $username = sanitizeString($_POST['username']);

    // Hide the password using hashing and salt
    $salt1    = "qm&h*";
    $salt2    = "pg!@";
    $password = sanitizeString($_POST['password']);
    $token    = hash('ripemd128', "$salt1$password$salt2");

    // query the database for the matching username and password
    $query = "SELECT username
              FROM lab5_users
              WHERE EXISTS username = '$username'
              AND password = '$token'";

    // TESTING
    echo '<br>---------------------------------------<br>';
    //var_dump($username); //should be bsmith
    //var_dump($token); //should be 32aa0c466818e1ccba25b8793db98c94
    echo '<br>---------------------------------------<br>';
    var_dump($query);

    // send query to the sql database and return True or False if the
    // username/password combo exists in the database
    $result = $conn->query($query);
    // TESTING
    echo '<br>---------------------------------------<br>';
    var_dump($result);

    // if the result returns true, then this user exists within the db
    if(isset($_POST['username'])) {
      if($result) {
        // TODO navigate to either User or Admin page depeding on result
        echo "<p>Success $result</p>";
      }
      else if(isset($_POST['username'])){
        echo "<p>Fail</p>";
      }
    }
   ?>
  <p style="font-style:italic">
    Placeholder for "forgot password" link<br><br>
    Placeholder for "create account" link
  </p>

</body>

</html>
