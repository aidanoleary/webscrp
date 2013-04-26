//This is a javascript file that will be used for the product pages
//******************************************************************

//set the onload function.
window.onload = function() {

};

//A function that allows the use of ajax in older versions of internet explorer
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


function getProductRequest(url, id, params) {
	var target = document.getElementById(id);
	var request = ajaxRequest();

	request.open("GET", url, true);

	request.send(params);

	request.onreadystatechange = function() {
		if(this.readyState === 4) {
			if(this.status === 200) {
				if(this.responseText !== null) {
					target.innerHTML = request.responseText;
				}//end if
				else{
					alert(target.statusText);
				}
			}//end if
			else {
				alert("AJAX error: " + this.statusText);
			}
		}//end if
	};

}

//A function that allows you to get the url get variables.
/*
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
*/


function getProductQuantity() {
	var productId = document.getElementById('product_page_id').innerHTML;
	getProductRequest("/636800/product/get_quantity.php?product_id=" + productId, "product_quantity", null);
}

//A function that will be used to fetch updates on the page every couple of seconds.
function fetch() {
	getProductQuantity();
}

//set the update interval.
setInterval(fetch, 5000);