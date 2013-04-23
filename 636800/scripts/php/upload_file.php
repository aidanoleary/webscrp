<!-- not finished need to change to restrict file types **************** -->
<?php
	if ($_FILES["image"]["error"] > 0) {
		echo "Error: " . $_FILES["image"]["error"] . "<br />";
	}
	else {
		echo "Upload: " . $_FILES["image"]["name"] . "<br />";
		echo "Type: " . $_FILES["image"]["type"] . "<br />";
		echo "Size: " . $_FILES["image"]["size"] / 1024) . " kB<br />";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}
?>