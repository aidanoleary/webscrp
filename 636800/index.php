<?php
    include_once('./common/category_nav.php');
    $category_nav = get_category_nav();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta "charset=utf-8" />
<title>Home</title>
<link href="/636800/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="main_wrapper"> <!-- start main_wrapper -->
    
        <?php include ('common/header.php'); ?>
        <?php echo $category_nav; ?>
        <div class="category_page_content"> <!-- start page_content -->
            <div id="products">
            </div>
        </div> <!-- end page_content -->
        
        <?php include ('common/footer.php'); ?>
    </div> <!-- end main_wrapper -->
<script type="text/javascript" src="/636800/scripts/product_functions.js"></script> 
</body>
</html>