// import JDR from "./jdr.json" with {type: "json"}
// import * from "./"

// Favourite Universe

const suggestionsField = document.getElementById('suggestionsField');
const selectedItemsList = document.getElementById('selectedItemsList');
const template = document.getElementById("favourite-template");
const suggestions = document.getElementById('suggestions');

let selectedRPG = [];

/**
 * Fetch RPG data from the server.
 * @param {string} searchTerm - The search term to filter RPGs.
 * @returns {Promise<Array>} - A promise that resolves to the list of RPGs.
 */
async function fetchRPGData(searchTerm) {
    try {
        const url = `../api_rpg.php?search=${encodeURIComponent(searchTerm)}`;

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        return data.map(rpg => ({ name: rpg.name_universe }));
    } catch (error) {
        console.error('Failed to fetch RPG data:', error);
        return [];
    }
}

/**
 * Get filtered suggestions from suggestions field.
 * @param {string} input - The suggestion field you have to write in to get suggestions.
 * @param {Array} rpgList - The list of all RPGs.
 * @returns {Array} - The filtered RPG suggestions from the text you wrote in the field.
 */
function getFilteredSuggestions(input, rpgList) {
    return rpgList.filter(rpg => rpg.name.toLowerCase().includes(input.toLowerCase()))
        .sort((a, b) => a.name.localeCompare(b.name))
        .slice(0, 10);
}

/**
 * Creates a suggestion item in the DOM.
 * @param {Object} item - The item you want to create.
 * @returns {Element} - The item in the DOM as a RPG suggestion.
 */
function createSuggestionItem(item) {
    let newItem = document.createElement('div');
    newItem.classList.add('js-suggestion', 'suggestions__itm');
    newItem.setAttribute('id', item.id);
    newItem.addEventListener('click', function () {
        addItemToSelectedList(item);
        clearSuggestionsAndInput();
        newItem.remove();
    });
    newItem.appendChild(document.createTextNode(item.name));
    return newItem;
}

/**
 * Adds an item to selected list RPG. Adds an addeventlistener to button--minus to remove the item from selected list.
 * @param {Object} item - The item you want to add to selected list in the DOM.
 */
function addItemToSelectedList(item) {
    selectedRPG.push(item);
    template.content.getElementById('favourite-rpg').innerHTML = item.name;
    let clone = document.importNode(template.content, true);
    clone.querySelector('.button--minus').addEventListener('click', function (event) {
        event.target.parentNode.remove();
        suggestions.innerHTML = '';
    });
    selectedItemsList.appendChild(clone);
}

/**
 * Clears suggestions you click on any suggestion in the suggestions list.
 */
function clearSuggestionsAndInput() {
    suggestions.innerHTML = '';
    suggestionsField.value = '';
}

let allRPGData = [];

suggestionsField.addEventListener('keyup', function (event) {
    const inputText = suggestionsField.value.trim();
    if (inputText !== '') {
        fetchRPGData(inputText).then(data => {
            allRPGData = data;
            const suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = "";
            let suggestionList = getFilteredSuggestions(inputText, allRPGData);
            suggestionList.forEach(item => {
                let newItem = createSuggestionItem(item);
                suggestions.appendChild(newItem);
            });
        });
    } else {
        const suggestions = document.getElementById('suggestions');
        suggestions.innerHTML = '';
        clearSuggestionsAndInput();
    }
});