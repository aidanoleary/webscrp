<?php
	$host = "127.0.0.1";
	$username = "root";
	$password = "";

	$connection = mysqli_connect("$host", "$username", "$password");
	if(!$connection) die("unable to connect to mysql " . mysqli_error());

	$database = mysqli_select_db(mysqli "shopping_db", $connection);
	if(!$database) die("unable to connect to shopping db " . mysqli_error());
?>