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
            <form id='checkout_form' action="/636800/checkout/finished.php" method="post">
                <fieldset>
                    <legend>Checkout Form</legend>
                    <p><label>First Name:</label><input type="text" name="first_name"></input></p>
                    <p><label>Surname:</label><input type="text" name="surname"></input></p>
                    <p><label>Telephone Number:</label><input type="text" name="phone"></input></p>
                    <fieldset>
                        <legend>Address</legend>
                        <p><label>Street</label><input type="text" name="street"></input></p>
                        <p><label>City</label><input type="text" name="city"></input></p>
                        <p><label>Postcode:</label><input type="text" name="postcode"></input></p>
                        <p><label>Country:</label><input type="text" name="country"></input></p>
                    </fieldset>
            	   <input type="submit" value="submit" class='submit_button1'></input>
                </fieldset>
            </form>
        </div>
        <?php include('../common/footer.php'); ?>
    </div>
</body>
</html>