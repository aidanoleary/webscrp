<?php
	$product_id = $_GET['product_id'];

	//connect to the database
	$config_file = $_SERVER['DOCUMENT_ROOT'] . "/636800/common/db_config.php";
	require_once("$config_file");
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno > 0) die("unable to connect to mysql." . $db->connect_error);

	//Create the query
	$sql = "SELECT p_quantity FROM tbl_product WHERE tbl_product.p_id=$product_id";
	$result = $db->query($sql);

	//Collect query result into a variable.
	$quantity = 0;
	if(!$result) die("query unsuccessful. " . $db->error);
	
	if($result->num_rows > 0) {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$quantity = $row['p_quantity'];
		}
	}

	//close connection and echo results.
	$quantity_string = "<p>Quantity:</p>\n" . "<p>" . $quantity . "</p>\n";
	echo($quantity_string);

	$db->close();

?>