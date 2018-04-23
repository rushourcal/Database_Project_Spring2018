<title>Purchased Items by Customer</title>
<head>

</head>
<body>
	<p>Zachariah Boone</p>
	<p>Michael Teixeira</p>
	<p>Kyle Teixeira</p>
	<p>Enter customer ID to display purchased items</p>
	<form name="findItems" method= "POST"> 
		<table>
			<tr>
				<td>Customer ID: </td>
				<td>
					<input type="number" name="Customer_id" placeholder="1234" pattern="[0-9]{0,11}" required>
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
				$custID = (int)mysqli_real_escape_string($link, $_POST['Customer_id']);
				$failed = 0;
				
				$getCust = "SELECT * FROM `customers` WHERE `IdNo` = '$custID';";
				if ($result = mysqli_query($link, $getCust))
				{
					$row = mysqli_fetch_assoc($result);
					$deleted = $row["Inactive"];
					
					if ($deleted)
					{
						echo "No results found.";
						mysqli_close($link);
					}
				}
				else
				{
					$failed = 1;
					echo mysqli_error($link);
				}
				
				$getOrders = "SELECT * FROM `orders` WHERE `Customer_id` = '$custID';";
				if ($result = mysqli_query($link, $getOrders))
				{
					if (mysqli_num_rows($result) < 1)
					{
						echo "No results found.";
						mysqli_close($link);
					}
					
					$items = array();
					$dates = array();
					while ($row = mysqli_fetch_assoc($result))
					{
						array_push($items, $row["Item_id"]);
						array_push($dates, $row["Completion_date"]);
					}
					
					$itemDesc = array();
					for ($i = 0; $i < count($items); $i++)
					{
						$getDesc = "SELECT * FROM `items` WHERE `Item_id` = '$items[$i]';";
						if ($result = mysqli_query($link, $getDesc))
						{
							$row = mysqli_fetch_assoc($result);
							array_push($itemDesc, $row["Description"]);
						}
						else
						{
							$failed = 1;
							echo mysqli_error($link);
						}
					}
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
					echo		"<th>Item ID</th>";
					echo		"<th>Item Description</th>";
					echo		"<th>Purchase Date</th>";
					echo	"</tr>";
					
					for ($i = 0; $i < count($items); $i++)
					{
						echo	"<tr>";
						echo		"<td>". $items[$i]. "</td>";
						echo		"<td>". $itemDesc[$i]. "</td>";
						echo		"<td>". $dates[$i]. "</td>";
						echo	"</tr>";
					}
					
					echo "</table>";
				}
				
				mysqli_close($link);
			}
		?>
	</form>
	<p><a href="index.php">Back</a></p>
</body>