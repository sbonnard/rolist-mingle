<?php

function getCharacterDatas(PDO $dbCo): array
{
    $query = $dbCo->prepare("SELECT * FROM characters WHERE id_user = :id_user ORDER BY characters.name;");

    $bindValues = [
        "id_user" => $_SESSION['id_user']
    ];

    $query->execute($bindValues);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Generates an ordered list of character sheets based on the given character data.
 * If no characters are found, a message indicating this will be displayed.
 *
 * @param array $characterDatas The array of character data.
 * @return string The HTML unordered list of character sheets.
 */
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

/**
 * Fetches the character data from the database based on the id_user and id_character in the session.
 *
 * @param PDO $dbCo The connection to the database.
 * @return array The character data as an associative array.
 */

function getSelectedCharacterDatas(PDO $dbCo): array
{
    $query = $dbCo->prepare("SELECT * FROM characters WHERE id_user = :id_user AND id_character = :id_character;");

    $bindValues = [
        "id_user" => $_SESSION['id_user'],
        "id_character" => $_SESSION['id_character']
    ];

    $query->execute($bindValues);

    return $query->fetch(PDO::FETCH_ASSOC);
}

function findCharacterById(array $charactersList, int $id): ?array
{
    foreach ($charactersList as $char) {
        if ($char['id_character'] === $id) {
            return $char;
        }
    }
    return null;
}

function renderCharacterSelect(array $charactersList, string $token): string
{
    ob_start(); ?>
    <form class="form">
        <li class="form__itm form__itm--select">
            <label class="input__label" for="selectCharacter">Sélectionne un personnage</label>
            <select class="input__select" name="selectCharacter" id="selectCharacter">
                <option value="" selected disabled hidden>Sélectionne un personnage</option>
                <?php foreach ($charactersList as $char): ?>
                    <option value="<?= $char['id_character'] ?>"><?= $char['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </li>
        <input type="hidden" name="token" value="<?= $token ?>">
        <input type="hidden" name="action" value="log-in">
    </form>
<?php
    return ob_get_clean();
}

function renderCharacterSheet(array $character, string $characterForm): string
{
    $character = '';

    if (!isset($session['id_character'])) {
        $character .= ' <section class="character" id="character-sheet">
                            <h2>Sélectionne un personnage</h2>
                            ' . $characterForm . '
                        </section>';
        return $character;
    } else {
        $character .= '
             <section class="character" id="character-sheet">';

        $character .= $characterForm;

        $character .= '<img class="character-sheet__img" src="' . $character['imgUrl'] . '" alt="Image de personnage ' . $character['name'] . '">
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
            </section>';
    }

    return $character;
}

function getCharacterSheet(array $session, array $charactersList, bool $dicerollerPage): string
{
    if (empty($charactersList)) {
        return '<p>Aucun personnage trouvé</p>
                <a href="character-form.php" class="button">Créer personnage</a>';
    }

    $characterForm = $dicerollerPage
        ? renderCharacterSelect($charactersList, $session['token'])
        : '';

    if (!isset($session['id_character'])) {
        return '<section class="character" id="character-sheet">
                    <h2>Sélectionne un personnage</h2>'
            . $characterForm .
            '</section>';
    }

    $selectedCharacter = findCharacterById($charactersList, $session['id_character']);

    if (!$selectedCharacter) {
        return '<p>Personnage introuvable</p>';
    }

    return renderCharacterSheet($selectedCharacter, $characterForm);
}

// function getCharacterSheet(array $session, array $charactersList, bool $dicerollerPage): string
// {
//     $character = '';
//     $characterForm = '';

//     if (empty($charactersList)) {
//         $character .= '<p>Aucun personnage trouvé</p>
//         <a href="character-form.php" class="button">Créer personnage</a>';

//         return $character;
//     }

//     if ($dicerollerPage) {
//         $characterForm .= '<form class="form" action="actions.php">
//                 <li class="form__itm form__itm--select">
//                     <label class="input__label" for="selectCharacter">Sélectionne un personnage</label>
//                     <select class="input__select" name="selectCharacter" id="selectCharacter">
//                     <option value="" selected disabled hidden>Sélectionne un personnage</option>';

//         foreach ($charactersList as $characterData) {
//             $characterForm .= '<option value="' . $characterData['id_character'] . '">' . $characterData['name'] . '</option>';
//         }

//         $characterForm .= '</select>
//                 </li>
//                 <input type="hidden" name="token" value="' . $session['token'] . '">
//                 <!-- <button type="submit" class="button bg-blur"></button> -->
//             </form>';
//     }

//     if (!isset($session['id_character'])) {
//         $character .= ' <section class="character" id="character-sheet">
//                             <h2>Sélectionne un personnage</h2>
//                             ' . $characterForm . '
//                         </section>';
//         return $character;
//     } else {
//         $character .= '
//              <section class="character" id="character-sheet">';

//         $character .= $characterForm;

//         $character .= '<img class="character-sheet__img" src="' . $character['imgUrl'] . '" alt="Image de personnage ' . $character['name'] . '">
//                 <h2 class="character-sheet__name">' . $character['name'] . '</h2>
//                 <section class="character-sheet__stats">
//                     <div id="health-bar">
//                         <h3>PV</h3>
//                         <div class="character-sheet__stats__points">
//                             <p class="character-sheet__stats--pv">' . $character['hp'] . '</p>
//                             <p>/</p>
//                             <p>' . $character['maxHP'] . '</p>
//                         </div>
//                     </div>
//                     <div id="mana-bar">
//                         <h3>Mana</h3>
//                         <div class="character-sheet__stats__points">
//                             <p class="character-sheet__stats--mana">' . $character['mana'] . '</p>
//                             <p>/</p>
//                             <p>' . $character['maxMana'] . '</p>
//                         </div>
//                     </div>
//                 </section>
//                 <div class="bg-blur character-sheet__wallet-container">
//                     <h3 class="ttl ttl--small">Bourse</h3>
//                     <section class="character-sheet__wallet">
//                         <div class="character-sheet__coins">
//                             <img class="coin" src="img/gold.png" alt="Icône de pièce d\'or">
//                             <p class="character-sheet__coins--amount">' . $character['gold'] . '</p>
//                         </div>
//                         <div class="character-sheet__coins">
//                             <img class="coin" src="img/silver.png" alt="Icône de pièce d\'argent">
//                             <p class="character-sheet__coins--amount">' . $character['silver'] . '</p>
//                         </div>
//                         <div class="character-sheet__coins">
//                             <img class="coin" src="img/copper.png" alt="Icône de pièce de cuivre">
//                             <p class="character-sheet__coins--amount">' . $character['copper'] . '</p>
//                         </div>
//                     </section>
//                 </div>
//             </section>';
//     }

//     return $character;
// }
