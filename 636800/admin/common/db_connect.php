<?php
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$database = "shopping_db";

	$connection = mysql_connect($host, $username, $password);
	if(!$connection) die("unable to connect to mysql " . mysql_error());
	$selected_db = mysql_select_db($database);
	if(!$selected_db) die ("unable to connect to databse " . mysql_error());
	

?>