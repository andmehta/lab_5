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
    session_start();
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

    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error)
      die($conn->connect_error);

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
  ?>
</table>
<p><a href="logout_page.php">Log out</a></p>
</body>

</html>
