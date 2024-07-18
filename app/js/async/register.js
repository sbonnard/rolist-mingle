// import { callAPI } from "./functions";

// document.getElementById('register-form').addEventListener('submit', function(event) {
//     event.preventDefault();
    
//     const form = event.target;
//     const formData = new FormData(form);
//     const formObject = {};
//     formData.forEach((value, key) => {
//         if (key === 'universes[]') {
//             if (!formObject[key]) {
//                 formObject[key] = [];
//             }
//             formObject[key].push(value);
//         } else {
//             formObject[key] = value;
//         }
//     });

//     callAPI('POST', formObject);
// });