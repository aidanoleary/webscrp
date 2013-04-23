<?php
	require ("db_connect.php");
	create_product();
	create_category();
	create_order();
	create_order_item();
	create_cart();
	add_f_keys();

	function create_product() {
		$sql_query = "CREATE TABLE tbl_product(
			product_id int(11) UNSIGNED NOT NULL auto_increment,
			category_id int(11) UNSIGNED NOT NULL,
			product_name varchar(255) NOT NULL,
			product_details text NOT NULL,
			product_price decimal (7,2) NOT NULL,
			product_quantity smallint UNSIGNED NOT NULL,
			product_image varchar(255) NOT NULL,
			product_date date NOT NULL,
			product_last_update datetime NOT NULL,
			
			PRIMARY KEY(product_id),
			UNIQUE KEY product_name(product_name)
		)";
	
		if(mysql_query($sql_query)) {
			echo "tbl_product table created successfully. <br />";
		}
		else {
			echo "unable to create products table <br />";
		}
	}

	function create_category() {
		$sql_query = "CREATE TABLE tbl_category(
			category_id int(11) UNSIGNED NOT NULL auto_increment,
			category_parent_id int(11) UNSIGNED NOT NULL,
			category_name varchar(255) NOT NULL,
			category_details text NOT NULL,
			category_image varchar(255) NOT NULL,

			PRIMARY KEY(category_id),
			UNIQUE KEY(category_name)
		)";

		if(mysql_query($sql_query)) {
			echo "tbl_category table created successfully. <br />";
		}

		else {
			echo "unable to create category table <br />";
		}
	}

	function create_order() {
		$sql_query = "CREATE TABLE tbl_order(
			order_id int(11) UNSIGNED NOT NULL auto_increment,
			order_date datetime NOT NULL,
			order_last_update datetime NOT NULL,
			order_status varchar(50) NOT NULL,
			order_first_name varchar(50) NOT NULL,
			order_last_name varchar(50) NOT NULL,
			order_phone varchar(25) NOT NULL,
			order_address_street varchar(50) NOT NULL,
			order_address_city varchar(25) NOT NULL,
			order_address_postcode varchar(10) NOT NULL,
			order_address_country varchar(25) NOT NULL,

			PRIMARY KEY(order_id)
		)";

		if(mysql_query($sql_query)) {
			echo "tbl_order table created successfully. <br />";
		}

		else {
			echo "unable to create order table <br />";
		}
	}

	function create_order_item() {
		$sql_query = "CREATE TABLE tbl_order_item(
			product_id int(11) UNSIGNED NOT NULL,
			order_id int(11) UNSIGNED NOT NULL,
			order_quantity int(11) UNSIGNED NOT NULL,

			PRIMARY KEY(product_id, order_id)
		)";
		if(mysql_query($sql_query)) {
			echo "tbl_order_item table created successfully. <br />";
		}

		else {
			echo "unable to create order item table <br />";
		}
	}

	function create_cart() {
		$sql_query = "CREATE TABLE tbl_cart(
			cart_id int(11) UNSIGNED NOT NULL auto_increment,
			product_id int(11) UNSIGNED NOT NULL,
			cart_session_id varchar(255) NOT NULL,
			cart_quantity int(11) NOT NULL DEFAULT 1,
			cart_date datetime NOT NULL,

			PRIMARY KEY (cart_id)
		)";
		if(mysql_query($sql_query)) {
			echo "tbl_cart table created successfully. <br />";
		}

		else {
			echo "unable to create cart table <br />";
		}
	}

	function add_f_keys() {
		$sql_query = "ALTER TABLE tbl_product
			ADD FOREIGN KEY (category_id)
			REFERENCES tbl_category (category_id)";

		if(!mysql_query($sql_query)) {
			echo "product to category fk has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_category
			ADD FOREIGN KEY (category_parent_id)
			REFERENCES tbl_category (category_id)";

		if(!mysql_query($sql_query)) {
			echo "parent category fk has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_order_item
			ADD FOREIGN KEY (product_id)
			REFERENCES tbl_product (product_id)";

		if(!mysql_query($sql_query)) {
			echo "order items fk1 has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_order_item
			ADD FOREIGN KEY (order_id)
			REFERENCES tbl_order (order_id)";

		if(!mysql_query($sql_query)) {
			echo "order items fk2 has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_cart
			ADD FOREIGN KEY (product_id)
			REFERENCES tbl_product (product_id)";

		if(!mysql_query($sql_query)) {
			echo "cart table foreign key failed.";
		}

	}
?>