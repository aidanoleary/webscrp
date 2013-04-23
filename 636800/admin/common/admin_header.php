<?php
	if(!isset($page_title)) {
		$page_title = "default page title";	
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" type="text/css" href="/636800/admin/css/admin.css" />
<!-- script will maybe go here -->
</head>
<body>
	<div id="main_wrapper"><!-- start main_wrapper -->
		<header id="main_header" class="cf">
			<img src="/636800/images/main_logo.png" alt="An image of the companies logo" width="200" height="100" />
			<h1 id="main_header_text">This is the company's title</h1>
        	<nav id="admin_nav">
                <ul>
                	<li><a href="/636800/admin/product/view_product/">View products</a></li>
                    <li><a href="/636800/admin/category/view_category/">View categories</a></li>
                    <li><a href="/636800/admin/product/add_product/">Add a product</a></li>
                    <li><a href="/636800/admin/category/add_category/">Add a category</a></li>
                    <li><a href="#">Check stock</a></li>
                    <li><a href="#">View orders</a></li>
                </ul>
			</nav>
		</header>