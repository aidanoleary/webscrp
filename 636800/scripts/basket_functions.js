//This is a javascript document that contains functions that deal with the shopping
//sites basket features.

window.onload = initAll();

// This is a function that will allow support for ajaxRequests in old browsers.
function ajaxRequest() {
	var request;

	try {
		request = new XMLHttpRequest();
	}
	catch(e1) {
		try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e2) {
			try {
				request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e3) {
				request = false;
			}
		}

	}
	return request;
}

//A function that creates an ajax post request.
function postRequest(file, params) {
	var request;
	request = ajaxRequest();
	request.open("POST", file, true);
	
	request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	request.setRequestHeader("content-length", params.length);
	request.setRequestHeader("connection", "keep-alive");
	
	request.send(params);
}

//A function that creates ajax get request.
function getRequest(file, params) {
	var request;
	request = ajaxRequest();
	request.open("GET", file, true);
	
	request.send(params);	
}


function addEvent(myElement, myEvent, myFunction) {
	if(myElement.addEventListener) {
		myElement.addEventListener(myEvent, myFunction, false);	
	}
	else {
		myElement.attachEvent('on' + myEvent, myFunction);
	}
}


function addToBasket(evt) {
	var url = '/636800/basket/add.php';
	var parameters = 'p_id=' + this.name;
	postRequest(url, parameters);
	basketUpdate = document.getElementById('basket_update_info');
	basketUpdate.innerHTML = "Product has been added to your basket.";
	setTimeout(function() { basketUpdate.innerHTML = ""; }, 4000);
}

function emptyBasket(evt) {
	var url = '/636800/basket/empty.php?command=emptycart';
	var parameters = null;
	getRequest(url, parameters);
	basketUpdate = document.getElementById('basket_update_info');
	basketUpdate.innerHTML = "Basket has been emptied.";
	setTimeout(function() { basketUpdate.innerHTML = ""; }, 4000);
}

//A function that initialises when the page loads
function initAll() {
	//set up the add to basket button.
	var addButton = document.getElementById('add_basket_button');
	addEvent(addButton, 'click', addToBasket);
	
	var emptyButton = document.getElementById('empty_basket_button');
	addEvent(emptyButton, 'click', emptyBasket);
}


	