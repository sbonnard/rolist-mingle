import './../scss/style.scss';


// Hamburger Navigation //

const burgerMenu = document.getElementById('hamburger-menu-icon');

const overlay = document.getElementById('menu');

burgerMenu.addEventListener('click', function () {
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
});


// Responsive avatar link //

const myAccountLi = document.querySelector('[data-avatar]');
const myAccountLink = document.querySelector('.js-link-hover');
const myAccountAvatar = document.querySelector('.js-avatar-hover');


// myAccountLi.addEventListener('mouseover', function(e){
//         myAccountLink.classList.toggle('nav__account-link');
//         myAccountAvatar.classList.toggle('nav__account-avatar');
// })

// myAccountLi.addEventListener('mouseout', function(e){
//         myAccountLink.classList.remove('nav__account-link');
//         myAccountAvatar.classList.remove('nav__account-avatar');
// })

// Automatically set the height of the header
const header = document.querySelector('header');
const headerHeight = header.offsetHeight / 2; // en pixels
document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);