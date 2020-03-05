<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Administrator Page</title>
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
  <h1>Administrator Page</h1>

  <!-- PHP to display admin information -->
  <?php
    session_start();
    $username = $_SESSION['currentUser'];
    echo "<p>Welcome back $username</p>
          <p>Here's all the orders in the database...</p>";

    echo "<table>
    <tr>
      <th>Order ID</th>
      <th>Username</th>
      <th>Order Total</th>
      <th>Order Quantity</th>
      <th>Shipping Method</th>
    </tr>";

    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error)
      die($conn->connect_error);

    $query = "SELECT * FROM lab5_orders";
    $result = $conn->query($query);
    while($row = $result->fetch_array() ){
    	$orderID = $row['orderID'];
      $orderUsername = $row['username'];
    	$orderTotal = $row['orderTotal'];
    	$quantity = $row['quantity'];
    	$shipping = $row['shipping'];

    	echo "
    		<tr>
    			<td>$orderID</td>
          <td>$orderUsername</td>
    			<td style =\"text-align: center\">$orderTotal</td>
    			<td>$quantity</td>
    			<td>$shipping</td>
    		</tr>
        ";
    }

  ?>
</table>

<p><a href="logout_page.php">Log out</a></p>
</body>

</html>
