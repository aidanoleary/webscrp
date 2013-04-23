// This is a javascript document that will deal with the client side validation
// of the add product page.


function validateName(field) {
	if(field == "") {
		return "No name was entered.\n";	
	}
	else {
		return "";	
	}
}

function validateDetails(field) {
	if(field == "") {
		return "No details were entered.\n";	
	}
	else {
		return "";	
	}
}

function validatePrice(field) {
	if(/[^0-9\.]/.test(field))	{
		return "You haven't entered a valid price. you can only enter digits.\n"; 
	}
	else if(field == "") {
		return "You haven't entered a price.\n";	
	}
	else {
		return "";
	}
}

function validateQuantity(field) {
	var message;
	if(/[^0-9]/.test(field)) {
		return "You haven't entered a valid quantity. You can only enter digits.\n";	
	}
	else if(field == "") {
		return "You haven't entered a quantity.\n";	
	}
	else {
		return "";
	}
}


//A function that validates a all the inputs of the products form.
function validate() {
	var fail = "";
	fail += validateName(document.getElementsByName('name')[0].value);
	fail += validateDetails(document.getElementsByName('details')[0].value);
	fail += validatePrice(document.getElementsByName('price')[0].value);
	fail += validateQuantity(document.getElementsByName('quantity')[0].value);
	if (fail == "") {
		return true;
	}
	else {
		alert("Product hasn't been added.\n" + fail);
		return false;
	}
}
