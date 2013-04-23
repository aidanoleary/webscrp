// This is a javascript document that is used to deal with the products
// on the page.


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

//This is a function that can be used to call an Ajax get request.
function getRequest(file, params) {
	var request;
	var ajaxResponse;

	request = ajaxRequest();
	request.open("GET", file, true);

	request.onreadystatechange = function() {
		if(this.readyState === 4) {
			if(this.status === 200) {
				if(this.responseText != null) {
					ajaxResponse = request.responseText;
					return ajaxResponse;
				}
				else {
					ajaxResponse.statusText;
				}
			}
			else {
				alert("AJAX error: " + this.statusText);
			}
		}
	}

	request.send(null);
}

//This is a function that will be used to gather the product data for
//all products.
