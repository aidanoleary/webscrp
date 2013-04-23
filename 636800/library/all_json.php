<?php

	$list = array();
	$root = $_SERVER['DOCUMENT_ROOT'];
	$config_file = $root . "/636800/common/db_config.php";
	require $config_file;

	//connecting to the database
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno > 0) die("unable to connect to mysql." . $db->connect_error);

	//Create an sql string to retrieve the products from the database.
	$sql = "SELECT p_id, p_name, c_name, p_details, p_price, p_quantity, p_image FROM tbl_product, tbl_category WHERE tbl_product.c_id = tbl_category.c_id";
	$result = $db->query($sql);
	if(!$result) die("Query unsuccessful. " . $db->error);

	if($result->num_rows > 0) {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$product = array(
				'id' => $row['p_id'],
				'name' => $row['p_name'],
				'category' => $row['c_name'],
				'details' => $row['p_details'],
				'price' => $row['p_price'],
				'image' => $row['p_image']
			);
			array_push($list, $product);
		}
	}

	$json = json_encode($list);
	echo $json;
?>