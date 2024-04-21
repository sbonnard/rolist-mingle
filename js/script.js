// Hamburger Navigation //

const hamburgerIcon = document.getElementById('hamburger-menu-icon');
const hamburgerNav = document.getElementById('hamburger-menu');

function showHamburgerMenu() {
    if(hamburgerNav === ""){
        hamburgerNav.className = 'open';
        hamburgerIcon.className = 'open';
    }
    else{
        hamburgerNav.className = "";
        hamburgerIcon.className = "";
    }
}

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