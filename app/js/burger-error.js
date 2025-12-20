// Hamburger Navigation //

const burgerMenu = document.getElementById('hamburger-menu-icon');

const overlay = document.getElementById('menu');

const burgerSvg = document.getElementById('burgerSvg');

burgerMenu.addEventListener('click', function () {
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");

    if (burgerSvg.src.includes('burger-active.svg')) {
        burgerSvg.src = '../img/burger.svg';
    } else if (burgerSvg.src.includes('burger.svg')) {
        burgerSvg.src = '../img/burger-active.svg';
    }
});