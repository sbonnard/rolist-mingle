//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Dices variables

const dice100 = document.getElementById('dice100');
const dice20 = document.getElementById('dice20');
const dice12 = document.getElementById('dice12');
const dice10 = document.getElementById('dice10');
const dice8 = document.getElementById('dice8');
const dice6 = document.getElementById('dice6');
const dice4 = document.getElementById('dice4');

const allDices = document.querySelectorAll('[data-dice]');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Banners to display result.
const allBanners = document.querySelectorAll('[data-banner]');



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Loop to throw dices.
allDices.forEach(dice => {
    dice.addEventListener('click', function () {

        // Ajoute la classe pour l'animation du dé
        dice.classList.add('dice__rolling');
        dice.classList.add('dice__shadow');

        const diceValue = parseInt(dice.getAttribute('data-dice')); // Conversion en nombre

        // Génère un nombre aléatoire entre 1 et diceValue
        let random = getRandomNumber(1, diceValue);

        // Trouve la bannière associée au dé cliqué
        const bannerToShow = document.querySelector(`[data-banner="${diceValue}"]`);
        bannerToShow.classList.add('dice__banner--visible');

        if (bannerToShow) {
            bannerToShow.innerHTML = random; // Affiche le résultat dans la bannière

            // Vérification pour la réussite critique (entre 1 et 5 pour le dé 100)
            if (diceValue === 100 && random >= 1 && random <= 5) {
                bannerToShow.classList.add('dice--crit');
                bannerToShow.classList.remove('dice--fail', 'dice--normal'); // On enlève les autres classes
            }

            // Vérification pour l'échec critique (entre 95 et 100 pour le dé 100)
            if (diceValue === 100 && random >= 95 && random <= 100) {
                bannerToShow.classList.add('dice--fail');
                bannerToShow.classList.remove('dice--crit', 'dice--normal'); // On enlève les autres classes
            }

            // Résultat normal (entre 6 et 94 pour le dé 100)
            if (diceValue === 100 && random > 5 && random < 95) {
                bannerToShow.classList.add('dice--normal');
                bannerToShow.classList.remove('dice--crit', 'dice--fail'); // On enlève les autres classes
            }

            // Affiche la bannière avec une transition
            bannerToShow.classList.add('dice__banner--visible');

            // Masque la bannière après 5 secondes
            setTimeout(() => {
                bannerToShow.classList.remove('dice__banner--visible');
            }, 5000); // 5000 ms = 5 secondes
        }

        // Supprime la classe "dice__rolling" après 1,5 secondes
        setTimeout(() => {
            dice.classList.remove('dice__rolling');
        }, 1500); // 1500 ms = 1,5 secondes (durée de l'animation du dé)
    });
});



/**
 * get a random number between two values.
 * @param {number} min A number smaller than max.
 * @param {number} max A number higher than min.
 * @returns {number} A random number between min and max.
 */
function getRandomNumber(min, max) {
    let minValue = Math.ceil(min);
    let maxValue = Math.floor(max);
    return Math.floor(Math.random() * ((maxValue + 1) - minValue) + 1);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Manage to target body parts with a dice.

const bodyDice = document.getElementById('bodyDice');
const bodyParts = [
    'Jambe droite',
    'Jambe droite',
    'Jambe gauche',
    'Jambe gauche',
    'Bras droit',
    'Bras droit',
    'Bras gauche',
    'Bras gauche',
    'Tête',
    'Poitrine',
    'Poitrine',
    'Ventre',
    'Ventre',
    'Cou'
];

bodyDice.addEventListener('click', function () {
    // Ajoute la classe pour l'animation du dé
    bodyDice.classList.add('dice__rolling');

    const diceValue = bodyParts[Math.floor(Math.random() * bodyParts.length)];

    console.log(diceValue);


    const bannerToShow = document.querySelector(`[data-banner="body"]`);
    bannerToShow.classList.add('dice__banner--visible');
    bannerToShow.innerHTML = diceValue;

    setTimeout(() => {
        bannerToShow.classList.remove('dice__banner--visible');
    }, 5000); // 5000 ms = 5 secondes

    setTimeout(() => {
        bodyDice.classList.remove('dice__rolling');
    }, 1500); // 1500 ms = 1,5 secondes (durée de l'animation du dé)
});