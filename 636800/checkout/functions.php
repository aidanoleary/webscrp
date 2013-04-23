<?php
	session_start('basket');
?>
<?php
	if(isset($_POST['first_name']) 
		&& isset($_POST['surname']) 
		&& isset($_POST['phone'])
		&& isset($_POST['street'])
		&& isset($_POST['city'])
		&& isset($_POST['postcode'])
		&& isset($_POST['country'])) {

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
                
                //***************************************** need to get the last submitted order id from the database $db->last_submit pseudo
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
	}

?>