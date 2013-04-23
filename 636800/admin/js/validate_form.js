
//A function that will validate the admin category page form
//finish this ******************************************************
window.onload = function () {
	var pageLocation = window.location.href;
	var form;
	
	if(/.*add_category.php/.test(pageLocation)) {
		form = document.getElementById("form_add_category");
		validateCategory(form);
	}
	else if(/.*add_product.php/.test(pageLocation)) {
		
	}
	
}

//A function that validates the category form
function validateCategory(form) {
	var fail = validateName(form.name.value);
	fail = validateDetails(form.details.value);
	if(fail == "") {
		return true;	
	}
	else {
		alert(fail);
		return false;	
	}
}

//A function that is used to check if a name field is empty.
function validateName(field) {
	if(field == "") {
		return "No name was entered.\n"	;
	}
	else {
		return "";	
	}
}

//A function that is used to check if the details field is empty.
function validateDetails(field) {
	if(field == "") {
		return "No details were entered.\n";	
	}
	else {	
		return "";
	}
}

//A function that is used 
