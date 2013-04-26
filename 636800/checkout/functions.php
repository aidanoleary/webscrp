<?php
	session_start('basket');
?>
<?php
	
	//This file contains all the functions that deal with the processing of the form containing the customers
	//details. 

	//This is a function that deals with the server side validation of customer form.
	//If the form is valid the database tables will be updated to reflect the customers order
	//otherwise an appropiate error message is displayed.  
	function checkout_form() {
                $html = "";
		if((isset($_POST['first_name']) 
			&& isset($_POST['surname']) 
			&& isset($_POST['phone'])
			&& isset($_POST['street'])
			&& isset($_POST['city'])
			&& isset($_POST['postcode'])
			&& isset($_POST['country'])
			&& isset($_SESSION['basket'])
			&& count($_SESSION['basket']) > 0)) {
				
				//create the validation variable which notifies the user where they have made a mistake
				$fail = validateFirstname($_POST['first_name']);
				$fail .= validateSurname($_POST['surname']);
				$fail .= validatePhone($_POST['phone']);
				$fail .= validateStreet($_POST['street']);
				$fail .= validateCity($_POST['city']);
				$fail .= validatePostcode($_POST['postcode']);
				$fail .= validateCountry($_POST['country']);

				if($fail == "") {
					//Connect to the database
					$root = $_SERVER['DOCUMENT_ROOT'];
					$config_file = $root . "/636800/common/db_config.php";
					require $config_file;
					$db = new mysqli($db_host, $db_username, $db_password, $db_database);
					if($db->connect_errno > 0) die ("unable to connect to the database." . $db->connect_error);

					//Gather variables from the form.
					$firstname = $db->escape_string($_POST['first_name']);
					$lastname = $db->escape_string($_POST['surname']);
					$phone = $db->escape_string($_POST['phone']);
                                        $street = $db->escape_string($_POST['street']);
                                        $city = $db->escape_string($_POST['city']);
                                        $postcode = $db->escape_string($_POST['postcode']);
                                        $country = $db->escape_string($_POST['country']);
                                        
                                        $date = "now()";
                                        $status = "pending";

                                        


                                        
                                        //Set up and perform the sql query.
                                        $sql1 = "INSERT INTO tbl_order(o_date, o_last_update, o_status, o_first_name,
                                        o_last_name, o_phone, o_address_street, o_address_city, o_address_postcode,
                                        o_address_country) VALUES($date, $date, '$status', '$firstname', '$lastname', '$phone',
                                        '$street', '$city', '$postcode', '$country')";
                                        
                                        $result = $db->query($sql1);
					if(!$result) die ("query unsuccessful." . $db->error);
                                        
                                        $order_id = $db->insert_id;
                                        if(!$result) die ("query unsuccessful." . $db->error);


                                        //Loop section to insert the the order into the order item table and update quantity.
                                        if(isset($_SESSION['basket']) && count($_SESSION['basket']) > 0) {
                                            $sql2 = "";
                                            foreach($_SESSION['basket'] as $item) {
                                                    $item_id = $item['item_id'];
                                                    $quantity = $item['quantity'];

                                                    //sql statement that updates the quantity of items to reflect the order
                                                    $sql_update_quantity = "UPDATE tbl_product SET p_quantity=p_quantity-$quantity";
                                                    $result = $db->query($sql_update_quantity);
                                                    if(!$result) die ("query unsuccessful." . $db_error);

                                                    $sql2 = "INSERT INTO tbl_order_item(p_id, o_id, o_quantity) VALUES ($item_id, $order_id, $quantity)";
                                                    $result = $db->query($sql2);
                                                    if(!$result) die ("query unsuccessful." . $db->error);
                                            }//end foreach
                                        }//end if
                                        
                                        $db->close();
                                        unset($_SESSION['basket']);
                                        $html = "<h2>Your order has been submitted and your basket has been emptied.</h2> <a href='/636800/'>return to homepage</a>\n";
                                        return $html;
                                }//end if
                                else {
                                    //Display the error message if the user enters something they aren't supposed to.
                                    $html = "<h2>Your order has failed for the following reasons. $fail</h2> <a href='/636800/checkout/'>return to checkout page</a>";
                                    return $html;
                                }
                        }
                        else {
                            $html = "<h2>An error occured.</h2> <a href='/636800/'>return to homepage</a>\n";
                            return $html;
                        }
    }//end function
	
	//Validation functions
	// ************************************
	
	//**************************************** complete validation
	
	function validateFirstname($field) {
		if(empty($field)) {
			return "You haven't entered a firstname.";	
		}
		elseif(preg_match("/[^A-Za-z' ]/", $field)) {
			return "The firstname you entered was invalid. Only letters can be entered.";	
		}
		else {
			return "";	
		}
	}
	
	function validateSurname($field) {
		if(empty($field)) {
			return "You haven't entered a surname.";	
		}
		elseif(preg_match("/[^A-Za-z' ]/", $field)) {
			return "The surname you entered was invalid. Only letters can be entered.";
		}
		else {
			return "";	
		}	
	}
	
	function validatePhone($field) {
		if(preg_match("/[^0-9]/", $field)) {
			return "<p>You haven't entered a valid phone number.</p>";	
		}
		elseif(empty($field)) {
			return "<p>You haven't entered a phone number.</p>";
		}
		else {
			return "";	
		}
	}
	
	function validateStreet($field) {
		if(empty($field)) {
			return "You haven't entered a street.";	
		}
		elseif(preg_match("/[^A-Za-z0-9 ]/", $field)) {
			return "You haven't entered a valid street.";	
		}
		else {
			return "";	
		}
	}
	
	function validateCity($field) {
		if(empty($field)) {
			return "You haven't entered a city.";	
		}
		elseif(preg_match("/[^A-Za-z ]/", $field)) {
			return "The city you entered was invalid. Only letters can be entered.";
		}
		else {
			return "";	
		}	
	}
	
	function validatePostcode($field) {
		if(empty($field)) {
			return "You haven't entered a postcode.";	
		}
		elseif(preg_match("/[^A-Za-z0-9 ]/", $field)) {
			return "The postcode you entered was invalid. Only letters can be entered.";	
		}
		else {
			return "";	
		}
		
	}

	function validateCountry($field) {
		if($field == '0') {
			return "You haven't selected a country.";
		}
		else {
			return "";
		}
	}
	
	//******************** maybe think about validating the country.
?>