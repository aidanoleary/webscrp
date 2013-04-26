// This is a Javascript document that deals with the view products page of the cms
// system.

//This part of the script deals with updating and displaying products using AJAX
window.onload = function() {
	viewProducts();
};


// This is a function that can be used to call an ajax get request.
function getRequest(id, file, params) {
	var request;
	var target;
	 
	target = document.getElementById(id);
	request = ajaxRequest();
	request.open("GET",file,true);
	request.setRequestHeader("Content-type", "text/html");
	
	request.onreadystatechange = function() {
		if(this.readyState === 4) {
			if(this.status === 200) {
				if(this.responseText != null) {
					target.innerHTML = request.responseText;	
				}
				else {
					target.statusText;	
				}
			}
			else {
				alert("AJAX error: " + this.statusText);	
			}
		}
	}
	
	request.send(params);
}

// This is a function that can be used to call an ajax post request
function postRequest(id, file, params) {
	var request;
	var target;
	 
	target = document.getElementById(id);
	request = ajaxRequest();
	request.open("POST",file,true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.setRequestHeader("content-length", params.length);
	request.setRequestHeader("Connection", "close");
	
	request.onreadystatechange = function() {
		if(this.readyState === 4) {
			if(this.status === 200) {
				if(this.responseText != null) {
					target.innerHTML = request.responseText;	
				}
				else {
					target.statusText;	
				}
			}
			else {
				alert("AJAX error: " + this.statusText);	
			}
		}
	}
	
	request.send(params);
}

// This is a function that will allow support for ajaxRequests in old browsers.
function ajaxRequest() {
	var request;
	
	if ( XMLHttpRequest){
		request = new XMLHttpRequest();	
	}
	else {
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



// A function that allows the user to view the products in the database by using a AJAX GET request.
function viewProducts() {
	getRequest("products", "view_functions.php", "null");	
}

// A function that allows the user to delete a product from the database by using a AJAX POST request.
// I could only get this function working with onclick in html, Due to the product list being dynamically loaded.
function deleteProduct(button) {
	var productValue = button.value;
	postRequest("information_1", "delete_functions.php", "delete_id="+productValue);
	viewProducts();	
}

function editProduct(button) {
	var productValue = button.value;
	window.location.href = ("/636800/admin/product/edit_product/index.php?edit_id=" + productValue);	
}

var fetch = function() {
	var productsRequest;
	productsRequest = viewProducts();
}

setInterval(fetch, 5000);