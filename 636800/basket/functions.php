<?php
	session_start();
?>

<?php

	function edit_quantity() {
		if(isset($_POST['quantity_number']) && isset($_POST['quantity_id'])) {
				$new_quantity = $_POST['quantity_number'];
				$new_quantity = preg_replace('#[^0-9]#', "", $new_quantity);
				if($new_quantity < 1) {
					$new_quantity = 1;	
				}
				$edit_id = $_POST['quantity_id'];
				$counter = 0;
				
				foreach($_SESSION['basket'] as $item) {
					while(list($key, $value) = each($item)) {		
						if($key == "item_id" && $value == $edit_id) {
							array_splice($_SESSION['basket'], $counter, 1, array(array("item_id" => $edit_id, "quantity" => $new_quantity)));
						}//end if
					}// end while
					$counter++;		
				}//end foreach
		}//end if
	}
	
	function delete_item() {
		if(isset($_POST['delete_item_index']) && $_POST['delete_item_index'] != "") {
			$delete_index = $_POST['delete_item_index'];
			if(count($_SESSION['basket']) <= 1) {
				unset($_SESSION['basket']["$delete_index"]);
			}
			else {
				unset($_SESSION['basket']["$delete_index"]);
				sort($_SESSION['basket']);	
			}
		}
		
	}
	
	function display_basket_items() {
		
		if(!isset($_SESSION['basket']) || count($_SESSION['basket']) < 1) {
			$html = "<p>Your basket is empty.<a href='/636800/'>click here to go back to the home page</a></p>\n";
			return $html;
		}
		else {
			$counter = 0;
			include_once('../common/db_config.php');
			$db = new MySQLi($db_host, $db_username, $db_password, $db_database);
			$html = "<table id='basket_items_table'>";
			$html .= "	<tr>";
			$html .= "		<th>Image</th>";
			$html .= "		<th>Item</th>";
			$html .= "		<th>Price</th>";
			$html .= "		<th>Quantity</th>";
			$html .= "		<th>Total Cost</th>";
			$html .= "		<th>Remove</th>";
			$html .= "	</tr>";
			
			$product_total_cost = 0;
			$total_cost = 0;
			foreach($_SESSION['basket'] as $item) {
				$item_id = $item['item_id'];
				$sql = "SELECT p_name, p_price, p_image FROM tbl_product WHERE p_id=$item_id LIMIT 1";
				$result = $db->query($sql);
				if(!$result) die("query unsuccessful. " . $db->error);
				
				if($result->num_rows > 0) {
					while($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$product_name = $row['p_name'];
						$product_price = $row['p_price'];
						$product_image = $row['p_image'];
						$product_total_cost = ($product_price * $item['quantity']);
					}
				}
				
				$product_total_cost = number_format($product_total_cost, 2);
				$total_cost += $product_total_cost;
				$html .= "	<tr name='row_id_$item_id'>";
				$html .= "		<td><a href='/636800/product/index.php?product_id=$item_id'><img src='$product_image' width='150px' height='150px'/></a></td>";
				$html .= "		<td>$product_name</td>";
				$html .= "		<td class='basket_text_right'>£$product_price</td>";
				$html .= "		<td><form action='/636800/basket/index.php' method='POST'>\n"; 
				$html .= "				<input class='basket_update_quantity' type='text' maxlength='2' name='quantity_number' value='" . $item['quantity'] . "'></input>\n";
				$html .= "				<input type='hidden' name='quantity_id' value='$item_id'></input>\n";
				$html .= "				<input type='submit' value='Update' ></input>\n";
				$html .= "			</form></td>\n";
				$html .= "		<td class='basket_text_right'>£$product_total_cost</td>";
				$html .= "		<td><form action='/636800/basket/index.php' method='POST'>";
				$html .= "				<input type='hidden' name='delete_item_index' value='$counter'></input>";
				$html .= "				<input type='submit' value='Delete'></input>";
				$html .= "			</form></td>";
				$html .= "	</tr>";
				$counter++;	
			}
			
			$html .= "</table>";
			$total_cost = number_format($total_cost, 2);
			$html .= "<div id='basket_total_cost'><h2>Total: £$total_cost</h2></div>";
			return $html;
		}
		$db->close();
	}

?>