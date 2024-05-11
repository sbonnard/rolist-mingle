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




// <!-- <select class="input input__select" type="select" name="rpg-universe" id="rpg-universe">
// <option value="exemple" data-select="0">Mes univers</option>
// <option value="Medieval Fantasy" data-select="1">Medieval Fantasy</option>
// <option value="Post-Apocalyptique" data-select="2">Post-Apocalyptique</option>
// <option value="Horreur" data-select="3">Horreur</option>
// <option value="Western" data-select="4">Western</option>
// <option value="Science-Fiction" data-select="5">Science-Fiction</option>
// <option value="Space Opera" data-select="6">Space Opera</option>
// <option value="Steampunk" data-select="7">Steampunk</option>
// <option value="Historique" data-select="8">Historique</option>
// <option value="Mythologique" data-select="9">Mythologique</option>
// <option value="L'Oeil noir, le livre des règles" data-select="10">L'Oeil noir, le livre des règles
// </option>
// <option value="Donjons et Dragons 1" data-select="11">Donjons et Dragons 1</option>
// <option value="Donjons et Dragons 2" data-select="12">Donjons et Dragons 2</option>
// <option value="Donjons et Dragons 3" data-select="13">Donjons et Dragons 3</option>
// <option value="Donjons et Dragons 4" data-select="14">Donjons et Dragons 4</option>
// <option value="Donjons et Dragons 5" data-select="15">Donjons et Dragons 5</option>
// <option value="personnalisé" data-select="16">JDR personnalisé</option>
// <option value="Star Wars D6" data-select="17">Star Wars D6</option>
// <option value="Star Wars D20" data-select="18">Star Wars D20</option>
// <option value="Star Wars FFG" data-select="19">Star Wars FFG</option>
// <option value="Star Wars confins" data-select="20">Star Wars aux confins de l'empire</option>
// <option value="Runequest" data-select="21">Runequest</option>
// <option value="L'Appel de Cthulhu : 6ème Édition" data-select="22">L'Appel de Cthulhu : 6ème Édition</option>
// <option value="Achtung! Cthulhu: le guide de l'investigateur" data-select="23">Achtung! Cthulhu: le guide de l'investigateur</option>
// <option value="In Nomine Satanis / Magna Veritas - 3ème Édition" data-select="24">In Nomine Satanis / Magna Veritas - 3ème Édition</option>
// <option value="Shadowrun" data-select="25">Shadowrun</option>
// <option value="Warhammer" data-select="26">Warhammer</option>
// <option value="Warhammer 40K" data-select="27">Warhammer 40K</option>
// <option value="Paranoïa" data-select="28">Paranoïa</option>
// <option value="Pendragon (1985)" data-select="29">Pendragon (1985)</option>
// <option value="Vampire : La Mascarade" data-select="30">Vampire : La Mascarade</option>
// <option value="Stormbringer (1981)" data-select="31">Stormbringer (1981)</option>
// <option value="C.O.P.S." data-select="32">C.O.P.S.</option>
// <option value="Rêve de Dragon" data-select="33">Rêve de Dragon</option>
// <option value="Pavillon Noir : La Révolte" data-select="34">Pavillon Noir : La Révolte</option>
// <option value="Animonde" data-select="35">Animonde</option>
// <option value="Ars Magica" data-select="36">Ars Magica</option>
// <option value="Château Falkenstein" data-select="37">Château Falkenstein</option>
// <option value="Château Bitume" data-select="38">Bitume</option>
// <option value="Feng Shui" data-select="39">Feng Shui</option>
// <option value="Dark Heresy" data-select="40">Dark Heresy</option>
// <option value="Ambre" data-select="41">Ambre</option>
// <option value="La methode du docteur chestel" data-select="42">La methode du docteur chestel</option>
// <option value="Maléfices" data-select="43">Maléfices</option>
// <option value="Cyberpunk 2020" data-select="44">Cyberpunk 2020</option>
// <option value="Terres du Milieu" data-select="45">Jeu de rôle des Terres du Milieu</option>
// </select>
// </li>
// <ul id="personnal-list">
// <li class="hidden" data-selected="1">Medieval Fantasy</li>
// <li class="hidden" data-selected="2">Post-Apocalyptique</li>
// <li class="hidden" data-selected="3">Horreur</li>
// <li class="hidden" data-selected="4">Western</li>
// <li class="hidden" data-selected="5">Science-Fiction</li>
// <li class="hidden" data-selected="6">Space Opera</li>
// <li class="hidden" data-selected="7">Steampunk</li>
// <li class="hidden" data-selected="8">Historique</li>
// <li class="hidden" data-selected="9">Mythologique</li>
// <li class="hidden" data-selected="10">L'Oeil noir, le livre des règles</li>
// <li class="hidden" data-selected="11">Donjons et Dragons 1</li>
// <li class="hidden" data-selected="12">Donjons et Dragons 2</li>
// <li class="hidden" data-selected="13">Donjons et Dragons 3</li>
// <li class="hidden" data-selected="14">Donjons et Dragons 4</li>
// <li class="hidden" data-selected="15">Donjons et Dragons 5</li>
// <li class="hidden" data-selected="16">JDR personnalisé</li>
// <li class="hidden" data-selected="17">Star Wars D6</li>
// <li class="hidden" data-selected="18">Star Wars D20</li>
// <li class="hidden" data-selected="19">Star Wars FFG</li>
// <li class="hidden" data-selected="20">Star Wars aux confins de l'empire</li>
// <li class="hidden" data-selected="21">Runequest</li>
// <li class="hidden" data-selected="22">L'Appel de Cthulhu : 6ème Édition</li>
// <li class="hidden" data-selected="23">Achtung! Cthulhu: le guide de l'investigateur</li>
// <li class="hidden" data-selected="24">In Nomine Satanis / Magna Veritas - 3ème Édition</li>
// <li class="hidden" data-selected="25">Shadowrun</li>
// <li class="hidden" data-selected="26">Warhammer</li>
// <li class="hidden" data-selected="27">Warhammer 40K</li>
// <li class="hidden" data-selected="28">Paranoïa</li>
// <li class="hidden" data-selected="29">Pendragon (1985)</li>
// <li class="hidden" data-selected="30">Vampire : La Mascarade</li>
// <li class="hidden" data-selected="31">Stormbringer (1981)</li>
// <li class="hidden" data-selected="32">C.O.P.S.</li>
// <li class="hidden" data-selected="33">Rêve de Dragon</li>
// <li class="hidden" data-selected="34">Pavillon Noir : La Révolte</li>
// <li class="hidden" data-selected="35">Animonde</li>
// <li class="hidden" data-selected="36">Ars Magica</li>
// <li class="hidden" data-selected="37">Château Falkenstein</li>
// <li class="hidden" data-selected="38">Bitume</li>
// <li class="hidden" data-selected="39">Feng Shui</li>
// <li class="hidden" data-selected="40">Dark Heresy</li>
// <li class="hidden" data-selected="41">Ambre</li>
// <li class="hidden" data-selected="42">La methode du docteur chestel</li>
// <li class="hidden" data-selected="43">Maléfices</li>
// <li class="hidden" data-selected="44">Cyberpunk 2020</li>
// <li class="hidden" data-selected="45">Jeu de rôle des Terres du Milieu</li>
// </ul> -->