<?php
	//This is a php file that will be retrieved using Ajax to update the orders page every
	//5 seconds.
	view_orders();
	
	function view_orders() {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$config_location = $root . "/636800/admin/common/db_config.php";
		require $config_location;

		//Create the initial parts of the table
		$table = "<table id='orders_table'>\n";
		$table .= "<tr>";
		$table .= "<th>Order ID</th>\n";
		$table .= "<th>Date</th>\n";
		$table .= "<th>Status</th>\n";
		$table .= "<th>FirstName</th>";
		$table .= "<th>LastName</th>\n";
		$table .= "<th>Phone</th>\n";
		$table .= "<th>Street</th>\n";
		$table .= "<th>City</th>\n";
		$table .= "<th>Postcode</th>\n";
		$table .= "<th>Product ID</th>\n";
		$table .= "<th>Product Name</th>\n";
		$table .= "<th>Quantity</th>\n";
		$table .= "</tr>\n";

		//Connecting to the database
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno > 0) die("unable to connect to mysql." . $db->connect_error);

		//Create the sql query to retrieve the order details from the database.
		$sql = "SELECT * FROM tbl_order, tbl_order_item, tbl_product 
				WHERE tbl_order.o_id=tbl_order_item.o_id 
				AND tbl_product.p_id=tbl_order_item.p_id
                ORDER BY o_date DESC";

		$result = $db->query($sql);
		if(!$result) die("query unsuccessful. " . $db->error);

		if($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$table .= "<tr>\n";
				$table .= "<td>" . $row['o_id'] . "</td>\n";
				$table .= "<td>" . $row['o_date'] . "</td>\n";
				$table .= "<td>" . $row['o_status'] . "</td>\n";
				$table .= "<td>" . $row['o_first_name'] . "</td>\n";
				$table .= "<td>" . $row['o_last_name'] . "</td>\n";
				$table .= "<td>" . $row['o_phone'] . "</td>\n";
				$table .= "<td>" . $row['o_address_street'] . "</td>\n";
				$table .= "<td>" . $row['o_address_city'] . "</td>\n";
				$table .= "<td>" . $row['o_address_postcode'] . "</td>\n";
				$table .= "<td>" . $row['p_id'] . "</td>\n";
				$table .= "<td>" . $row['p_name'] . "</td>\n";
				$table .= "<td>" . $row['o_quantity'] . "</td>\n";


				$table .= "</tr>\n";
			}
		}
		$table .= "</table>\n";
		echo $table;
		$db->close();



	}







?>