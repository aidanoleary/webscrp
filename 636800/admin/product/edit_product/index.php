<?php
	$page_title = "Edit Product";
	include_once('./functions.php');
	$category_list = category_selection();
    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        $edit_message = edit_product($edit_id);
    }
    else {
        $edit_message = "You haven't selected a product go back to the view products page.";
        
    }
    

	include_once('../../common/admin_header.php'); 
?>
<script type="text/javascript" src="./validate.js"></script>
        <div id="page_content" class="cf"> <!-- start page_content --> 
        	<h1 id="page_title">Edit a product</h1>
                <form id="form_add_product" action="/636800/admin/product/edit_product/index.php?edit_id=<?php echo $edit_id ?>" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                    <fieldset>
                    <legend>Edit a product</legend>
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
				echo $edit_message;
			?>
        </div> <!-- end page_content -->
        
<?php 
	include_once('../../common/admin_footer.php'); 
?>