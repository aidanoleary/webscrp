<?php
	// This is a file that will be used to display the categories
	// on the view category page.
	view_categories();
	
	
	function view_categories() {
		$root = $_SERVER['DOCUMENT_ROOT'];
		$config_file = $root . "/636800/admin/common/db_config.php";
		require $config_file;
		
		//Create the initial parts of the table.
		$table = "<table id='category_table'>\n";
		$table .= "<tr>\n";
		$table .= "<th>Category ID</th>\n";
		$table .= "<th>Name</th>\n";
		$table .= "<th>Details</th>\n";
		$table .= "<th>Options</th>\n";
		$table .= "</tr>\n";
		
		//Connect to the mysql database
		$db = new MySQLi($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno > 0) die("unable to connect to mysql" . $db->connect_error);
		
		//Create an sql query to retrieve the catagory data.
		$sql = "SELECT c_id, c_name, c_details FROM tbl_category";
		$result = $db->query($sql);
		if(!$result) die("Query Unsuccessful" . $db->error);
		
		//Use a while loop to input the retrieved data into a table.
		// ----------------------------- This may have to be changed -------------------
		if($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$category_id = $row['c_id'];
				
				$table .= "<tr>\n";
				$table .= "<td>" . $row['c_id'] . "</td>\n";
				$table .= "<td>" . $row['c_name'] . "</td>\n";
				$table .= "<td>" . $row['c_details'] . "</td>\n";
				$table .= "<td><button type='button' value=$category_id class='delete_button' onclick='deleteCategory(this)'>Delete</button></td>\n";
				$table .= "</tr>\n";
			}
		}
		$table .= "</table>\n";
		echo $table;
		$db->close();
	}
	

?>