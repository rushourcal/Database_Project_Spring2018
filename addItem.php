<title>Add Item</title>
<head>
	<script>
	function selectItem(item){
		var value = item.value;
		switch(value){
			case "1":
					document.getElementById("authorSelector").style.display = "table-row";
					document.getElementById("directorSelector").style.display = "none";
					document.getElementById("publisherSelector").style.display = "none";
					break;
			case "2":
					document.getElementById("authorSelector").style.display = "none";
					document.getElementById("directorSelector").style.display = "table-row";
					document.getElementById("publisherSelector").style.display = "none";
					break;
			case "3":
					document.getElementById("authorSelector").style.display = "none";
					document.getElementById("directorSelector").style.display = "none";
					document.getElementById("publisherSelector").style.display = "table-row";
					break;

		}
	}
	</script>
</head>
	<body>
		<p>Zachariah Boone</p>
		<p>Michael Teixeira</p>
		<p>Kyle Teixeira</p>
		<p>Enter the necessary information to add an item</p>
		<form name="addItem" method= "POST"> 
			<table>
				<tr>
					<td> Select item type: </td>
					<td>
						<select id="itemSelector" name="itemSelector" onchange="selectItem(this)">
							<option value="1">Book</option>
							<option value="2">Film</option>
							<option value="3">Periodical</option>
						</select>
					</td>
				</tr>
                <tr>
                    <td>Item's ID Number<a title = "Required">*</a></td>
                    <td>
                        <input type="number" name="Item_id" placeholder="XXXXX" pattern="[0-9]{0,11}" title="A number not currently in the database." required>
                    </td>
                </tr>
				<tr>
                    <td>Item's Price<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="Item_Price" placeholder="0.00" pattern="[0-9]{0,10}\.[0-9]{2}" title="XXX.XX a price for the item with two decimal places." required>
                    </td>
                </tr>
				<tr>
                    <td>Item's Subject ID<a title = "Required">*</a></td>
                    <td>
                        <select id="subjectSelection" name="subjectSelection">
							<option value="1">Sci-Fi</option>
							<option value="2">Adventure</option>
							<option value="3">Psychological</option>
						</select>
                    </td>
                </tr>
				<tr>
                    <td>Item's Description<a title = "Required">*</a></td>
                    <td>
                        <input type="text" name="Description" placeholder="Enter a description" pattern="[a-zA-Z0-9.,!? :]{0,255}" title="A simple description of the item." required>
                    </td>
                </tr>
				<tr id="authorSelector" style="display: table-row;">
                    <td>Item's Author<a title = "Required">*</a></td>
                    <td>
                        <select id="authorSelection" name="authorSelection">
							<option value="1">T.Est</option>
							<option value="2">A.Uthor</option>
						</select>
					</td>
                </tr>
				<tr  id="directorSelector" name="directorSelector" style="display: none;">
                    <td>Item's Director<a title = "Required">*</a></td>
                    <td>
                        <select id="directorSelection" name="directorSelection">
							<option value="1">T.Est</option>
							<option value="2">D.Irector</option>
						</select>
					</td>
                </tr>
				<tr id="publisherSelector" name="publisherSelector" style="display: none;">
                    <td>Item's Publisher<a title = "Required">*</a></td>
                    <td>
                        <select id="publisherSelection" name="publisherSelection">
							<option value="1">T.Est</option>
							<option value="2">P.Ublisher</option>
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
							$itemType = (int)$_POST["itemSelector"];
							$Item_id = mysqli_real_escape_string($link, $_POST['Item_id']);
							$Item_Price = (float)$_POST['Item_Price'];
							$Subject = (int)$_POST['subjectSelection'];
							$Description = mysqli_real_escape_string($link, $_POST['Description']);
							$Author_ID = (int)$_POST['authorSelection'];
							$Director_ID = (int)$_POST['directorSelection'];
							$Publisher_ID = (int)$_POST['publisherSelection'];
							
							$sql = "INSERT INTO `items` (`Item_id`, `Subject_id`, `Description`, `Price`, `Item_image`, ";
							switch($itemType){
								case 1:
									$sql2 = $sql . "`Author_id`, `Item_type`) VALUES ('$Item_id', '$Subject', '$Description', '$Item_Price', NULL, '$Author_ID', 'book'); "; 
									break;
								case 2:
									$sql2 = $sql . "`Director_id`, `Item_type`) VALUES ('$Item_id', '$Subject', '$Description', '$Item_Price', NULL, '$Director_ID', 'film'); "; 
									break;
								case 3:
									$sql2 = $sql . "`Pub_id`, `Item_type`) VALUES ('$Item_id', '$Subject', '$Description', '$Item_Price', NULL, '$Publisher_ID', 'periodical'); "; 
									break;

							}
							$result = mysqli_query($link,$sql2);
							if($result){
								echo "Item was successfully added to the database.";
							}else{
								echo "Query Failed itemType $itemType: $sql2";
							}
							mysqli_close($link);
							//exit();
						} 

                    ?>
                    </td>
                </tr>
            </table>
        </form>
		<p><a href="index.php">Back</a></p>
	</body>
</title>