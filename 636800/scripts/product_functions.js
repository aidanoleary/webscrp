// This is a javascript document that is used to deal with the products
// on the page.

// Implement the page change system at a later stage so that when category links are clicked on they redirect.

window.onload = function() {
	initAll();
};


//******************* AJAX ***********************************

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


//A function that is used to retrieve json data using a Ajax request.
function jsonRequest(file, callback, id) {
	var request;
	var items;

	request = ajaxRequest();
	request.open("GET", file, true);
	request.send(null);

	request.onreadystatechange = function() {
		if(this.readyState === 4) {
			if (this.status === 200) {
				items = JSON.parse(request.responseText);
				console.log(items);
				callback(items, id);

			}
		}
	};
}


//******************************* Callback functions for the jsonRequest function. ****************************************

//A funtion that displays all the products using retrieved json data.
var	displayAllProducts = function (jsonData, targetId) {
	var element = document.getElementById(targetId);
	var output = "<ul>";
	for(var key in jsonData) {
		output += "<li id='pid" + jsonData[key].id + "'>" + "<div class='product_image'>" + "<a href='/636800/product/index.php?product_id=" + jsonData[key].id + "'><img src='" + jsonData[key].image + "' height='150' width='150' /></a>" + "</div>" + "<div class='product_name'><a href='/636800/product/index.php?product_id=" + jsonData[key].id + "'>" + jsonData[key].name + "</a>" + "</div>" + "<div class='product_price'>" + jsonData[key].price + "</div>" + "<div class='category_name'>" + jsonData[key].category + "</div>" +  "</li>";
	}
	output += "</ul>";
	element.innerHTML = output;
};


//A function that display products of a specific category using retrieved json data.
var displayCategoryProducts = function () {
	/*
	var currentPage = window.location;
	console.log(currentPage);
	if(!(/636800\/$/.test(currentPage)) && !(/636800\/index.php$/.test(currentPage)) && !(/636800\/index.php#$/.test(currentPage)) && !(/636800\/#$/.test(currentPage))) {
		window.location = "/636800/";	
	}
	*/
	var url = "/636800/library/category_json.php?category_name=" + this.id;
	jsonRequest(url, displayAllProducts, 'products');
	document.title = this.id;
	return false;
}

var displayAllCategory = function () {
	//Test to see if current page is view product page
	var currentPage = window.location;
	console.log(currentPage);
	
	/*
	var pageCheck1 = /636800\/$/.test(currentPage);
	var pageCheck2 = /636800\/index.php$/.test(currentPage);
	var pageCheck3 = /636800\/index.php#$/.test(currentPage);
	var pageCheck4 = /636800\/#$/.test(currentPage);
	if(pageCheck1 == false && pageCheck2 == false && pagecheck3 == false && pageCheck4 == false) {
		
	}
	
	if(!(/636800\/$/.test(currentPage)) && !(/636800\/index.php$/.test(currentPage)) && !(/636800\/index.php#$/.test(currentPage)) && !(/636800\/#$/.test(currentPage))) {
		window.location = "/636800/";	
	}
	*/
	var url = "/636800/library/all_json.php";
	jsonRequest(url, displayAllProducts, 'products');
	document.title = "Home";
	return false;	
}


//********************************** Listener functions *********************************
//A function that adds event listener support in in older versions of internet explorer.
function addEvent(myElement, myEvent, myFunction) {
	if(myElement.addEventListener) {
		myElement.addEventListener(myEvent, myFunction, false);
	}
	else {
		myElement.attachEvent('on' + myEvent, myFunction);
	}

}

//A function that sets event listeners on the category links.
function categoryListeners() {
	var categories = document.getElementById('category_nav').getElementsByTagName('a');
	var category;
	var allCategory = categories[0];
	addEvent(allCategory, 'click', displayAllCategory);
	
	//loop starts one after the first element due to the all link being done 
	for(var i = 1; i < categories.length; i++) {
		category = categories[i];
		addEvent(category, 'click', displayCategoryProducts);
	}
}

//*************************** for event listeners you need to add in support for other browsers.
//**************************** Also need to change displayCategoryProducts function so that it stops the interval.

//A function that initialises the page.
function initAll() {
	var products = jsonRequest('/636800/library/all_json.php', displayAllProducts, 'products');
	categoryListeners();
}

