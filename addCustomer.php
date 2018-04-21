<title>Add Customer</title>

	<body>
		<p>Enter the necessary information to add a customer</p>
		<form name="addCustomer" method= "POST"> 

            <table>
                <tr>
                    <td>Customer's Full Name<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Name" placeholder="J.Smith" pattern="[A-Z]\.[A-Z][a-z]{0,37}" title="J.Smith, no more than 40 characters" required>
                    </td>
                </tr>
				<tr>
                    <td>Customer's Phone Number<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Phone" placeholder="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="XXX-XXX-XXXX, numbers only." required>
                    </td>
                </tr>
				<tr>
                    <td>Customer's Password<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Password" placeholder="P4ssw0rd" pattern="[a-zA-Z0-9]{8,12}" title="8-12 characters using a-z, A-Z, or 0-9" required>
                    </td>
                </tr>
				<tr>
                    <td>Customer's Username<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Username" placeholder="Username" pattern="[a-zA-Z0-9]{8,12}" title="8-12 characters using a-z, A-Z, or 0-9" required>
						<span id="name_status"></span>
					</td>
                </tr>
				<tr>
                    <td>Customer's Email<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Email" placeholder="me@email.com" pattern=".{1,40}@.{1,40}\..{1,18}" title="me@email.com up to 100 characters" required>
						<span id="email_status"></span>
					</td>
                </tr>
				<tr>
                    <td>Customer's Address<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Address" placeholder="123 real road, state, zip" required>
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
							$C_Name = mysqli_real_escape_string($link, $_POST['C_Name']);
							$C_Phone = mysqli_real_escape_string($link, $_POST['C_Phone']);
							$C_Password = mysqli_real_escape_string($link, $_POST['C_Password']);
							$C_Username = mysqli_real_escape_string($link, $_POST['C_Username']);
							$C_Email = mysqli_real_escape_string($link, $_POST['C_Email']);
							$C_Address = mysqli_real_escape_string($link, $_POST['C_Address']);
							
							$sql = "SELECT `Username` FROM `customers` WHERE `Username`='$C_Username';";
							$result = mysqli_query($link,$sql);
							$num_rows = mysqli_num_rows($result);
							if($num_rows > 0){
								echo "Username is already taken";
							}else{
								$sql2 = "SELECT `Email` FROM `customers` WHERE `Email`='$C_Email';";
								$result2 = mysqli_query($link,$sql2);
								$num_rows2 = mysqli_num_rows($result2);
								if($num_rows2 > 0){
									echo "Email is already taken";
								}else{
									$sql3 = "INSERT INTO `customers` (`IdNo`, `Phone`, `Password`, `Username`, `Email`, `Address`, `Name`, `Created_Date`) VALUES (NULL, '$C_Phone', '$C_Password', '$C_Username', '$C_Email', '$C_Address', '$C_Name', CURRENT_TIMESTAMP); ";
									$result3 = mysqli_query($link,$sql3);
									if($result3){
										echo "Customer was successfully added to the database.";
									}else{
										echo "Query Failed: $sql3";
									}
								}
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
</title>