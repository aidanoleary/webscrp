<?php
	include('./functions.php');
    $page_details = checkout_form();
	
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Checkout</title>
<link href="/636800/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="main_wrapper">
    	<?php include('../common/header.php'); ?>
        <div class="wide_page_content">
        	<h1>Checkout Page</h1>
            <?php echo $page_details; ?>
        </div>
        <?php include('../common/footer.php'); ?>
    </div>
    <script src="./validate.js" type="text/javascript"></script>
    <script src="./checkout_functions.js" type="text/javascript"></script>

</body>
</html>