import './../scss/style.scss';


// Hamburger Navigation //

const burgerMenu = document.getElementById('hamburger-menu-icon');

const overlay = document.getElementById('menu');

burgerMenu.addEventListener('click', function () {
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
});


// Responsive avatar link //

const myAccountLink = document.querySelectorAll('[data-avatar]');

console.log(myAccountLink);

myAccountLink.addEventListener('mouseover', function(){
    myAccountLink.classList.toggle('nav__account-link');
})