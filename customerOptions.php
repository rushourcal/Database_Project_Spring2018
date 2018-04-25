<?php 
session_name("database2018");
session_start();
?>
<title>Bookstore Index</title>
<body>
<p>Zachariah Boone</p>
<p>Michael Teixeira</p>
<p>Kyle Teixeira</p>
<h1>Options:</h1>
<p><a href="addOrder.php">Add to cart</a></p>
<p><a href="viewCart.php">View cart</a></p>

<form action="logout.php">
			<input type="submit" name="logout" value="Logout">
</form>

</body>
</title>