<?php
	$search_string = $_GET['search_string'];
	if(isset($_GET['category_name'])) {
		$category_name = $_GET['category_name'];	
	}

	$root = $_SERVER['DOCUMENT_ROOT'];
	$config_file = $root . "/636800/common/db_config.php";
	require $config_file;

	//connecting to the database
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno > 0) die("unable to connect to mysql." . $db->connect_error);

	//Create an sql string to retrieve the products from the database.
	if(isset($_GET['category_name'])) {
		$sql = "SELECT p_id, p_name, c_name, p_details, p_price, p_quantity, p_image FROM tbl_product, tbl_category WHERE tbl_product.c_id=tbl_category.c_id AND tbl_category.c_name='$category_name' AND tbl_product.p_name LIKE '%$search_string%'";	
	}
	else {
		$sql = "SELECT p_id, p_name, c_name, p_details, p_price, p_quantity, p_image FROM tbl_product, tbl_category WHERE tbl_product.c_id=tbl_category.c_id AND tbl_product.p_name LIKE '%$search_string%'";
	}
	
	$result = $db->query($sql);
	if(!$result) die("Query unsuccessful. " . $db->error);
	
	$html = "<ul>";
	if($result->num_rows > 0) {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$html .= "<li id='pid" . $row['p_id'] . "'>"; 
			

			$html .= "	<div class='product_image'>";
			$html .= "		<a href='/636800/product/index.php?product_id=" . $row['p_id'] . "'><img src='" . $row['p_image'] . "' height='150' width='150' /></a>"; 	
			$html .= "	</div>";
			$html .= "	<div class='product_name'>";
			$html .= "		<a href='/636800/product/index.php?product_id=" . $row['p_id'] . "'>" . $row['p_name'] . "</a>";
			$html .= "	</div>"; 
			$html .= "	<div class='product_price'>"; 
			$html .= "		<p>" . $row['p_price'] . "</p>"; 
			$html .= "	</div>";
			$html .= "	<div class='category_name'>";
			$html .= "		<p>" . $row['c_name'] . "</p>";
			$html .= "	</div>";
			$html .= "</li>";
		}
	}
	$html .= "</ul>";

	
	echo $html;





?>