<?php	
session_name("database2018");
session_start();
if ( (isset($_POST['login'])) || (isset($_SESSION['current_customer'])) || (isset($_SESSION['Admin']))){
	if(isset($_SESSION['current_customer'])){
		header('Location: customerOptions.php');
	}
	if(isset($_SESSION['Admin'])){
		header('Location: index2.php');
	}
	include_once ('dbconnection.php');

	$Username = mysqli_real_escape_string($link, $_POST['Username']);
	$Password = mysqli_real_escape_string($link, $_POST['Password']);
	$adminLogin = "Admin123";
	if( ($Username == $adminLogin) && ($Password == "database2018") ){
		mysqli_close($link);
		$_SESSION['Admin']="Admin";
		header('Location: index2.php');
	}else{
		$sql = "SELECT * FROM `customers` WHERE (`Username` = '$Username' AND `Password` = '$Password');";
		$result = mysqli_query($link, $sql);
		if(mysqli_num_rows($result)==1){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['current_customer'] = $row['IdNo'];
			header('Location: customerOptions.php');
			mysqli_close($link);
		}else{
			mysqli_close($link);
			?> <script>
			alert("Login information incorrect");
			</script><?php
		}
	}
}
?>
<title>Login</title>
	<body>
		<form name="LoginForm" method= "POST"> 

            <table>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="Username" placeholder="Username" pattern="[a-zA-Z0-9]{8,12}" title="8-12 characters using a-z, A-Z, or 0-9" required>
                    </td>
                </tr>
				<tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="Password" placeholder="P4ssw0rd" pattern="[a-zA-Z0-9]{8,12}" title="8-12 characters using a-z, A-Z, or 0-9" required>
                    </td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="login" value="Login">
                    </td>
                </tr>
            </table>
        </form>
		<p><a href="index.php">Back</a></p>
	</body>
</title>