import JDR from "./jdr.json" with {type: "json" };

/**
 * Get filtered suggestions from suggestions field.
 * @param {element} input - The suggestion field you have to write in to get suggestions.
 * @returns {element} - The filtered RPG suggestions from the text you wrote in the field.
 */
function getFilteredSuggestions(input) {
    return JDR.filter(rpg => rpg.name.toLowerCase().includes(input.toLowerCase()))
        .sort((a, b) => a.name.localeCompare(b.name))
        .slice(0, 10);
}

/**
 * Creates a suggestion item in the DOM.
 * @param {element} item The item you want to create.
 * @returns {element} The item in the DOM as a RPG suggestion.
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
 * @param {element} item The item you want to add to selected list in the DOM.
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

export default {
    getFilteredSuggestions,
    createSuggestionItem,
    addItemToSelectedList,
    clearSuggestionsAndInput
}