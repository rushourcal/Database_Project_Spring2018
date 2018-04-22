<title>Add Order</title>
<head>

</head>
<body>
	<p>Select Order information</p>
	<form name="addOrder" method= "POST"> 
		<table>
			<tr>
				<td>Staff Member ID: <a title = "Required">*</a></td>
                    <td>
                        <input type="number" name="Staff_id" placeholder="XXXX" pattern="[0-9]{0,11}" title="A number not currently in the database." required>
                    </td>
			</tr>
            <tr>
                <td>Customer ID: <a title = "Required">*</a></td>
                <td>
                    <input type="number" name="Customer_id" placeholder="XXXX" pattern="[0-9]{0,11}" title="A number not currently in the database." required>
                </td>
            </tr>
			<tr>
				<td>Item: <a title = "Required">*</a></td>
				<td>
					<select id="itemSelection" name="itemSelection">
						<option value="1">Book one of the exciting legend series by A.Uthor</option>
						<option value="11111">Star Wars fanfiction</option>
						<option value="22222">Treefiddy</option>
						<option value="33333">Entered through form</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td><input type="submit" name="submit" value="Submit">
				<!-- Above: Submit button. When pressed, submits the POST values to the next page, which is this same page reloaded.-->
				<?php
	
					if (isset($_POST['submit'])){#check if the post value for the submit button is currently stored (sent from previous page's form.)')
					#The post values are empty until the first time the submit button is pressed, and emptied/repopulated after 
					#Another form uses post in the next page. The php code being down below the submit button has nothing to do with the time it is run.
					#Even if the POST values are not set, this code is looked at before the submit button is pressed.
							#Variables. mysqli_real_escape_string makes input text into a "safe" string for an sqli query. Security against injection.
						include_once('dbconnection.php');
						$Staff_id = mysqli_real_escape_string($link, $_POST['Staff_id']);
						$Customer_id = mysqli_real_escape_string($link, $_POST['Customer_id']);
						$Item_id = $_POST['itemSelection'];
						$failed = 0;
						
						$sql2 = "INSERT INTO `orders` (`Order_id`, `Staff_id`, `Payment_id`, `Customer_id`, `Completion_date`, `Item_id`) VALUES (NULL, '$Staff_id', NULL, '$Customer_id', NULL, '$Item_id'); "; 
						
						$result = mysqli_query($link,$sql2);
						if(!$result){
							$failed = 1;
						}
						
						$getPrice = "SELECT `Price` FROM `items` WHERE '$Item_id' = `Item_id`;";
						if ($result = mysqli_query($link, $getPrice))
						{
							$row = mysqli_fetch_assoc($result);
							$returnedPrice =  $row["Price"];
						}
						else
						{
							$failed = 1;
						}
						
						#get last order id and set that in payment
						$getOrderID = "SELECT * FROM `orders` ORDER BY `Order_id` DESC LIMIT 1;";
						if ($result = mysqli_query($link, $getOrderID))
						{
							$row = mysqli_fetch_assoc($result);
							$OrderID =  $row["Order_id"];
						}
						else
						{
							$failed = 1;
						}
						
						
						#send payment to database
						$pushPayment = "INSERT INTO `customer_payments` (`payment_id`, `amount`, `date`, `Customer_id`, `Order_id`) VALUES (NULL, '$returnedPrice', CURRENT_TIMESTAMP, '$Customer_id', '$OrderID');";
						$result = mysqli_query($link,$pushPayment);
						if(!$result){
							$failed = 1;
						}
						
						#update orders with new payment id and completion date
						$updateOrder = "SELECT * FROM `customer_payments` ORDER BY `Order_id` DESC LIMIT 1;";
						$result = mysqli_query($link, $updateOrder);
						if ($result)
						{
							$row = mysqli_fetch_assoc($result);
							$payId =  $row["payment_id"];
							$completeDate = $row["date"];
						}
						else
						{
							$failed = 1;
						}
						
						$pushUpdate = "UPDATE `orders` SET `Payment_id` = '$payId', `Completion_date` = '$completeDate' WHERE `Order_id` = '$OrderID';";
						$result = mysqli_query($link,$pushUpdate);
						if(!$result){
							$failed = 1;
						}
						
						if ($failed)
						{
							echo mysqli_error($link);
						}
						else
						{
							echo "Successfully added to database!";
						}
						
						mysqli_close($link);
						exit();
					} 

				?>
				</td>
			</tr>
        </table>
    </form>
	<p><a href="index.php">Back</a></p>
</body>