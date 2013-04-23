<?php
	$page_title = "Add Category";
	include_once ("./functions.php");
	$add_message = add_category();
	
	
	include_once ("../../common/admin_header.php");
?>
<script type="text/javascript" src="./validate.js"></script>
		<div id="page_content" class="cf">
        	<h1 id="page_title">Add a category to the system</h1>
            <form id="form_add_category" action="/636800/admin/category/add_category/" method="post" enctype="multipart/form-data" onsubmit="return validate()">
            	<fieldset>
                <legend>Add Category Form</legend>
                    <p><label for="name">Category Name:</label><input type="text" name="name" maxlength="30" /></p>
                    <p><label for="details">Category Details:</label><textarea name="details"></textarea></p>
                    <p><label for="image">Category Image:</label><input type="file" name="image" /></p>
                    <input id="submit_button" type="submit" name="submit" value="submit" />
                </fieldset>
            </form>
            <?php
				echo $add_message;
			?>
        </div>
        
<?php
	include_once ("../../common/admin_footer.php");
?>