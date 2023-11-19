/* **** MAIN JAVASCRIPT ISSUES ****
(1) Item quantity is not displayed in the shopping cart if the same item is selected more
    than once, instead the item just displays again.
*/

document.addEventListener('DOMContentLoaded', function() { // Only execute when all DOM content is loaded

retrieveData(); // Retrieve local storage data for shopping cart

// Create functionality for all category buttons
const allCategoriesBtn = document.getElementById("allCategories");
allCategoriesBtn.addEventListener("click", function goToAllCategories() {
    window.open("RMProject.html", "_self");
}, false);

const bevAlcBtn = document.getElementById("beveragesAlcohol");
bevAlcBtn.addEventListener("click", function goToBevAlc() {
    window.open("beveragesAlcohol.html", "_self")
}, false);

const startersBtn = document.getElementById("starters");
startersBtn.addEventListener("click", function goToStarters() {
    window.open("starters.html", "_self")
}, false);

const basketsBtn = document.getElementById("baskets");
basketsBtn.addEventListener("click", function goToBaskets() {
    window.open("baskets.html", "_self")
}, false);

const saladsBtn = document.getElementById("salads");
saladsBtn.addEventListener("click", function goToSalads() {
    window.open("salads.html", "_self")
}, false);

const wrapsBtn = document.getElementById("wraps");
wrapsBtn.addEventListener("click", function goToWraps() {
    window.open("wraps.html", "_self")
}, false);

const burgersBtn = document.getElementById("burgers");
burgersBtn.addEventListener("click", function goToBurgers() {
    window.open("burgers.html", "_self")
}, false);

const beefPorkBtn = document.getElementById("beefPork");
beefPorkBtn.addEventListener("click", function goToBeefPork() {
    window.open("beefPork.html", "_self")
}, false);

const sandwichesBtn = document.getElementById("sandwiches");
sandwichesBtn.addEventListener("click", function goToSandwiches() {
    window.open("sandwiches.html", "_self")
}, false);

const chickenBtn = document.getElementById("chicken");
chickenBtn.addEventListener("click", function goToChicken() {
    window.open("chicken.html", "_self")
}, false);

const seafoodBtn = document.getElementById("seafood");
seafoodBtn.addEventListener("click", function goToSeafood() {
    window.open("seafood.html", "_self")
}, false);

const pastaStirFryBtn = document.getElementById("pastaStirFry");
pastaStirFry.addEventListener("click", function goToPastaStirFry() {
    window.open("pastaStirFry.html", "_self")
}, false);

/* Constructor function to create a menuItem obj */
function menuItem(item, price) {
	this.item = item;
	this.price = price;
	this.display = function(){
		var this_str = "<td>" + this.item + "</td>";
		this_str += "<td> $" + this.price + "</td>";
		return this_str;
	}
}

// Declare an array of menu item objects 
var menuItem_list = [];

var num = document.getElementsByClassName("menu-item");	// Get number of menu items in the table

for (let i = 0; i < num.length; i++) {	// For each menu item in the table
	// Read info from each row in the table in the web page
	item = document.getElementById('item-' + i).textContent;
	price = document.getElementById('price-' + i).textContent;
	
	// Create new menu item object and add it to the array menuItem_list
	menuItem_list.push(new menuItem(item, price));
}

// Apply event delegation for add buttons
// By registering event handler "addItem" function to the click event to <table id="menuItem"> element 
var menuTable = document.getElementsByTagName('table')[0];
menuTable.addEventListener('click', addItem, false);

// Define an array to hold the index of the car added to the shopping chart
var cart = [];

// Create a global totalPrice variable to hold the total price of everything in the cart
var totalPrice = 0; 
// This function defines an event handler that adds a menu item to shopping cart
function addItem(e) {
	if (e.target.className.includes("addItem")) {	// If the click event fires on an add button
	// (1) Define a menu item index by using the value of the value attribute in each Add button element.
	var index = e.target.value;

	// (2) Save that menu item index into cart array. 
	cart.push(index);

	// (3) Use the menu item index to find the corresponding menu item object in 
    // the menuItem_list array and then call addNewItemtoCart function to add 
    // selected menu item info (item & price) into the shopping cart table. 
	addNewItemtoCart(menuItem_list[index]);

    // (4) Create a total price counter to display at the bottom of the shopping cart
    // Remove $ sign from currently selected item's price
    var currentPrice = parseFloat(menuItem_list[index].price.slice(1)); 
    // Increase total price by currently selected item's price
    totalPrice = totalPrice + currentPrice;
    // Save total price to local storage
    localStorage.setItem("total price", totalPrice.toFixed(2));
    // Add label for total price once an item has been selected
    document.getElementById("totalPriceLabel").textContent = "Total Price:"; 
    // Display total price of all items selected so far
    document.getElementById("totalPrice").textContent = "$" + totalPrice.toFixed(2);
	}
}

// Add js code in addNewItemtoCart function to create three new <td> elements in shopping
// cart ("shoppingCart") table and append them to a new table row in shop cart table to display
// item & price  
var counter = 0; // Initialize global counter for local storage (BAD IMPLEMENTATION BUT IT WORKS)
function addNewItemtoCart(selectedItem) {
    /* This function creates and adds a new table row to an existing table */
       // Create a new <tr> element: a table row
       var newTrElement = document.createElement('tr');

       // Call createNewTdElement to create a <td> element using selectedItem.item as content
       var newTdElement = createNewTdElement(selectedItem.item);
       // Save selectedItem.item to local storage as "item"
       localStorage.setItem("item-" + counter, selectedItem.item);
       // Append it to the new tr element
       newTrElement.appendChild(newTdElement);
       
       // Call createNewTdElement to create a <td> element using selectedItem.price as content
       var newTdElement = createNewTdElement(selectedItem.price);
       // Save selectedItem.item to local storage as "price"  
       localStorage.setItem("price-" + counter, selectedItem.price);
       counter++;  
       // Append it to the new tr element
       newTrElement.appendChild(newTdElement);

       // Append new <tr> element to the shopping cart
       document.getElementById("shoppingCart").appendChild(newTrElement);
}

function createNewTdElement(cell_content) {
           // Create a text node
           var newTextNode = document.createTextNode(cell_content);
           // Create a new td element
           var newTdElement = document.createElement('td');
           // Append text node to the new td element
           newTdElement.appendChild(newTextNode);
           return newTdElement;
}

function retrieveData() { 
    // Get shopping cart items from local storage
    for (let i = 0; i < localStorage.length / 2 - 1; i++) { // Iterate over every key-val pair in localStorage
        item = localStorage.getItem("item-" + JSON.stringify(i));
        price = localStorage.getItem("price-" + JSON.stringify(i));

        // Add local storage back to shopping cart
        var newTrElement = document.createElement('tr');
        var newTdElement = createNewTdElement(item);
        newTrElement.appendChild(newTdElement);
        var newTdElement = createNewTdElement(price);
        newTrElement.appendChild(newTdElement);
        document.getElementById("shoppingCart").appendChild(newTrElement);
    }
    // If at least one item has been selected
    if (localStorage.getItem("total price") !== null) { 
        // Get total price back from local storage
        totalPrice = localStorage.getItem("total price");
        // Add label for total price once an item has been selected
        document.getElementById("totalPriceLabel").textContent = "Total Price:"; 
        // Display total price of all items selected so far
        document.getElementById("totalPrice").textContent = "$" + totalPrice;
    }
} 

// Store values for checkout & clear buttons into respective variables
const checkoutButton = document.getElementById("checkout");
const clearButton = document.getElementById("clear");

// Create a functional checkout button
function checkoutAll() {
    // Open/Navigate to the receipt html file
    window.open("receipt.html", "_self");
}

// Create a functional clear button
function clearAll() {
    // Save the old shopping cart tbody to oldCart
    oldCart = document.getElementById("shoppingCart");
    // Create a new empty shopping cart tbody
    var newCart = document.createElement('tbody');
    // Replace the old shopping cart tbody with the new one
    oldCart.parentNode.replaceChild(newCart, oldCart);

    // Clear local storage
    localStorage.clear();

    // Set the global counter for localStorage back to 0
    counter = 0;

    // Set the global totalPrice variable back to 0
    totalPrice = 0;

    // Remove label for total price
    document.getElementById("totalPriceLabel").innerHTML = ""; 
    // Remove total price of all items
    document.getElementById("totalPrice").innerHTML = "";

    // Reload the page so you can immediately click add buttons again
    location.reload();
}

// Execute the functions above when the button is clicked
checkoutButton.addEventListener("click", checkoutAll, false);
clearButton.addEventListener("click", clearAll, false);
});