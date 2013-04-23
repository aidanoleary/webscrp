<?php
	include('./functions.php');
	//This function needs to go first so basket is updated before it's displayed.
	delete_item();
	edit_quantity();
	$basket_table = display_basket_items();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Basket</title>
<link href="/636800/css/main.css" rel="stylesheet" type=text/css />
</head>
<body>

	<div class="main_wrapper"><!-- start main_wrapper -->
		<?php include('../common/header.php'); ?>
        <div class="wide_page_content">
        	<h1>Shopping Basket</h1>
    		<?php echo $basket_table; ?>
            <div id="basket_page_buttons">
            	<a href='/636800/'>Continue Shopping</a>
            	<a href='/636800/checkout/'>Checkout</a>
            </div>
        </div>
    	<?php include('../common/footer.php'); ?>
	</div><!-- end main_wrapper -->
</body>
</html>