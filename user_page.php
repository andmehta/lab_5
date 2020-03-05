<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Page</title>
</head>

<body>
  <h1>User Page</h1>

  <!-- build information for the user page -->
  <?php
    session_start();
    $username = $_SESSION['currentUser'];
    echo "<p>Welcome back $username</p>
          <p>Here's your past orders...</p>";

    echo "
    <table>
    <tr>
      <th>OrderID</th>
      <th>Order Total</th>
      <th>Order Quantity</th>
      <th>Shipping Method</th>
    </tr>
    </table>";
  ?>

</body>

</html>
