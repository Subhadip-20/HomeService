/* menu bar */
let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

    menu.addEventListener('click', () =>{
        menu.classList.toggle('fa-times');
        navbar.classList.toggle('nav-toggle');
    });

    window.onscroll = () =>{
        menu.classList.remove('fa-times');
        navbar.classList.remove('nav-toggle');
    }

// JavaScript for toggling the search bar
let searchIcon = document.querySelector('#search-button');
let searchBar = document.querySelector('.search-bar');

searchIcon.addEventListener('click', () => {
    searchBar.classList.toggle('search-bar-active');
});

window.addEventListener('click', (e) => {
    if (!searchBar.contains(e.target) && !searchIcon.contains(e.target)) {
        searchBar.classList.remove('search-bar-active');
    }
});

// JavaScript for handling search form submission (you can replace the alert with your search logic)
document.getElementById("search-button").addEventListener("click", function () {
    const searchTerm = document.querySelector('.search-bar input[type="text"]').value;
    alert(`You searched for: ${searchTerm}`);
});


/* login button */
document.getElementById("loginButton").addEventListener("click", function() {
    document.getElementById("loginPopupContainer").style.display = "block"; });
   
document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("loginPopupContainer").style.display = "none"; });
   
document.getElementById("customerLoginButton").addEventListener("click", function() { /*can add functionality for the customer login button like:- customer select */ });
    
document.getElementById("providerLoginButton").addEventListener("click", function() { /*can add functionality for the proviver login button like:- provider select */ });
        

/* contact form */
document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contact-form");

    function handleFormSubmit(event) {
        event.preventDefault();
        alert("Form submitted!");
        contactForm.reset();
    }
     contactForm.addEventListener("submit", handleFormSubmit);
});