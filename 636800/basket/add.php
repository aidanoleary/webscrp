<?php
	session_start();
?>
<?php
//This is a php document that will use a post request to add an item to your basket.
//The basket is implemented using a multidimensional array and php session variables.
//function add_to_basket() {
	if(isset($_POST['p_id'])) {
		
		$product_id = $_POST['p_id'];
		$found = false;
		$counter = 0;
		
		//Check to see if the session variable is set or if the basket is empty.
		//If the basket is empty or there is no session variable add the first item to the basket.
		if(!isset($_SESSION['basket']) || COUNT($_SESSION['basket']) < 1) {
			$_SESSION['basket'] = array(0 => array("item_id" => $product_id, "quantity" => 1));
			echo "new product has been added.";			
		}
		else {
			foreach($_SESSION['basket'] as $item) {
				while(list($key, $value) = each($item)) {
					if($key == "item_id" && $value == $product_id) {
						array_splice($_SESSION['basket'], $counter, 1, array(array("item_id" => $product_id, "quantity" => $item['quantity'] + 1)));
						$found = true;
					}// end if
				}//end while
			$counter++;
			}// end foreach
			if(!$found) {
				array_push($_SESSION['basket'], array("item_id" => $product_id, "quantity" => 1));	
			}
		}//end else
	}//end if

function display_basket() {
	$html = "";
	foreach($_SESSION['basket'] as $item) {
		$html .= $item['item_id'] . " " . $item['quantity'] . "\n";	
	}
	return $html;	
}

?>