<title>Lookup Order</title>
<head>

</head>
<body>
	<p>Find information about a specific order</p>
	<form name="addOrder" method= "POST"> 
		<table>
			<tr>
				<td>Order ID: </td>
				<td>
					<input type="number" name="Order_id" placeholder="1234" pattern="[0-9]{0,11}" required>
				</td>
				<td>
					<input type="submit" name="submit" value="Submit">
					<?php
						if (isset($_POST['submit']))
						{
							include_once('dbconnection.php');
							$orderID = mysqli_real_escape_string($link, $_POST['Order_id']);
							$failed = 0;
							
							$getOrder = "SELECT * FROM `orders` WHERE `Order_id` = '$Order_id';";
							if ($result = mysqli_query($link, $getOrder))
							{
								$row = mysqli_fetch_assoc($result);
								$staffID = $row["Staff_id"];
								$paymentID = $row["Payment_id"];
								$custID = $row["Customer_id"];
								$completeDate = $row["Completion_date"];
								$itemID = $row["Item_id"];
							}
							else
							{
								$failed = 1;
								echo mysqli_error($link);
							}
							
							$getStaff = "SELECT * FROM `staff` WHERE `EIN` = '$staffID';";
							if ($result = mysqli_query($link, $getStaff))
							{
								$row = mysqli_fetch_assoc($result);
								$staffName = $row["Name"];
							}
							else
							{
								$failed = 1;
								echo mysqli_error($link);
							}
							
							$getPayment = "SELECT * FROM `customer_payments` WHERE `payment_id` = '$paymentID';";
							if ($result = mysqli_query($link, $getPayment))
							{
								$row = mysqli_fetch_assoc($result);
								$payAmount = $row["amount"];
							}
							else
							{
								$failed = 1;
								echo mysqli_error($link);
							}
							
							$getCust = "SELECT * FROM `customers` WHERE `IdNo` = '$custID';";
							if ($result = mysqli_query($link, $getCust))
							{
								$row = mysqli_fetch_assoc($result);
								$custName = $row["Name"];
							}
							else
							{
								$failed = 1;
								echo mysqli_error($link);
							}
							
							$getItem = "SELECT * FROM `items` WHERE `Item_id` = '$itemID';";
							if ($result = mysqli_query($link, $getItem))
							{
								$row = mysqli_fetch_assoc($result);
								$itemDes = $row["Description"];
								$itemPrice = $row["Price"];
							}
							else
							{
								$failed = 1;
								echo mysqli_error($link);
							}
							
							if ($failed)
							{
								echo "Lookup unsuccessful!";
							}
							else
							{
							
								echo "<table>";
								echo "<th>Order ID</th>";
								echo "<tr><td>". $orderID. "</td></tr>";
								echo "</table>";
						
							}
							
							mysqli_close($link);
							exit();
						}
					?>
				</td>
			</tr>
		</table>
	</form>
</body>