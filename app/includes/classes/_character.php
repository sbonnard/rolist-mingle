<?php

function getCharacterDatas(PDO $dbCo): array
{
    $query = $dbCo->prepare("SELECT * FROM characters WHERE id_user = :id_user;");

    $bindValues = [
        "id_user" => $_SESSION['id_user']
    ];

    $query->execute($bindValues);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getCharactersSheetsList(array $characterDatas)
{
    $charactersList = '<ul class="character__list">';

    if (empty($characterDatas)) {
        $charactersList .= '<li>Aucun personnage trouvé</li>';
    } else {
        foreach ($characterDatas as $character) {
            $charactersList .= '
             <section class="character" id="character-sheet">
                <img class="character-sheet__img" src="' . $character['imgUrl'] . '" alt="Image de personnage ' . $character['name'] . '">
                <h2 class="character-sheet__name">' . $character['name'] . '</h2>
                <section class="character-sheet__stats">
                    <div id="health-bar">
                        <h3>PV</h3>
                        <div class="character-sheet__stats__points">
                            <p class="character-sheet__stats--pv">' . $character['hp'] . '</p>
                            <p>/</p>
                            <p>' . $character['maxHP'] . '</p>
                        </div>
                    </div>
                    <div id="mana-bar">
                        <h3>Mana</h3>
                        <div class="character-sheet__stats__points">
                            <p class="character-sheet__stats--mana">' . $character['mana'] . '</p>
                            <p>/</p>
                            <p>' . $character['maxMana'] . '</p>
                        </div>
                    </div>
                </section>
                <div class="bg-blur character-sheet__wallet-container">
                    <h3 class="ttl ttl--small">Bourse</h3>
                    <section class="character-sheet__wallet">
                        <div class="character-sheet__coins">
                            <img class="coin" src="img/gold.png" alt="Icône de pièce d\'or">
                            <p class="character-sheet__coins--amount">' . $character['gold'] . '</p>
                        </div>
                        <div class="character-sheet__coins">
                            <img class="coin" src="img/silver.png" alt="Icône de pièce d\'argent">
                            <p class="character-sheet__coins--amount">' . $character['silver'] . '</p>
                        </div>
                        <div class="character-sheet__coins">
                            <img class="coin" src="img/copper.png" alt="Icône de pièce de cuivre">
                            <p class="character-sheet__coins--amount">' . $character['copper'] . '</p>
                        </div>
                    </section>
                </div>
            </section>
            ';
        }
    }

    $charactersList .= '</ul>';

    return $charactersList;
}
