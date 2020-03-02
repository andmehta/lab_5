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


  ?>

  <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
  Great Web Application</span>!</h1>

  <p style="color: red">
    <!--Placeholder for error messages-->
  </p>

  <form method="post" action="login_page.php">
    <label>Username: </label>
    <input type="text" name="username"> <br>
    <label>Password: </label>
    <input type="password" name="password"> <br>
    <input type="submit" value="Log in">
  </form>

  <p style="font-style:italic">
    Placeholder for "forgot password" link<br><br>
    Placeholder for "create account" link
  </p>

</body>

</html>
