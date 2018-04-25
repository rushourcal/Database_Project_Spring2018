<?php 
session_name("database2018");
session_start();
?>
<title>Add Order</title>
<head>
<script>
function additem(){
	var item = document.getElementById("itemSelection")
	idPrice = item.value.split(" ")
	document.getElementById("selectedItems").value = document.getElementById("selectedItems").value.concat(" ".concat(idPrice[0]));
	document.getElementById("totalPrice").value = (parseFloat(document.getElementById("totalPrice").value) + parseFloat(idPrice[1])).toFixed(2);

}
function removeItems(){
	document.getElementById("selectedItems").value = "";
	document.getElementById("totalPrice").value= "0";
}
</script>
</head>
<body>
	<p>Zachariah Boone</p>
	<p>Michael Teixeira</p>
	<p>Kyle Teixeira</p>
	<p>Select Order information</p>
	<form name="addOrder" method= "POST"> 
		<table><?php if(isset($_SESSION['Admin'])){//only display Staff_id and Customer_id if Admin ?>
			<tr>
				<td>Staff Member ID: <a title = "Required">*</a></td>
                    <td><!-- realistically, a staff id would be set as the staff log in, and this would be automatic. However, there was no
							 requirement for staff to be able to log in, so we chose this system for ease of completion -->
                        <input type="text" name="Staff_id" placeholder="XXXX" pattern="[0-9]{0,11}" title="Your staff ID number.">
                    </td>
			</tr>
            <tr>
                <td>Customer ID: <a title = "Required">*</a></td>
                <td>
                    <input type="text" name="Customer_id" placeholder="XXXX" pattern="[0-9]{0,11}" title="ID number of customer making order.">
                </td>
            </tr><?php } ?>
			<tr>
				<td>Item: <a title = "Required">*</a></td>
				<td>
					<select id="itemSelection" name="itemSelection" data-Price="1">
					<?php 
						$user2 = 'root';
						$password2 = 'root';
						$db2 = 'bookstore';
						$host2 = 'localhost';
						$port2 = 3306;

						$link2 = mysqli_init();
						$success2 = mysqli_real_connect(
							$link2, 
							$host2, 
							$user2, 
							$password2, 
							$db2,
							$port2
						);
					$sqlItems = "SELECT * FROM `items`";
					$resultItems = mysqli_query($link2,$sqlItems);
					$num_items = mysqli_num_rows($resultItems);
					if(!($num_items>0)){
						echo "<option value='1'>No Items in database?</option>";
					}else{
						while($rowItems = mysqli_fetch_assoc($resultItems)){
							echo "<option value='".$rowItems['Item_id']." ".$rowItems['Price']."' >".$rowItems['Description']."</option>";
						}
					}
					?>
					</select>
					<input type="button" value="Add item" onclick="additem()">
					<input type="text" value="" id="selectedItems" name="selectedItems" readonly>
					<input type="button" value="Empty items" onclick="removeItems()">
				</td>
			</tr>
			<tr>
			<td> Total price:</td><td> <input type="number" value="0" id="totalPrice" name="totalPrice" readonly></td>
			</tr>
			
			<tr>
				<td><input type="submit" name="submit" value="Submit">
				<?php
					if(isset($_POST['submit'])){
						if(isset($_SESSION['current_customer'])){//customer adding to cart
							$_SESSION['cart'] = $_POST['selectedItems'];
							$_SESSION['totalPrice'] = $_POST['totalPrice'];
							header('Location: viewCart.php');
						}else{//admin directly adding order and payment to system
							include_once('dbconnection.php');
							$staffID = $_POST['Staff_id'];
							$customerID = $_POST['Customer_id'];
							$itemList = $_POST['selectedItems'];
							$totalPrice = $_POST['totalPrice'];
							//step one in transaction: create new order, and get its order_id
							$sql1 = "INSERT INTO `orders`(`Order_id`, `Staff_id`, `Payment_id`, `Customer_id`, `Completion_date`, `Item_list`, `Total_price`) VALUES (NULL, '$staffID', NULL, '$customerID', NULL, '$itemList', '$totalPrice');";
							$result1 = mysqli_query($link,$sql1);
							if($result1){
								$sql2 = "SELECT * FROM `orders` ORDER BY `Order_id` DESC LIMIT 1;";
								$result2 = mysqli_query($link,$sql2);
								$row2 = mysqli_fetch_assoc($result2);
								$orderID = $row2['Order_id'];
								//next step in transaction: create payment with order information, and get its payment_id
								$sql3 = "INSERT INTO `customer_payments` (`payment_id`, `amount`, `date`, `Customer_id`, `Order_id`) VALUES (NULL, $totalPrice, CURRENT_TIMESTAMP, $customerID, $orderID);";
								if(true){//In a real application, you would check to make sure the payment processed before proceeding, here.
									$result3 = mysqli_query($link, $sql3);
									if($result3){
										$sql4 = "SELECT * FROM `customer_payments` ORDER BY `payment_id` DESC LIMIT 1;";
										$result4 = mysqli_query($link,$sql4);
										$row4 = mysqli_fetch_assoc($result4);
										$paymentID = $row4['payment_id'];
										//final step in transaction: update order with the correct payment_id and timestamp
										$sql5 = "UPDATE `orders` SET `Payment_id` = '$paymentID', `Completion_date` = CURRENT_TIMESTAMP WHERE `Order_id` = '$orderID';";
										$result5 = mysqli_query($link, $sql5);
										if($result5){
											//order successfully paid for
											echo "Order and payment finalized.";
										}else{//This should never be reachable.
											echo "Something went wrong with order finalization, on our end. Contact a store employee. $sql5";
										}
										mysqli_close($link);
									}
								}else{//payment not accepted. This will never be reachable, in this application.
									echo "payment failed";
									$sql1Reverse = "DELETE FROM `orders` WHERE `Order_id` = `orderID`;";
									mysqli_query($link, $sql1Reverse);
									mysqli_close($link);
								}
							}else{//failed to insert into order. Halt transaction, no changes to database.
								echo "order failed to update: $sql1";
							}
							mysqli_close($link);
						}
					}

				?>
				</td>
			</tr>
        </table>
    </form>
	<p><a href="index.php">Back</a></p>
	<form action="logout.php">
			<input type="submit" name="logout" value="Logout">
	</form>
</body>