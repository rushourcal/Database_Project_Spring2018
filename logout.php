<?php
session_name("database2018");
session_start();
if(isset($_SESSION['Admin'])){
	unset($_SESSION['Admin']);
}
if(isset($_SESSION['current_customer'])){
	unset($_SESSION['current_customer']);
}
if(isset($_SESSION['cart'])){
	unset($_SESSION['cart']);
}
if(isset($_SESSION['totalPrice'])){
	unset($_SESSION['totalPrice']);
}
header('Location: index.php');

?>