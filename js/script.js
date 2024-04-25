// Hamburger Navigation //

const burgerMenu = document.getElementById('hamburger-menu-icon');

const overlay = document.getElementById('menu');

const burgerOverlayClosingButton = document.getElementById('close-buger');

burgerMenu.addEventListener('click', function() {
  this.classList.toggle("close");
  overlay.classList.toggle("overlay");
});


// Concept Dice Responsive //

const conceptDiceElements = document.querySelectorAll('[data-concept-dice]');

conceptDiceElements.forEach(function(element) {
    element.addEventListener("mouseover", function() {
        element.classList.add('ttl--primary');
    });
    
    element.addEventListener("mouseout", function() {
        element.classList.remove('ttl--primary');
    });
});

// Favourite Universe

const favouriteList = document.getElementById('favourite-universe');
