// JavaScript Document

// This is the function that will be called by the setInterval method. 
window.onload = function() {
	viewCategories();
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

function viewCategories() {
	getRequest("categories", "view_functions.php", "null");	
}

function deleteCategory(button) {
	var categoryValue = button.value;
	postRequest("information_1", "delete_functions.php", "delete_id="+categoryValue);
}

var fetch = function() {
	var categoriesRequest;
	categoriesRequest = viewCategories();
}

setInterval(fetch, 5000);