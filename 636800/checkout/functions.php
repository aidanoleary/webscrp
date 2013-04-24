<?php
	session_start('basket');
?>
<?php

	//This is a function that checks if a post request has been receieved if it hasn't a form is generated.
	//If a post request has been received the customers order is set up the in the sql database, 
	//their basket is cleared and they are informed their order has been processed.
	function checkout_form() {
		if((isset($_POST['first_name']) 
			&& isset($_POST['surname']) 
			&& isset($_POST['phone'])
			&& isset($_POST['street'])
			&& isset($_POST['city'])
			&& isset($_POST['postcode'])
			&& isset($_POST['country'])
			&& isset($_SESSION['basket'])
			&& count($_SESSION['basket']) > 0)) {

			include('../common/db_config.php');
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	                if($db->connect_errno > 0) die ("unable to connect to the database." . $db->connect_error);

			$firstname = $db->escape_string($_POST['first_name']);
			$lastname = $db->escape_string($_POST['surname']);
			$phone = $db->escape_string($_POST['phone']);
			$street = $db->escape_string($_POST['street']);
			$city = $db->escape_string($_POST['city']);
			$postcode = $db->escape_string($_POST['postcode']);
			$country = $db->escape_string($_POST['country']);
	                $date = "now()";
	                $status = "pending";

			$sql1 = "INSERT INTO tbl_order(o_date, o_last_update, o_status, o_first_name,
	                        o_last_name, o_phone, o_address_street, o_address_city, o_address_postcode,
	                        o_address_country) VALUES($date, $date, '$status', '$firstname', '$lastname', '$phone',
	                        '$street', '$city', '$postcode', '$country')";
	                
	       	$result = $db->query($sql1);
	                
	                
	        $order_id = $db->insert_id;
	        if(!$result) die ("query unsuccessful." . $db->error);
	                
	        if(isset($_SESSION['basket']) && count($_SESSION['basket']) > 0) {
	        	$sql2 = "";
	            foreach($_SESSION['basket'] as $item) {
	                    $item_id = $item['item_id'];
	                    $quantity = $item['quantity'];
	                    $sql2 = "INSERT INTO tbl_order_item(p_id, o_id, o_quantity) VALUES ($item_id, $order_id, $quantity)";
	                    $result = $db->query($sql2);
	                    if(!$result) die ("query unsuccessful." . $db->error);
	            }
	                    
	       	}
	                
	        $db->close();
	        unset($_SESSION['basket']);
			$html = "<h2>Your ordered has been processed and your basket has been emptied.</h2> <a href='/636800/'>return to Homepage</a>\n";
			return $html;
		}
		else if(isset($_SESSION['basket']) && count($_SESSION['basket']) > 0) {
			$html = "<form id='checkout_form' action='/636800/checkout/index.php' method='post' onsubmit='return validate()'>\n";
			$html .= "	<fieldset>\n";
			$html .= "		<legend>Checkout Form</legend>\n";
			$html .= "		<p><label>First Name:</label><input type='text' name='first_name'></input></p>\n";
			$html .= "		<p><label>Surname:</label><input type='text' name='surname'></input></p>\n";
			$html .= "		<p><label>Telephone Number:</label><input type='text' name='phone'></input></p>\n";
			$html .= "		<fieldset>\n";
			$html .= "			<legend>Address</legend>\n";
			$html .= "			<p><label>Street</label><input type='text' name='street'></input></p>\n";
			$html .= "			<p><label>City</label><input type='text' name='city'></input></p>\n";
			$html .= "			<p><label>Postcode:</label><input type='text' name='postcode'></input></p>\n";
			$html .= "			<p><label>Country:</label><div id='checkout_countries'></div></p>\n";
			$html .= "		</fieldset>\n";
			$html .= "		<input type='submit' value='submit' class='submit_button1'></input>\n";
			$html .= "	</fieldset>\n";
			$html .= "</form>\n";
			return $html;
		}
		else {
			$html = "<p>You haven't got any items in your basket.</p> <a href='/636800/'>return to Homepage</a>\n";
			return $html;
		}
	}
?>