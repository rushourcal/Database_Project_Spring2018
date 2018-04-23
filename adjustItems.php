<title>Ajust Items</title>
<head>
	<script>
	function selectAmount(item){
		var value = item.value;
		var DescriptionRow = document.getElementById("DescriptionRow");
		var IDRow = document.getElementById("IDRow");
		var Item_ID = document.getElementById("Item_ID");
		var changePrice = document.getElementById("changePrice");
		var changePriceMulti = document.getElementById("changePriceMulti");
		var pReq = document.getElementById("pReq");
		switch(value){
			case "1":
					IDRow.style.display = "block";
					Item_ID.required = true;
					DescriptionRow.style.display = "block";
					changePrice.style.display = "block";
					changePriceMulti.style.display = "none";
					setDescription(document.getElementById("changeDescription").value);
					setPrice(changePrice);
					break;
			case "2":
					IDRow.style.display = "none";
					Item_ID.required = false;
					DescriptionRow.style.display = "none";
					Description.required = false;
					pReq.style.display = "block";
					changePrice.style.display = "none";
					changePriceMulti.style.display = "block";
					break;

		}
	}
	function setDescription(item){
		var value = item.value;
		var Description = document.getElementById("Description");
		var dReq = document.getElementById("dReq");
		switch(value){
			case "1":
					Description.required = false;
					dReq.style.display = "none";
					break;
			case "2":
					Description.required = true;
					dReq.style.display = "block"
					break;
		}
	}
	function setPrice(item){
		var value = item.value;
		var PriceChange = document.getElementById("PriceChange");
		var pReq = document.getElementById("pReq");
		switch(value){
			case "1":
					PriceChange.required = false;
					pReq.style.display = "none";
					break;
			case "2":
					PriceChange.required=true;
					pReq.style.display = "block";
					break;
			case "3":
					PriceChange.required=true;
					pReq.style.display = "block";
					break;
			case "4":
					PriceChange.required=true;
					pReq.style.display = "block";
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
					<td> Select amount: </td>
					<td>
						<select id="amountSelector" name="amountSelector" onchange="selectAmount(this)">
							<option value="1">Individual</option>
							<option value="2">All</option>
						</select>
					</td>
				</tr> 
				<p>For multiply changes with increase checked, a value of 1.10 will increase the total price by 10%. 0.90 for 10% decrease.</p>
				<p>Non-multiply changes are flat dollar amount changes in the format X.XX.</p>
				<tr id="IDRow">
                    <td>Item's ID number<a title = "Required">*</a></td>
                    <td>
                        <input type="text" id="Item_ID" name="Item_ID" placeholder="XXXXX" pattern="[0-9]{0,12}" title="XXXX" required>
                    </td>
                </tr>
				<tr>
                    <td>Price change value<a id = "pReq" title = "Required" style="display: none">*</a></td>
                    <td>
                        <input type="text" id = "PriceChange" name="PriceChange" placeholder="0.00" pattern="[0-9]{0,10}\.[0-9]{2}" title="XXX.XX" >
						<td>
							<select id = "changePrice" name="changePrice" onchange="setPrice(this)">
								<option value="1">Don't Change</option>
								<option value="2">Increase</option>
								<option value="3">Decrease</option>
								<option value="4">Multiply</option>
							</select>
							<select id = "changePriceMulti" name="changePriceMulti" onchange="setPrice(this)" style="display: none">
								<option value="2">Increase</option>
								<option value="3">Decrease</option>
								<option value="4">Multiply</option>
							</select>
						</td>
                    </td>
                </tr>
				<tr id="DescriptionRow">
                    <td>Item's Description<a id = "dReq" title = "Required" style="display: none">*</a></td>
                    <td>
                        <input type="text" id="Description" name="Description" placeholder="Enter a description" pattern="[a-zA-Z0-9.,!? :]{0,255}" title="A simple description of the item.">
						<td>
							<select id = "changeDescription" name="changeDescription" onchange="setDescription(this)">
								<option value="1">Don't Change</option>
								<option value="2">Change This</option>
							</select>
						</td>
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
							$amountSelector = (int)$_POST["amountSelector"];
							$Item_id = mysqli_real_escape_string($link, $_POST['Item_ID']);
							$PriceChange = (float)$_POST['PriceChange'];
							$Description = mysqli_real_escape_string($link, $_POST['Description']);
							$changeDescription = (int)$_POST['changeDescription'];
							$changePrice = (int)$_POST['changePrice'];
							$changePriceMulti = (int)$_POST['changePriceMulti'];
							switch($itemType){
								case 1:
										$itemType = "book";
										break;
								case 2:
										$itemType = "film";
										break;
								case 3:
										$itemType = "periodical";
										break;
							}
							
							switch($amountSelector){
								case 1: //if we are editing a single item
										$sql = "SELECT * FROM `items` WHERE `Item_id` = $Item_id;";//look up its price by the item id
										$result = mysqli_query($link, $sql);
										$row = mysqli_fetch_assoc($result);
										$oldPrice = $row["Price"];//old price
										$sql = "UPDATE `items` SET ";//start every update query the same
										if($changeDescription == 2){
											$sql = $sql . "`Description` = '$Description'";//update the description, if the user chose to
											if($changePrice != 1){//if they also wanted to change the price
												switch($changePrice){
													case 2: //flat increase in price
															$NewPrice = $oldPrice + $PriceChange;
															$NewPrice = number_format($NewPrice,2);
															break;
													case 3: //flat decrease in price
															$NewPrice = $oldPrice - $PriceChange;
															$NewPrice = number_format($NewPrice,2);
															break;
													case 4: //multiply price
															$NewPrice = $oldPrice * $PriceChange;
															$NewPrice = number_format($NewPrice,2);
															break;
												}
												$sql = $sql . ", `Price` = '$NewPrice' WHERE `Item_id` = '$Item_id';";
											}
											break;
										}elseif($changePrice != 1){
											switch($changePrice){//if the price is being updated but the description isn't'
												case 2: //flat increase in price
														$NewPrice = $oldPrice + $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
												case 3: //flat decrease in price
														$NewPrice = $oldPrice - $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
												case 4: //multiply price
														$NewPrice = $oldPrice * $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
											}
											$sql = $sql . "`Price` = '$NewPrice' WHERE `Item_id` = $Item_id;";
											$result = mysqli_query($link,$sql);
											if($result){
												echo "Item was successfully added to the database.";
											}else{
												echo "Query Failed itemType $itemType: $sql";
											}
										}
										break;
								case 2://all items of type $itemType
										$sql = "SELECT * FROM `items` WHERE `Item_type` = '$itemType';";//look up all items of chosen type
										$result = mysqli_query($link,$sql);
										$num_rows = mysqli_num_rows($result);
										while($row = mysqli_fetch_assoc($result)){//for each item found
											$Item_id = $row["Item_id"];//use that item's id
											$oldPrice = $row["Price"];//and calculate a new price from the old one
											switch($changePriceMulti){//if the price is being updated but the description isn't'
												case 2: //flat increase in price
														$NewPrice = $oldPrice + $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
												case 3: //flat decrease in price
														$NewPrice = $oldPrice - $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
												case 4: //multiply price
														$NewPrice = $oldPrice * $PriceChange;
														$NewPrice = number_format($NewPrice,2);
														break;
											}//and update the item with item id = $Item_id to the new price.
											$sql = "UPDATE `items` SET `Price` = '$NewPrice' WHERE `Item_id` = $Item_id;";
											mysqli_query($link,$sql);
										}
										break;
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