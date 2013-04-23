//This is javascript file which deals with the admin add category page.

window.onload = function() {
	//formListener();
	var categoryForm = document.getElementById("form_add_category");
	
	// This part of the script attaches an event listener to the category form.
	// It also uses an if statement to add support to browsers below IE 8.
	if(categoryForm.addEventListener) {
		categoryForm.addEventListener("submit", function() {return validate(categoryForm)},false);	
	}
	else {
		categoryForm.attachEvent("onSubmit", function() {return validate(categoryForm)});	
	}
}

// Category form validation
// **************************************************** //

// This function validates the entire form and produces an alert if 
// some details haven't been entered. 
function validate(form) {
	var fail;
	fail = validateName(form.name.value);
	fail += validateDetails(form.details.value);
	
	if(fail == "") {
		return true;	
	}
	else {
		alert(fail);
		return false;	
	}
	
}

//This function checks the name field.
function validateName(field) {
	if(field == "") {
		return "No name was entered.\n";	
	}
	else {
		return "";	
	}
}

//This function checks if the details field is empty.
function validateDetails(field) {
	if(field == "") {
		return "No details were entered.\n";	
	}
	else {
		return "";
	}
}
