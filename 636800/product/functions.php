<?php
	function get_product() {
		if(isset($_GET['product_id'])) {
			$product_id = $_GET['product_id'];
			$root = $_SERVER['DOCUMENT_ROOT'];
			require($root . "/636800/common/db_config.php");
			$db = new MySQLi($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno > 0) die("Unable to connect to mysql. " . $db->connect_error);
			$sql = "SELECT p_id, p_name, c_name, p_price, p_image, p_details, p_quantity FROM tbl_product, tbl_category WHERE p_id=$product_id AND tbl_product.c_id = tbl_category.c_id";
			$result = $db->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$id = $row['p_id'];
					$name = $row['p_name'];
					$category = $row['c_name'];
					$price = $row['p_price'];
					$image = $row['p_image'];
					$details = $row['p_details'];
					$quantity = $row['p_quantity'];
				}
			}
			$db->close();
			$html = "<div id='product_info'><!-- start product_info -->\n";
			$html .= "	<div id='product_image'><!-- start product_image -->\n";
			$html .= "		<img src='$image' width='200px' height='200px' />\n";
			$html .= "	</div><!-- end product_image -->\n";
			$html .= "	<div class='info_wrapper'><!-- start info_wrapper -->\n";
			$html .= "		<div id='product_name'><!-- start product_name -->\n";
			$html .= "			<p>Product Name:</p>\n";
			$html .= "			<p>$name</p>\n";
			$html .= "		</div><!-- end product_name -->\n";
			$html .= "		<div id='product_category'><!-- start product_category -->\n";
			$html .= "			<p>Category</p>\n";
			$html .= "			<p>$category</p>\n";
			$html .= "		</div><!-- end product_category -->\n";
			$html .= "		<div id='product_price'><!-- start product_price -->\n";
			$html .= "			<p>Price:</p>\n";
			$html .= "			<p>$price</p>\n";
			$html .= "		</div><!-- end product_price -->\n";
			$html .= "		<div id='product_quantity'><!-- start product_quantity -->\n";
			$html .= "			<p>Quantity:</p>\n"; //initialises page
			$html .= "			<p>$quantity</p>\n";
			$html .= "		</div><!-- end product_quantity -->\n";
			$html .= "		<div id='basket_box'>\n";
			$html .= "			<button id='add_basket_button' name='$product_id'>Add to basket</button>\n";
			$html .= "			<button id='empty_basket_button'>Empty basket</button>";
			$html .= "			<p id='basket_update_info'></p>\n";
			$html .= "		</div>\n";
			$html .= "	</div><!-- end info_wrapper -->\n";
			$html .= "	<div id='product_details'><!-- start product_detail -->\n";
			$html .= "		<p>Details:</p>\n";
			$html .= "		<p>$details</p>\n";
			$html .= "	</div><!-- end product_detail -->\n";
			$html .= "</div><!-- end product_info -->\n";
			
			return $html;
		}
		else {
			$html = "<p>No product was selected</p>";
			$html .= "	<a href='/636800/'>Go Back to the home page</a>";
			return $html;	
		}
	}
	
	//A function that returns the name of the product.
	function get_name() {
		if(isset($_GET['product_id'])) {
			$root = $_SERVER['DOCUMENT_ROOT'];
			$product_id = $_GET['product_id'];
			require($root . "/636800/common/db_config.php");
			$db = new MySQLi($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno > 0) die("Unable to connect to mysql. " . $db->connect_error);
			$sql = "SELECT p_name FROM tbl_product WHERE p_id=$product_id";
			$result = $db->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$product_name = $row['p_name'];
				}
			}
			$db->close();
			return $product_name;
		}
		else {
			$product_name = "Name hasn't been set.";
			return $product_name;	
		}
		
	}






?>