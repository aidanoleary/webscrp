<?php
	session_start();
?>
<?php
	if(isset($_GET['command']) && $_GET['command'] == "emptycart") {
		unset($_SESSION['basket']);	
	}
?>