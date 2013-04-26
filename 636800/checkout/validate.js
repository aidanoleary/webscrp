//This section contains all the functions that deal with the client side validation of the form.
// *********************************************************************************************

//A function that validates the firstname field and produces an error message if nothing is entered.
function validateFirstName(field) {
	var message;
	if(field == "") {
		message = "No Firstname was entered.\n";
		return message;
	}
	else if(/[^A-Za-z' ]/.test(field)){
		message = "You haven't entered a valid firstname. Only letters can be entered.";
		return message;

	}
	else {
		message = "";
		return message;
	}
}

//A function that validates the surname field and produces an error message if nothing is entered.
function validateSurname(field) {
	var message;
	if(field == "") {
		message = "No surname was entered.\n";
		return message;
	}
	else if(/[^A-Za-z' ]/.test(field)){
		message = "You haven't entered a valid surname. Only letters can be entered.";
		return message;

	}
	else {
		message = "";
		return message;
	}
}

//A function that validates the phone field.
function validatePhone(field) {
	var message;
	if(field == "") {
		message = "No telephone number was entered.\n";
		return message;
	}
	else if(/[^0-9]/.test(field)) {
		message = "You haven't entered a valid telephone number.\n";
		return message;
	}
	else {
		message = "";
		return message;
	}
}

//A function that validates the street field.
function validateStreet(field) {
	var message;
	if(field == "") {
		message = "No street was entered.\n";
		return message;
	}
	else if(/[^A-Za-z0-9 ]/.test(field)) {
		message = "You have entered an invalid street.\n";
		return message;
	}
	else {
		message = "";
		return message;
	}
}

//A function that validate the city field.
function validateCity(field) {
	var message;
	if(field == "") {
		message = "No city was entered.\n";
		return message;
	}
	else if(/[^A-Za-z ]/.test(field)){
		message = "You haven't entered a valid city. Only letters can be entered.\n";
		return message;

	}
	else {
		message = "";
		return message;
	}
}

//A function that validates the postcode field.
function validatePostcode(field) {
	var message;
	if(field == "") {
		message = "No postcode was entered.\n";
		return message;
	}
	else if(/[^A-za-z0-9 ]/.test(field)) {
		message = "You have entered an invalid postcode.\n";
		return message;
	}
	else {
		message = "";
		return message;
	}
}

//A function that validates the country field.
function validateCountry(field) {
    var message;
	if(field == "0") {
		message = "No country was selected.\n";
		return message;
	}
	else {
		message = "";
		return message;
	}

}


//A function that validates all the users inputs to determine if the form can be processed.
function validate_form() {
	var fail = "";
	fail += validateFirstName(document.getElementsByName('first_name')[0].value);
	fail += validateSurname(document.getElementsByName('surname')[0].value);
	fail += validatePhone(document.getElementsByName('phone')[0].value);
	fail += validateStreet(document.getElementsByName('street')[0].value);
	fail += validateCity(document.getElementsByName('city')[0].value);
	fail += validatePostcode(document.getElementsByName('postcode')[0].value);
    fail += validateCountry(document.getElementsByName('country')[0].value);
	if(fail == "") {
		return true;
	}
	else {
		alert("Submission Failed.\n" + fail);
		return false;
	}
}