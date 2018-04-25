<?php
session_name("database2018");
session_start();

function printTable($Title){
		$user = 'root';
		$password = 'root';
		$db = 'bookstore';
		$host = 'localhost';
		$port = 3306;

		$link = mysqli_init(); 
		$success = mysqli_real_connect(
		$link, 
		$host, 
		$user, 
		$password, 
		$db,
		$port
		);

		$sql = "SELECT * FROM `$Title` ;";
		$result = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($result);
		$cart = $_SESSION['cart'];
		$items = explode(" ",$cart);
		$totalPrice = $_SESSION['totalPrice'];
		switch($Title){
			case "items":
				$columns = array("Item_id", "Subject_id", "Description", "Price", "Item_image", "Author_id", "Pub_id", "Director_id", "Item_type");
				break;
		}
		echo "<tr>";
		foreach($columns as &$column){
			echo "<th>".$column."</th>";
		}
		echo "</tr>";
		while($row = mysqli_fetch_assoc($result)){
			for($cartCount = 0; $cartCount < sizeof($items); $cartCount++){
				if($row['Item_id']==$items[$cartCount]){
					echo "<tr>";
					foreach($columns as &$value){
						if(isset($row[$value])){
							echo "<td>".$row[$value]."</td>";
						}else{
							echo "<td>NULL</td>";
						}
					}
				}
			}
			echo "</tr>";
		}
		mysqli_close($link);
}
	?>
<title> Your Cart </title>
<head></head>
<body>
<p> Your cart: </p>
	<table border = '1'>
		<?php
			if(isset($_SESSION['cart'])){
				printTable("items");
			}else{
				echo "Your cart appears to be empty.";
			}
		?>
	</table>
	<?php
	if(isset($_SESSION['cart'])){?>
		<form name="checkoutForm" method= "POST">
			<input type="submit" id="submit" name="checkout" value="Checkout">
		</form>
	<?php }
		if(isset($_POST['checkout'])){
			//admin directly adding order and payment to system
			include_once('dbconnection.php');
			$staffID = "1237";//staff ID for "online system" to distinguish between admin made and online transactions
			$customerID = $_SESSION['current_customer'];
			$itemList = $_SESSION['cart'];
			$totalPrice = $_SESSION['totalPrice'];
			//step one in transaction: create new order, and get its order_id
			//as long as this step succeeds, there should be no reason another step should fail beyond a catastrophe or perhaps random loss of connection in a minimal timespan
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
						}else{//This should never be reachable, as it relies strictly on information guaranteed to be in the database at this point.
							echo "Something went wrong with order finalization, on our end. Contact a store employee. $sql5";
						}
						unset($_SESSION['cart']);
						unset($_SESSION['totalPrice']);
						mysqli_close($link);
					}
				}else{//payment not accepted. This will never be reachable, in this application.
					echo "payment failed";
					$sql1Reverse = "DELETE FROM `orders` WHERE `Order_id` = `orderID`;";
					mysqli_query($link, $sql1Reverse);
					unset($_SESSION['cart']);
					unset($_SESSION['totalPrice']);
					mysqli_close($link);
				}
			}else{//failed to insert into order. Halt transaction, no changes to database.
				echo "order failed to update: $sql1";
			}
			unset($_SESSION['cart']);
			unset($_SESSION['totalPrice']);
			mysqli_close($link);
		}
		?>
	<p><a href="index.php">Back</a></p>
	<form action="logout.php">
			<input type="submit" name="logout" value="Logout">
	</form>
</body>
