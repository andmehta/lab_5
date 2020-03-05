<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Page</title>
  <style>
    td {
    border: 1px solid;
    text-align: left;
    padding: 0.5em;
    }
    th {
    text-align: left;
    }
    </style>
</head>

<body>
  <h1>User Page</h1>

  <!-- build information for the user page -->
  <?php
    // get session from login page
    session_start();

    // if the user has not logged in first, display this page and say they need to login_page
    // please don't dock points for adding picture I'm just trying to have fun :)
    if(!isset($_SESSION['currentUser']) && !isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
      echo "<h1>What are you DOING in my PAGE??!?</h1>";
      echo "<img src=\"Shrek_(character).png\" alt=\"SHREK\" width=\"190\" height=\"390\">";

      $error = $_SESSION['type'] != 'user' && isset($_SESSION['type']) ? "You cannot be here as you are not a user." : "You are not currently logged in at all";
      echo "<p>$error</p>";
      // destroy session keys to force a return to the login screen
      session_start();

      session_unset();
      session_destroy();
      echo "<p><a href=\"login_page.php\">Log in</a></p>";
    } else {
      // greet user personally
      $username = $_SESSION['currentUser'];
      echo "<p>Welcome back $username</p>
            <p>Here's your past orders...</p>";

      echo "<table>
      <tr>
        <th>Order ID</th>
        <th>Order Total</th>
        <th>Order Quantity</th>
        <th>Shipping Method</th>
      </tr>";

      // login to mySQL instance in order to query
      require 'login.php';
      $conn = new mysqli($hn, $un, $pw, $db);
      if($conn->connect_error)
        die($conn->connect_error);

      // query the database for all orders made by the user
      $query = "SELECT * FROM lab5_orders WHERE username = '$username'";
      $result = $conn->query($query);
      while($row = $result->fetch_array()){
      	$orderID = $row['orderID'];
      	$orderTotal = $row['orderTotal'];
      	$quantity = $row['quantity'];
      	$shipping = $row['shipping'];

      	echo "
      		<tr>
      			<td>$orderID</td>
      			<td style =\"text-align: center\">$orderTotal</td>
      			<td>$quantity</td>
      			<td>$shipping</td>
      		</tr>
          ";
      }

      echo "</table>";
      echo "<p><a href=\"logout_page.php\">Log out</a></p>";
    }
  ?>
</body>
</html>
