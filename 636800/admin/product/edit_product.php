<?php
	$page_title = "Edit Product";
	include_once("./add_product_functions.php");
	$category_list = category_selection();
	
	if(isset($_GET['edit_id'])) {
		$edit_id = $_GET['edit_id'];
	}
	else {
		$edit_message = edit_product($edit_id);	
		header('location: ./view_product.php');
	}
	
	include_once('../common/admin_header.php');
?>
		<div id="page_content" class="cf"> <!-- start page_content --> 
        	<h1 id="page_title">Add a product to the system.</h1>
				<form id="form_edit_product" action="/636800/admin/product/edit_product.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                    <legend>Edit Product Form</legend>
                    	<p><label for="id">Product Name:</label><input type="text" name="name" value="<?php echo $edit_id ?>" /></p>
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
        </div>
<?php
	include_once('../common/admin_footer.php');
?>