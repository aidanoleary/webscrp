// This is a javascript document that will deal with the client side validation
// of the add category page.

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

//A function that validates a all the inputs of the products form.
function validate() {
	var fail = "";
	fail += validateName(document.getElementsByName('name')[0].value);
	fail += validateDetails(document.getElementsByName('details')[0].value);
	if (fail == "") {
		return true;
	}
	else {
		alert("Category hasn't been added.\n" + fail);
		return false;
	}
}