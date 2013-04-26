<?php
	require ("db_connect.php");
	create_product();
	create_category();
	create_order();
	create_order_item();
	create_cart();
	add_f_keys();
	mysql_close($connection);

	function create_product() {
		$sql_query = "CREATE TABLE tbl_product(
			p_id int(11) UNSIGNED NOT NULL auto_increment,
			c_id int(11) UNSIGNED NOT NULL,
			p_name varchar(255) NOT NULL,
			p_details text NOT NULL,
			p_price decimal (7,2) NOT NULL,
			p_quantity smallint UNSIGNED NOT NULL,
			p_image varchar(255) NOT NULL,
			p_date date NOT NULL,
			p_last_update datetime NOT NULL,
			
			PRIMARY KEY(p_id),
			UNIQUE KEY p_name(p_name)
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
			c_id int(11) UNSIGNED NOT NULL auto_increment,
			c_name varchar(255) NOT NULL,
			c_details text NOT NULL,
			c_image varchar(255) NOT NULL,

			PRIMARY KEY(c_id),
			UNIQUE KEY(c_name)
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
			o_id int(11) UNSIGNED NOT NULL auto_increment,
			o_date datetime NOT NULL,
			o_last_update datetime NOT NULL,
			o_status varchar(50) NOT NULL,
			o_first_name varchar(50) NOT NULL,
			o_last_name varchar(50) NOT NULL,
			o_phone varchar(25) NOT NULL,
			o_address_street varchar(50) NOT NULL,
			o_address_city varchar(25) NOT NULL,
			o_address_postcode varchar(10) NOT NULL,
			o_address_country varchar(25) NOT NULL,

			PRIMARY KEY(o_id)
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
			p_id int(11) UNSIGNED NOT NULL,
			o_id int(11) UNSIGNED NOT NULL,
			o_quantity int(11) UNSIGNED NOT NULL,

			PRIMARY KEY(p_id, o_id)
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
			ca_id int(11) UNSIGNED NOT NULL auto_increment,
			p_id int(11) UNSIGNED NOT NULL,
			ca_session_id varchar(255) NOT NULL,
			ca_quantity int(11) NOT NULL DEFAULT 1,
			ca_date datetime NOT NULL,

			PRIMARY KEY (ca_id)
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
			ADD FOREIGN KEY (c_id)
			REFERENCES tbl_category (c_id)";

		if(!mysql_query($sql_query)) {
			echo "product to category fk has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_order_item
			ADD FOREIGN KEY (p_id)
			REFERENCES tbl_product (p_id)";

		if(!mysql_query($sql_query)) {
			echo "order items fk1 has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_order_item
			ADD FOREIGN KEY (o_id)
			REFERENCES tbl_order (o_id)";

		if(!mysql_query($sql_query)) {
			echo "order items fk2 has failed" . mysql_error();
		}

		$sql_query = "ALTER TABLE tbl_cart
			ADD FOREIGN KEY (p_id)
			REFERENCES tbl_product (p_id)";

		if(!mysql_query($sql_query)) {
			echo "cart table foreign key failed.";
		}

	}
?>