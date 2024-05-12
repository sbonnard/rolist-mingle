import JDR from "./jdr.json" with {type: "json" }


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

const inputField = document.getElementById('inputField');
const selectedItemsList = document.getElementById('selectedItemsList');
const template = document.getElementById("favourite-template");
const suggestions = document.getElementById('suggestions');

let selectedRPG = [];

inputField.addEventListener('keyup', function (event) {
    const inputText = inputField.value.trim();
    if (inputText !== '') {
        if (event.key === 'Enter') {
            const clonedTemplate = template.content.cloneNode(true);
            clonedTemplate.getElementById('favourite-rpg').innerText = inputText;
            selectedItemsList.appendChild(clonedTemplate);
            inputField.value = '';
        } else {
            suggestions.innerHTML = "";
            let testList = JDR.filter(rpg => rpg.name.toLowerCase().includes(inputText.toLowerCase())).sort((a, b) => a.name > b.name ? 1 : b.name > a.name ? -1 : 0);
            testList.forEach(item => {
                let newItem = document.createElement('p');
                newItem.classList.add('js-suggestion', 'suggestions__itm');
                newItem.setAttribute('id', item.id);
                newItem.addEventListener('click', function () {
                    selectedRPG.push(item);
                    template.content.getElementById('favourite-rpg').innerHTML = item.name;
                    let clone = document.importNode(template.content, true);
                    clone.querySelector('.button--minus').addEventListener('click', function (event) {
                        event.target.parentNode.remove()
                    })
                    selectedItemsList.appendChild(clone);
                    newItem.remove();
                })
                const textItem = document.createTextNode(item.name);
                newItem.appendChild(textItem);
                suggestions.appendChild(newItem);
            })
        }
    } else {
        suggestions.innerHTML = '';
    }
});