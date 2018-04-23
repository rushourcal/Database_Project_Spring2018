<title>All tables</title>
<head>
<?php
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
		echo $num_rows;
		switch($Title){
			case "authors":
				$columns = array("Author_id", "Author_name");
				break;
			case "customers":
				$columns = array("IdNo", "Phone", "Password", "Username", "Email", "Address", "Name", "Created_Date", "Inactive");
				break;
			case "customer_payments":
				$columns = array("payment_id", "amount", "date", "Customer_id", "Order_id");
				break;
			case "directors":
				$columns = array("Dir_id", "Dir_name");
				break;
			case "items":
				$columns = array("Item_id", "Subject_id", "Description", "Price", "Item_image", "Author_id", "Pub_id", "Director_id", "Item_type");
				break;
			case "orders":
				$columns = array("Order_id", "Staff_id", "Payment_id", "Customer_id", "Completion_date", "Item_id");
				break;
			case "publishers":
				$columns = array("Pub_id", "Pub_name");
				break;
			case "staff":
				$columns = array("EIN","Phone","Position","Name","Address");
				break;
			case "subject":
				$columns = array("Subject_id","Subj_name");
				break;
		}
		echo "<tr>";
		foreach($columns as &$column){
			echo "<th>".$column."</th>";
		}
		echo "</tr>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			foreach($columns as &$value){
				if(isset($row[$value])){
					echo "<td>".$row[$value]."</td>";
				}else{
					echo "<td>NULL</td>";
				}
			}
			echo "</tr>";
		}
	}
?>
</head>
<body>
	<p> Showing all tables and values in Database </p>
	<p> authors </p>
	<table border = '1'>
	<?php
		printTable("authors");
	?>
	</table>
	<p> customers </p>
	<table border = '1'>
	<?php
		printTable("customers");
	?>
	</table>
	<p> customer_payments </p>
	<table border = '1'>
	<?php
		printTable("customer_payments");
	?>
	</table>
	<p> directors </p>
	<table border = '1'>
	<?php
		printTable("directors");
	?>
	</table>
	<p> items </p>
	<table border = '1'>
	<?php
		printTable("items");
	?>
	</table>
	<p> orders </p>
	<table border = '1'>
	<?php
		printTable("orders");
	?>
	</table>
	<p> publishers </p>
	<table border = '1'>
	<?php
		printTable("publishers");
	?>
	</table>
	<p> staff </p>
	<table border = '1'>
	<?php
		printTable("staff");
	?>
	</table>
	<p> subject </p>
	<table border = '1'>
	<?php
		printTable("subject");
	?>
	</table>
</body>