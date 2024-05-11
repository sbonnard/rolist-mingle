const inputField = document.getElementById('inputField');
const autocompleteList = document.getElementById('autocompleteList');
const selectedItemsList = document.getElementById('selectedItemsList');
const form = document.querySelector('form');
const submitButton = document.querySelector('input[type="submit"]');

let selectedRPG = [];

inputField.addEventListener('input', function() {
  const inputText = this.value.trim().toLowerCase();
  autocompleteList.innerHTML = '';

  if (inputText !== '') {
    const filteredRPG = rpgs.filter(rpg => rpg.toLowerCase().startsWith(inputText));
    filteredRPG.forEach(rpg => {
      const listItem = document.createElement('li');
      listItem.textContent = rpg;
      listItem.addEventListener('click', function() {
        selectItem(rpg);
      });
      autocompleteList.appendChild(listItem);
    });
  }
});

inputField.addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
    const inputText = this.value.trim();
    if (inputText !== '') {
      selectItem(inputText);
    }
  }
});

form.addEventListener('submit', function(event) {
  event.preventDefault();
});

submitButton.addEventListener('click', function(event) {
  form.submit();
});

function selectItem(item) {
    selectedRPG.push(item);
    const listItem = document.createElement('li');
    listItem.textContent = item;
    listItem.classList.add('txt--bigger');
    selectedItemsList.appendChild(listItem);
    inputField.value = '';
}