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

const rpgList = document.getElementById('rpg-universe');
console.log(rpgList);

const personnalList = document.getElementById('personnal-list');
console.log(personnalList);

const templateRPGList = document.querySelector('[data-favourite-rpg]');

rpgList.addEventListener('click', function(event){
    for(const rpg of rpgList){
        templateRPGList.innerText = rpg.querySelector('[value]');
        personnalList.appendChild(templateRPGList)
    }
})