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
				</td>
			</tr>
		</table>
		
		<?php
			if (isset($_POST['submit']))
			{
				include_once('dbconnection.php');
				$orderID = (int)mysqli_real_escape_string($link, $_POST['Order_id']);
				$failed = 0;
				
				$getOrder = "SELECT * FROM `orders` WHERE `Order_id` = '$orderID';";
				if ($result = mysqli_query($link, $getOrder))
				{
					if (mysqli_num_rows($result) < 1)
					{
						echo "No results found.";
						mysqli_close($link);
					}
					
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
					echo "  Lookup unsuccessful!";
				}
				else
				{
					echo "<table border ='1'>";
					echo	"<tr></tr>";
					echo	"<tr>";
					echo		"<th>Order ID</th>";
					echo		"<th>Staff ID</th>";
					echo		"<th>Staff Name</th>";
					echo		"<th>Customer ID</th>";
					echo		"<th>Customer Name</th>";
					echo		"<th>Item ID</th>";
					echo		"<th>Item Description</th>";
					echo		"<th>Price</th>";
					echo		"<th>Payment ID</th>";
					echo		"<th>Payment Amount</th>";
					echo		"<th>Completion Date</th>";
					echo	"</tr>";
					echo	"<tr>";
					echo		"<td>". $orderID. "</td>";
					echo		"<td>". $staffID. "</td>";
					echo		"<td>". $staffName. "</td>";
					echo		"<td>". $custID. "</td>";
					echo		"<td>". $custName. "</td>";
					echo		"<td>". $itemID. "</td>";
					echo		"<td>". $itemDes. "</td>";
					echo		"<td>". $itemPrice. "</td>";
					echo		"<td>". $paymentID. "</td>";
					echo		"<td>". $payAmount. "</td>";
					echo		"<td>". $completeDate. "</td>";
					echo	"</tr>";
					echo "</table>";
				}
				
				mysqli_close($link);
			}
		?>
	</form>
	<p><a href="index.php">Back</a></p>
</body>