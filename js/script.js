// // import Swiper bundle with all modules installed
// import Swiper from 'swiper/bundle';

// // import styles bundle
// import 'swiper/css/bundle';

// //Swiper

// const swiper = new Swiper('.swiper', {
//     // Optional parameters
//     direction: 'horizontal',
//     loop: true,

//     // Navigation arrows
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },

//     // // And if we need scrollbar
//     scrollbar: {
//       el: '.swiper-scrollbar',
//     },
// });


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

const templateRPGList = document.querySelector('[data-favourite-rpg]');

rpgList.addEventListener('click', function (event) {
    for (const rpg of rpgList) {
        templateRPGList.innerText = rpg.querySelector('[value]');
        personnalList.appendChild(templateRPGList)
    }
})
