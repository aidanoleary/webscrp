<?php
    // This is a php document that will contain all the functions that will allow a user to edit
    // a product that has been added to the system.

	// This is a function that deals with uploading images to the server. 
	// It also returns the a string of where the image is located.
	function image_upload($location, $filename) {
		$failLocation = $location;
		if(isset($_FILES['image'])) {
			$root = $_SERVER['DOCUMENT_ROOT'];
			$location = $location . $filename; 
			$image = $root . $location;
			
			switch($_FILES['image']['type']) {
				case 'image/jpeg': $ext = '.jpg'; break;
				case 'image/gif': $ext = '.gif'; break;
				case 'image/png': $ext = '.png'; break;
				case 'image/tiff': $ext = '.tif'; break;
				default: $ext = ''; break;
			}
			
			if($ext) {
				$image .= $ext;
				$location .= $ext;
				move_uploaded_file($_FILES['image']['tmp_name'], $image);
				return $location;
			}
			else {	
				$failLocation .= "default.png";
				return $failLocation;
			}
		}
		else {
			$failLocation .= "default.png";
			return $failLocation;
		}
	}

    // A function that retrieves the categories of the website, so they
	// can be turned into a drop down list.
	function category_selection() {
        $root = $_SERVER['DOCUMENT_ROOT'];
        $config_file = $root . "/636800/admin/common/db_config.php";
		require $config_file;
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno > 0) die("unable to connect to the database. " . $db->connect_error);
		$categories = "<select id='category_list' size='1' name='category'>";
		$categories .= "<option value='0' selected='selected'>select a category</option>\n";
		$sql = "select c_id, c_name FROM tbl_category ORDER BY c_name";
		
		$result = $db->query($sql);
		if(!$result) die("query unsuccessful." . $db->error);
		
		if($result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQLI_NUM)) {
				$categories .= "<option value=" . $row[0] . ">" . $row[1] . "</option>\n";									
			}
		}
		else {
			$categories .= "<option value=''>There are currently no categories.</option>\n"; 	
		}
								
		$categories .= "</select>";
		$db->close();
		return $categories;
	}

    
    // This is a function that will perform the update after a products has been edited using the form.
    function edit_product($product_id) {
		if(isset($_POST['name']) 
		&& isset($_POST['details']) 
		&& isset($_POST['price'])
		&& isset($_POST['quantity'])) {
			
			//Create the validation variable.
			$fail = validateName($_POST['name']);
			$fail .= validateDetails($_POST['details']);
			$fail .= validatePrice($_POST['price']);
			$fail .= validateQuantity($_POST['quantity']);
            $fail .= validateCategory($_POST['category']);
		
			if($fail == "") {
				// connect to the database
				$root = $_SERVER['DOCUMENT_ROOT'];
            	$config_file = $root . "/636800/admin/common/db_config.php";
            	require $config_file;
				$db = new mysqli($db_host, $db_username, $db_password, $db_database);
				if($db->connect_errno > 0) die ("unable to connect to the database." . $db->connect_error);
			
				// Gather variables from the form
				//$id = (int)($_POST['id']);
				$id = (int)($product_id);
				$category = ($_POST['category']);
				$name = $db->escape_string($_POST['name']);
				$details = $db->escape_string($_POST['details']);
				$price = floatval($db->escape_string($_POST['price']));
				$quantity = (int)($db->escape_string($_POST['quantity']));
				$image = image_upload("/636800/images/product/", $name);
				$date = "now()";
                
                //remove the old image from the server.
                $sql1 = "SELECT p_image FROM tbl_product WHERE p_id=$id";
                $result1 = $db->query($sql1);
                if(!$result1) die ("query unsuccessful." . $db->error);
                while($row = $result1->fetch_array(MYSQLI_ASSOC)) {
                    $old_image = $row['p_image'];
                }
				if($old_image != "/636800/images/product/default.png") {
                	$old_image = $_SERVER['DOCUMENT_ROOT'] . $old_image;
                	unlink($old_image);
				}

                
                //Update the product information.
				$sql2 = "UPDATE tbl_product SET c_id=$category, p_name='$name', p_details='details', p_price=$price, p_quantity=$quantity, p_image='$image', p_last_update=$date
						WHERE p_id=$id";
	
				$result2 = $db->query($sql2);
				if(!$result2) die ("query unsuccessful." . $db->error);
				$db->close();
				
				$message = "<p>Product has been edited successfully.</p>\n";
				return $message;
			}
			else {
				$message = "<p>Failed to edit a product.</p>" . $fail;
				return $message;
			}
		}
		else {
			$message = "<p>Enter the details for the Product and click submit.</p>\n";
			return $message;
		}		
	}
	
	//validation functions for the product form.
	//******************************************************
	
	//A function that validates the name field.
	function validateName($field) {
		$message = (empty($field)) ? "<p>No name was entered.</p>" : "";
		return $message;
	}
	
	function validateDetails($field) {
		$message = (empty($field)) ? "<p>No details were entered.</p>" : "";
		return $message;	
	}
	
	function validatePrice($field) {
		if(preg_match("/[^0-9]\./", $field)) {
			return "<p>You haven't entered a valid price. Only digits can be entered.</p>";	
		}
		elseif(empty($field)) {
			return 	"<p>You haven't entered a price.</p>";
		}
		else {
			return "";
		}
	}
	
	function validateQuantity($field) {
		if(preg_match("/[^0-9]/", $field)) {
			return "<p>You haven't entered a valid quantity. Only digits can be entered.</p>";	
		}
		elseif(empty($field)) {
			return 	"<p>You haven't entered a quantity.</p>";
		}
		else {
			return "";
		}	
	}

    function validateCategory($field) {
        $message = ($field == "0") ? "<p>No Category was selected.</p>" : "";
        return $message;

    }
?>