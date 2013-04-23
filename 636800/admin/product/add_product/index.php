<?php
	$page_title = "Add Product";
	include_once('./functions.php');
	$category_list = category_selection();
	$add_message = add_product();
	 
	include_once('../../common/admin_header.php'); 
?>
<script type="text/javascript" src="./validate.js"></script>
        <div id="page_content" class="cf"> <!-- start page_content --> 
        	<h1 id="page_title">Add a product to the system.</h1>
                <form id="form_add_product" action="/636800/admin/product/add_product/" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                    <fieldset>
                    <legend>Add Product Form</legend>
                        <p><label for="name">Product Name:</label><input type="text" name="name" maxlength="30" /></p>
                        <p><label for="category">Product Category:</label>
                            <?php
                                echo $category_list;
                            ?>
                        </p>
                        <p><label for="details">Product Details:</label><textarea name="details"></textarea></p>
                        <p><label for="image">Product Image:</label><input type="file" name="image" /></p>
                        <p><label for="price">Product Price:</label><input type="text" name="price" /></p>
                        <p><label for="quantity">Product Quantity:</label><input type="text" name="quantity" /></p>
                        <input id="submit_button" type="submit" name="submit" value="submit" />
                    </fieldset>
                </form>
            <?php
				echo $add_message;
			?>
        </div> <!-- end page_content -->
<?php 
	include_once('../../common/admin_footer.php'); 
?>