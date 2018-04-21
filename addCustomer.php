<?php
include_once ('dbconnection.php');
?>
<title>Add Customer</title>
	<body>
		<p>Enter the necessary information to add an Author</p>
		<form name="addCustomer" method= "POST"> 

            <table>
                <tr>
                    <td>Customer's Full Name<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Name" placeholder="Zach">
                    </td>
                </tr>
				<tr>
                    <td>Customer's Phone Number<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Phone" placeholder="Zach">
                    </td>
                </tr>
				<tr>
                    <td>Customer's Password<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Password" placeholder="Zach">
                    </td>
                </tr>
				<tr>
                    <td>Customer's Username<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Username" placeholder="Zach">
                    </td>
                </tr>
				<tr>
                    <td>Customer's Email<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Email" placeholder="Zach">
                    </td>
                </tr>
				<tr>
                    <td>Customer's Address<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="C_Address" placeholder="Zach">
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
							$C_Name = mysqli_real_escape_string($link, $_POST['C_Name']);
							$C_Phone = mysqli_real_escape_string($link, $_POST['C_Phone']);
							$C_Password = mysqli_real_escape_string($link, $_POST['C_Password']);
							$C_Username = mysqli_real_escape_string($link, $_POST['C_Username']);
							$C_Email = mysqli_real_escape_string($link, $_POST['C_Email']);
							$C_Address = mysqli_real_escape_string($link, $_POST['C_Address']);
								# Error handling
							#if(false){
								# the "false" is a placeholder. Replace it with one step of input handling.
								# Check for correct inputs from everything.
								# If anything is wrong, send the user to a page letting them know 
								# That something was not input correctly.
								# Repeat the if statements consecutively, sending the user away for wrong/missing inputs.
							#}
							#if(false){}
							#chain if statements, or use nested ifs for complex constraints.
							# If everything was input correctly
							# create the sql statement and query the database.
							#$sql = "";#add query here
							#mysqli_query($link, $sql);
							exit();
						} 

                    ?>
                    </td>
                </tr>
            </table>
        </form>
	</body>
</title>