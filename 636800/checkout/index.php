<?php
	//include('./functions.php');
    //$page_details = checkout_form();
	
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Checkout</title>
<link href="/636800/css/main.css" rel="stylesheet" type="text/css" />
<script src="./validate.js" type="text/javascript"></script>
</head>

<body>
	<div class="main_wrapper">
    	<?php include('../common/header.php'); ?>
        <div class="wide_page_content">
        	<h1>Checkout Page</h1>
            <form id="checkout_form" onsubmit="return validate_form()" action="/636800/checkout/finished.php" method="post" >
            
                <fieldset>
                    <legend>Checkout Form</legend>
                        <p><label for="first_name">firstname:</label><input type="text" name="first_name" /></p>
                        <p><label for="surname">Surname:</label><input type="text" name="surname" /></p>
                        <p><label for="phone"></label>Telephone Number:<input type="text" name="phone" /></p>
                        <p><label for="street">Street:</label><input type="text" name="street" /></p>
                        <p><label for="city">City:</label><input type="text" name="city" /></p>
                        <p><label for="postcode">Postcode:</label><input type="text" name="postcode" /></p>
                        <div id='checkout_countries'></div>
                        <input type="submit" name="submit" value="submit" class="submit_button1" />
                </fieldset>
            </form>
            
        </div>
        <?php include('../common/footer.php'); ?>
    </div>

    <script src="./checkout_functions.js" type="text/javascript"></script>

</body>
</html>