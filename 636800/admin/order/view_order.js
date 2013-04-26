// This is a Javascript document that deals with the view orders page of the cms
// system.

//This part of the script deals with updating and displaying products using AJAX
window.onload = function() {
	viewOrders();
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
	var request
	
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

// A function that allows the user to view the products in the database by using a AJAX GET request.
function viewOrders() {
	getRequest("orders", "view_functions.php", "null");	
}

var fetch = function() {
	var orderRequest;
	orderRequest = viewOrders();
}

//set an interval so the order list is updated every 5 seconds.
setInterval(fetch, 5000);