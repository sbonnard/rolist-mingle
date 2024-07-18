// /**
//  * Generate asynchronous call to api.php with parameters
//  * @param {*} method GET, POST, PUT or DELETE
//  * @param {*} params An object with data to send.
//  * @returns 
//  */
// async function callAPI(method, params) {
//     try {
//         const response = await fetch("actions.php", {
//             method: method,
//             body: JSON.stringify(params),
//             headers: {
//                 'Content-type': 'application/json'
//             }
//         });
//         const dataResponse = await response.json();
//         return dataResponse;
//     }
//     catch (error) {
//         console.error("Unable to load datas from server : " + error);
//     }
// }

// export {
//     callAPI
// }