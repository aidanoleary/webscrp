<?php
	delete_product();
	
	function delete_product() {
		if(isset($_POST['delete_id'])) {
			$delete_id = (int)$_POST['delete_id'];
            $root = $_SERVER['DOCUMENT_ROOT'];
            $config_file = $root . "/636800/admin/common/db_config.php";
			require $config_file;
			
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno > 0) die("unable to connect to mysql" . $db->connect_error);

            //Delete the old image from the database.
            $sql1 = "SELECT p_image FROM tbl_product WHERE p_id=$delete_id";
            $result1 = $db->query($sql1);
            if(!$result1) die("Query Unsuccessful" . $db->error);
            while($row = $result1->fetch_array(MYSQLI_ASSOC)) {
                $old_image = $row['p_image'];
            }
			if($old_image != "/636800/images/product/default.png") {
            	$old_image = $_SERVER['DOCUMENT_ROOT'] . $old_image;
            	unlink($old_image);
			}
            //Delete the product from the table.
			$sql2 = "DELETE FROM tbl_product WHERE p_id=$delete_id";
			$result2 = $db->query($sql2);
			if(!$result2) die("Query Unsuccessful" . $db->error);
			
			echo ("product has been deleted");	
			$db->close();
		}
	}




?>