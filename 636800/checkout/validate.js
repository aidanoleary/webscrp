//This section contains all the functions that deal with the client side validation of the form.
// *********************************************************************************************

//A function that validates the firstname field and produces an error message if nothing is entered.
function validateFirstName(field) {
	var message;
	if(field == "") {
		message = "No firstname was entered.\n";
		return message;
	}
	else if(/[^A-Za-z]/.test(field)){
		message = "You haven't entered a valid firstname.";
		return message;

	}
	else {
		messgae = "";
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
	else if(/[^A-Za-z]/.test(field)){
		message = "You haven't entered a valid surname.";
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
		message = "You have entered an invalid street.";
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
		message = "No postcode was entered.";
		return message;
	}
	else if(/[^A-za-z0-9 ]/.test(field)) {
		message = "You have entered an invalid postcode.";
		return message;
	}
	else {
		message = "";
		return message;
	}
}

//A function that validates all the users inputs to determine if the form can be processed.
function validate() {
	var fail = "";
	fail += validateFirstName(document.getElementsByName('first_name')[0].value);
	fail += validateSurname(document.getElementsByName('surname')[0].value);
	fail += validatePhone(document.getElementsByName('phone')[0].value);
	fail += validateStreet(document.getElementsByName('street')[0].value);
	fail += validateCity(document.getElementsByName('city')[0].value);
	fail += validatePostcode(document.getElementsByName('postcode')[0].value);
	if(fail == "") {
		return true;
	}
	else {
		alert("Submission Failed.\n" + fail);
		return false;
	}
}