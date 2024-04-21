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