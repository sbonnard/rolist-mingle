document.addEventListener("DOMContentLoaded", () => {

    const select = document.getElementById("selectCharacter");
    const sheet = document.getElementById("character-sheet");

    if (!select) return;

    select.addEventListener("change", async () => {
        const idCharacter = select.value;
        if (!idCharacter) return;

        try {
            const response = await fetch("api.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ action: "getCharacter", id_character: idCharacter })
            });

            // Lire une fois le body
            const text = await response.text();
            console.log("Raw response:", text);

            // Puis parser le JSON
            const data = JSON.parse(text);

            if (data.error) {
                sheet.innerHTML = `<p>${data.error}</p>`;
                return;
            }

            sheet.innerHTML = renderCharacterSheet(data.character);

        } catch (error) {
            console.error(error);
            sheet.innerHTML = "<p>Erreur lors du chargement du personnage</p>";
        }
    });
});

// Une petite fonction JS pour générer le HTML
function renderCharacterSheet(c) {
    return `
        <img class="character-sheet__img" src="${c.imgUrl}" alt="Image de ${c.name}">
        <h2 class="character-sheet__name">${c.name}</h2>

        <section class="character-sheet__stats">
            <div id="health-bar">
                <h3>PV</h3>
                <div class="character-sheet__stats__points">
                    <p class="character-sheet__stats--pv">${c.hp}</p><p>/</p><p>${c.maxHP}</p>
                </div>
            </div>
            <div id="mana-bar">
                <h3>Mana</h3>
                <div class="character-sheet__stats__points">
                    <p class="character-sheet__stats--mana">${c.mana}</p><p>/</p><p>${c.maxMana}</p>
                </div>
            </div>
        </section>

        <div class="bg-blur character-sheet__wallet-container">
            <h3 class="ttl ttl--small">Bourse</h3>
            <section class="character-sheet__wallet">
                <div class="character-sheet__coins">
                    <img class="coin" src="img/gold.png" alt="or">
                    <p class="character-sheet__coins--amount">${c.gold}</p>
                </div>
                <div class="character-sheet__coins">
                    <img class="coin" src="img/silver.png" alt="argent">
                    <p class="character-sheet__coins--amount">${c.silver}</p>
                </div>
                <div class="character-sheet__coins">
                    <img class="coin" src="img/copper.png" alt="cuivre">
                    <p class="character-sheet__coins--amount">${c.copper}</p>
                </div>
            </section>
        </div>
    `;
};
