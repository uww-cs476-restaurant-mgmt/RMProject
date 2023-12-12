document.addEventListener('DOMContentLoaded', function() { // Only execute when all DOM content is loaded
// Create functionality for all category buttons
const allCategoriesBtn = document.getElementById("allCategories");
allCategoriesBtn.addEventListener("click", function goToAllCategories() {
    window.open("RMProject.html", "_self");
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

const sandwichesBtn = document.getElementById("sandwiches");
sandwichesBtn.addEventListener("click", function goToSandwiches() {
    window.open("sandwiches.html", "_self")
}, false);

const entreesBtn = document.getElementById("entrees");
entreesBtn.addEventListener("click", function goToEntrees() {
    window.open("entrees.html", "_self")
}, false);

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
    var newCart = document.createElement("tbody");
    // Replace the old shopping cart tbody with the new one
    oldCart.parentNode.replaceChild(newCart, oldCart);
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
