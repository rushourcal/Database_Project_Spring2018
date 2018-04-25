<?php 
session_name("database2018");
session_start();
include('adminCheck.php');
?>
<title>Remove Customer</title>
<head>

</head>
<body>
	<p>Zachariah Boone</p>
	<p>Michael Teixeira</p>
	<p>Kyle Teixeira</p>
	<p>Which customer would you like to remove?</p>
	<form name="removeCustomer" method= "POST"> 
		<table>
			<tr>
				<td><p>Customer ID: </p></td>
				<td><input type="number" name="Customer_id" placeholder="1234" pattern="[0-9]{0,11}" required></td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
        </table>
    </form>
	<?php
		if (isset($_POST['submit']))
		{
			include_once('dbconnection.php');
			$custID = (int)mysqli_real_escape_string($link, $_POST['Customer_id']);
			$failed = 0;
			
			$getCust = "SELECT * FROM `customers` WHERE `IdNo` = '$custID';";
			if ($result = mysqli_query($link, $getCust))
			{
				if (mysqli_num_rows($result) < 1)
				{
					echo "No customer found with ID ". $custID;
					mysqli_close($link);
				}
				else
				{
					$row = mysqli_fetch_assoc($result);
					$deleted = $row["Inactive"];
				}
				
				if ($deleted)
				{
					echo "Customer already removed.";
					mysqli_close($link);
				}
			}
			else
			{
				$failed = 1;
				echo mysqli_error($link);
			}
			
			if (!$failed)
			{
				$delCust = "UPDATE `customers` SET `Phone` = 'NULL', `Password` = NULL, `Username` = '$custID', `Email` = '$custID', `Address` = NULL, `Created_Date` = CURRENT_TIMESTAMP, `Inactive` = TRUE WHERE `IdNo` = '$custID';";
				if (!$result = mysqli_query($link, $delCust))
				{
					$failed = 1;
					echo mysqli_error($link);
				}
			}
			
			if ($failed)
			{
				echo " Unable to delete customer.";
			}
			else
			{
				echo "Customer ". $custID. " successfully removed.";
			}
			
			mysqli_close($link);
		}
	?>
	<p><a href="index.php">Back</a></p>
	<form action="logout.php">
			<input type="submit" name="logout" value="Logout">
	</form>
</body>