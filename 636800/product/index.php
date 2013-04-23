<?php
	include_once('./functions.php');
	$product_html = get_product();
	$product_name = get_name();
	
	
	//set the page title depending on the product
	//$name;
	//$image;
	//$price;
	//$category;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $product_name; ?></title>
<link href="/636800/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="main_wrapper">
    	<?php include('../common/header.php'); ?>
    	<div class="wide_page_content">
        	<?php echo $product_html; ?>
        </div>
        <?php include('../common/footer.php'); ?>
    </div>
    <script src="/636800/scripts/basket_functions.js" type="text/javascript"></script>
</body>
</html>