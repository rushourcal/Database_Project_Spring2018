<title>Check Items Sold</title>
<head>

</head>
<body>
	<p>Find information about how many items have been sold of each type</p>
	<form name="addOrder" method= "POST"> 
		<table>
			<tr>
				<td>Bought on date: </td>
				<td>
					<input type="string" name="dateInput" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-((1[0-2])|(0[1-9]))-[0-3][1-9]" required>
				</td>
				<td>
					<input type="submit" name="submit" value="Submit">
				</td>
			</tr>
		</table>
		<?php
			if (isset($_POST['submit'])){
				include_once('dbconnection.php');
				$dateInput = $_POST['dateInput'];
				$sql = "SELECT * FROM `orders` WHERE `Payment_id` IS NOT NULL;";
				$result = mysqli_query($link, $sql);
				$num_rows = mysqli_num_rows($result);
				$i=1;
				while($i<=3){
					switch($i){
						case 1:
							$itemType = "book";
							break;
						case 2:
							$itemType = "film";
							break;
						case 3:
							$itemType = "periodical";
							break;
					}
					$i=$i+1;
					$count = 0;
					if($num_rows!=0){
						echo "<table border = '1'>";
						echo "<th>".$itemType."s</th>";
						while($row = mysqli_fetch_assoc($result)){
							$dateOrdered = substr($row['Completion_date'],0,10);
							$orderID = $row['Order_id'];
							$itemID = $row['Item_id'];
							$sql2 = "SELECT * FROM `items` WHERE (`Item_type` = '$itemType' AND `Item_id` ='$itemID');";
							$result2 = mysqli_query($link,$sql2);
							$row2 = mysqli_fetch_assoc($result2);
							if($dateInput==$dateOrdered){
								echo "<tr>";
								echo "<td>Item ID: ".$itemID."</td><td>In order: ".$orderID."</td>";
								echo "</tr>";
								$count = $count + 1;
							}
						}
						echo "<tr><td> Total count:".$count."</td></tr>";
						echo "</table>";
					}else{
						echo "<p>No results found for ".$itemType."s</p>";
					}
				}
			}
		?>
	</form>
	<p><a href="index.php">Back</a></p>
</body>