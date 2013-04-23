<?php
	delete_category();
	
	// This is a function that allows a category to be deleted by retrieving a $_POST request.
	// ----------------------------------- At the moment there is an error due to it being a foreign key in the products table -----------
	function delete_category() {
		if(isset($_POST['delete_id'])) {
			$delete_id = (int)$_POST['delete_id'];
			$root = $_SERVER['DOCUMENT_ROOT'];
			$config_file = $root . "/636800/admin/common/db_config.php";
			require $config_file;
			
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno > 0) die("unable to connect to mysql" . $db->connect_error);
			
			$sql = "DELETE FROM tbl_category WHERE c_id=$delete_id";
			$result = $db->query($sql);
			if(!$result) die("Query Unsuccessful" . $db->error);
			
			echo ("category has been deleted");	
			$db->close();
		}
	}
?>