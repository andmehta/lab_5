<!DOCTYPE html>
<html lang="en">

<head>
  <title>Logged Out</title>
</head>

<body>
  <!-- php to handle logging out -->
  <?php
    // destroy session keys
    session_start();

    session_unset();
    session_destroy();
  ?>

  <h1>Logged Out</h1>

  <p>
    You are now logged out of the website.
  </p>

  <p>
    <a href="login_page.php">Log in</a> again.
  </p>
</body>

</html>
