<?php
	// ********************************** there are errors somewhere in this ************************************************
	//This is a file that will be used to display all the products in the system.
	
	view_products();
	
	function view_products() {
        $root = $_SERVER['DOCUMENT_ROOT'];
        $config_location = $root . "/636800/admin/common/db_config.php";
		require $config_location;
	
		//Create the initial parts of the table
		$table = "<table id='product_table'>\n";
		$table .= "<tr>";
		$table .= "<th>ID</th>\n";
		$table .= "<th>Name</th>\n";
		$table .= "<th>Category</th>\n";
		$table .= "<th>Details</th>";
		$table .= "<th>Price</th>\n";
		$table .= "<th>Quantity</th>\n";
		$table .= "<th>Last Update</th>\n";
		$table .= "<th>Options</th>\n";
		$table .= "</tr>\n";
	
	
	
		//connecting to the database
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno > 0) die("unable to connect to mysql." . $db->connect_error);
	
		//Create an sql query string which will gather all the data from the products table.
		$sql = "SELECT p_id, p_name, c_name, p_details, p_price, p_quantity, p_last_update FROM tbl_product, tbl_category WHERE tbl_product.c_id = tbl_category.c_id";
		$result = $db->query($sql);
		if(!$result) die("query unsuccessful. " . $db->error);
	
		if($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$product_id = $row['p_id'];
				
				$table .= "<tr>\n";
				$table .= "<td>" . $row['p_id'] . "</td>\n";
				$table .= "<td>" . $row['p_name'] . "</td>\n";
				$table .= "<td>" . $row['c_name'] . "</td>\n";
				$table .= "<td>" . $row['p_details'] . "</td>\n";
				$table .= "<td>" . $row['p_price'] . "</td>\n";
				$table .= "<td>" . $row['p_quantity'] . "</td>\n";
				$table .= "<td>" . $row['p_last_update'] . "</td>\n";
				$table .= "<td><button type='button' value=$product_id class='delete_button' onclick='deleteProduct(this)'>Delete</button>
						   <button type='button' value=$product_id class='edit_button' onclick='editProduct(this)'>Edit</button></td>\n";
				$table .= "</tr>\n";
			}
		}
		$table .= "</table>\n";
		echo $table;
		$db->close();
	}



?>