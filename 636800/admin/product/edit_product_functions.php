<!-- finish this ---------------------------------------->

<?php
	$page_title = "Add Product";
	include_once('./add_product_functions.php');

		$category_list = category_selection();
		if(isset($_GET['edit_id'])) {
			$product_id = (int)$_GET['edit_id'];
			
			require ("../common/db_config.php");
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno > 0) die("unable to connect to the database. " . $db->connect_error);
			$sql = "SELECT * FROM tbl_product WHERE tbl_product.p_id = $product_id";
			
			
			
		}
?> 

                <form id="form_edit_product" action="/636800/admin/product/view_product.php<?php echo "?" ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                    <legend>Edit Product Form</legend>
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
    
