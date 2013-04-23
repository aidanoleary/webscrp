<?php
	//This is a file that contains the functions that will allow a user to upload a category to the system.

	// This is a function that deals with uploading images to the server. 
	// It also returns the a string of where the image is located.
	function image_upload($location, $filename) {
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
				$location = "null";
				return $location;
			}
		}
		else {
			$location = "null";
			return $location;
		}
	}

	//A function that deals with the input from the add category form.
	function add_category() {
		if(isset($_POST['name']) && isset($_POST['details'])) {
			
				//Create the validation variable.
				$fail = validateName($_POST['name']);
				$fail .= validateDetails($_POST['details']);
			
			if($fail == "") {
				//connect to the database
            	$root = $_SERVER['DOCUMENT_ROOT'];
            	$config_file = $root . "/636800/admin/common/db_config.php";
				require $config_file;
				$db = new mysqli($db_host, $db_username, $db_password, $db_database);
				if($db->connect_errno > 0) die ("unable to connect to the database." . $db->connect_error);
						
				//Gather variables from the form.
				$name = $db->escape_string($_POST['name']);
				$details = $db->escape_string($_POST['details']);
				$image = image_upload("/636800/images/category/",$name);
				$sql = "INSERT INTO tbl_category (c_name, c_details, c_image) 
							VALUES ('$name', '$details', '$image')";
			
				$result = $db->query($sql);
				if(!$result) die("Query unsuccesful" . $db->error);
				$db->close();
			
				$message = "<p>Category has been added successfully.</p>\n";
				if($image == "null") $message = "<p>Category has been added, although no image was uploaded</p>\n";
				return $message;
			}
			else {
				$message = "<p>Failed to add a category.</p>" . $fail;
				return $message;
			}
		}
		
		else {
			$message = "<p>Enter the details for the category and click submit.</p>\n";
			return $message;
		}
	}
	
	//Validation functions
	//******************************************
	function validateName($field) {
		$message = (empty($field)) ? "<p>No name was entered.</p>" : "";
		return $message;
	}
	
	function validateDetails($field) {
		$message = (empty($field)) ? "<p>No details were entered.</p>" : "";
		return $message;	
	}




?>