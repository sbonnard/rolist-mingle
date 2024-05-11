import * as JDR from "./jdr.json" with {type: "json" }

console.log(JDR);

// Hamburger Navigation //

const burgerMenu = document.getElementById('hamburger-menu-icon');

const overlay = document.getElementById('menu');

burgerMenu.addEventListener('click', function () {
    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
});


// Concept Dice Responsive //

const conceptDiceElements = document.querySelectorAll('[data-concept-dice]');

conceptDiceElements.forEach(function (element) {
    element.addEventListener("mouseover", function () {
        element.classList.add('ttl--primary');
    });

    element.addEventListener("mouseout", function () {
        element.classList.remove('ttl--primary');
    });
});

// Favourite Universe

const rpgList = document.getElementById('rpg-universe');
console.log(rpgList);

const personnalList = document.getElementById('personnal-list');
console.log(personnalList);

const selectArray = document.querySelectorAll('[data-select]');
console.log(selectArray);

const selectedList = document.querySelectorAll('[data-selected]');
console.log(selectedList);

// rpgList.addEventListener('click', function (event) {
//     for (const rpg of rpgList) {
//         templateRPGList.innerText = rpg.querySelector('[value]');
//         personnalList.appendChild(templateRPGList)
//     }
// })

const inputField = document.getElementById('inputField');
const selectedItemsList = document.getElementById('selectedItemsList');
const form = document.getElementById('create-account-form');
const submitButton = document.getElementById('create-account-btn');
const template = document.getElementById("favourite-template")

let selectedRPG = [];

inputField.addEventListener("keyup", function (event) {
    const inputText = inputField.value.trim();
    if (inputText !== '') {
        if (event.key === 'Enter') {
            const clonedTemplate = template.content.cloneNode(true);
            clonedTemplate.querySelector('#favourite-rpg').innerText = inputText;
            selectedItemsList.appendChild(template);
            inputField.value = '';
        }
    }
});

form.addEventListener('submit', function (event) {
    event.preventDefault();
});

submitButton.addEventListener('click', function (event) {
    form.submit();
});