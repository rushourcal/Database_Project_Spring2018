<?php
	if(isset($_SESSION['Admin'])){
		if($_SESSION['Admin'] != "Admin"){
			unset($_SESSION['Admin']);
			session_abort();
			?><script>alert("You aren't meant to be there. Back to login, you go.");</script><?php
			header('Location: index.php');
		}
	}else{
		?><script>alert("You aren't meant to be there. Back to login, you go.");</script><?php
		header('Location: index.php');
	}
?>