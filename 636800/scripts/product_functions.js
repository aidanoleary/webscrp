// This is a javascript document that is used to deal with the products
// and category navigation on the home page. The product data is retrieved
// in Json format.


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


//A function that is used to retrieve json data using an Ajax request.
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
	var url = "/636800/library/category_json.php?category_name=" + this.id;
	jsonRequest(url, displayAllProducts, 'products');
	document.title = this.id;
	return false;
}

var displayAllCategory = function () {
	var url = "/636800/library/all_json.php";
	jsonRequest(url, displayAllProducts, 'products');
	document.title = "Home";	
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

//A function sets an event Listener on the search bar
//**************************** couldn't get the search bar working **************
function searchFunction(evt) {
	var title = document.title;
	var search_string = this.value;
	var url = "";
	if(title == "Home" && search_string === "") {
		url = "/636800/library/all_json.php";
		jsonRequest(url, displayAllProducts, 'products');
	}
	else if(title === "Home") {
		url = "/636800/library/search_json.php?search_string=" + search_string;
		jsonRequest(url, displayAllProducts, 'products');
	} 
	else if(search_string === "") {
		url = "/636800/library/category_json.php?category_name=" + title;
		jsonRequest(url, displayAllProducts, 'products');
	}
	else {
		url = "/636800/library/search_json_category.php?category_name=" + title + "&search_string=" + search_string;
		jsonRequest(url, displayAllProducts, 'products');
	}
}

//A function that initialises the page.
function initAll() {
	var products = jsonRequest('/636800/library/all_json.php', displayAllProducts, 'products');
	categoryListeners();
	//searchBarListener();
	//var searchbar = document.getElementById('searchbar');
	//addEvent(searchbar, 'keyup', searchFunction);
}

