<?php
	$page_title = "Orders Page";
	include_once("../common/admin_header.php");
	//include_once("./view_functions.php");
?>

		<div id="page_content">
			<h1 id="page_title">Orders</h1>
			<div id="information_1"><p>Update Information</p></div>
				<div id="orders"><p>Orders List is loading</p></div>
			</div>
			<script type="text/javascript" src="./view_order.js"></script>
<?php
	include_once("../common/admin_footer.php");
?>