document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('[data-favourite-minus]');

    deleteButtons.forEach(button => {
        button.addEventListener('change', function () {
            if (this.checked === false) {
                const universeId = this.getAttribute('data-delete-rpg-id');

                fetch('api-CRUD.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'delete',
                        id: universeId
                    })
                })
                    .then(response => {
                        console.log('Raw response:', response);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Parsed response:', data);
                        if (data.success) {
                            this.closest('.favourites').remove();
                        } else {
                            console.error('Failed to delete favourite:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
});

// BUTTONS & FORMS


// BUTTONS
const buttonBio = document.getElementById('button-bio');
const buttonPWD = document.getElementById('button-pwd');
const buttonRPG = document.getElementById('button-rpg');

console.log(buttonBio, buttonPWD, buttonRPG);

//FORMS

const formBio = document.getElementById('form-bio');
const formPWD = document.getElementById('form-pwd');
const formRPG = document.getElementById('form-rpg');

console.log(formBio, formPWD, formRPG);

// LISTENERS

// BIO
buttonBio.addEventListener('click', function () {
    // BIO FORM AND BUTTON
    if (!buttonBio.classList.contains('button--CRUD--active')) {
        buttonBio.classList.toggle('button--CRUD--active');
        formBio.classList.toggle('hidden');

        // PASSWORD FORM AND BUTTON
        buttonPWD.classList.remove('button--CRUD--active');
        formPWD.classList.add('hidden');

        // RPG FORM AND BUTTON
        buttonRPG.classList.remove('button--CRUD--active');
        formRPG.classList.add('hidden');
    }
})


// PASSWORD
buttonPWD.addEventListener('click', function () {
    // PASSWORD FORM AND BUTTON
    if (!buttonPWD.classList.contains('button--CRUD--active')) {
        buttonPWD.classList.toggle('button--CRUD--active');
        formPWD.classList.toggle('hidden');

        // PASSWORD FORM AND BUTTON
        buttonBio.classList.remove('button--CRUD--active');
        formBio.classList.add('hidden');

        // RPG FORM AND BUTTON
        buttonRPG.classList.remove('button--CRUD--active');
        formRPG.classList.add('hidden');
    }
})


// RPG
buttonRPG.addEventListener('click', function () {
    // RPG FORM AND BUTTON
    if (!buttonRPG.classList.contains('button--CRUD--active')) {
        buttonRPG.classList.toggle('button--CRUD--active');
        formRPG.classList.toggle('hidden');

        // PASSWORD FORM AND BUTTON
        buttonPWD.classList.remove('button--CRUD--active');
        formPWD.classList.add('hidden');

        // BIO FORM AND BUTTON
        buttonBio.classList.remove('button--CRUD--active');
        formBio.classList.add('hidden');
    }
})