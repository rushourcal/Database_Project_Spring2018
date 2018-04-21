<?php
include_once ('dbconnection.php');
?>
<title>Add Author</title>
	<body>
		<p>Enter the necessary information to add an Author</p>
		<form name="addAuthor" method= "POST"> 

            <table>
                <tr>
                    <td>Author Name<a title = "Required">*</a></td>
                    <td><!-- Above: will display "Author Name*" and hovering over the star with the mouse will show "required"-->
                        <input type="text" name="A_Name" placeholder="Z.Boone">
                    </td><!-- Above:next to "Author Name*" a simple text input field with a placeholder as an example input-->
                </tr>
                
                <tr>
                    <td><input type="submit" name="submit" value="Submit">
                    <!-- Above: Submit button. When pressed, submits the POST values to the next page, which is this same page reloaded.-->
                    <?php
		
						if (isset($_POST['submit'])){#check if the post value for the submit button is currently stored (sent from previous page's form.)')
						#The post values are empty until the first time the submit button is pressed, and emptied/repopulated after 
						#Another form uses post in the next page. The php code being down below the submit button has nothing to do with the time it is run.
						#Even if the POST values are not set, this code is looked at before the submit button is pressed.
							$A_Name = mysqli_real_escape_string($link, $_POST['A_Name']);
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
							$sql = "INSERT INTO `authors` (`Author_id`, `Author_name`) VALUES (NULL, '$A_Name');";
							mysqli_query($link, $sql);
							exit();
						} 

                    ?>
                    </td>
                </tr>
            </table>
        </form>
	</body>
</title>