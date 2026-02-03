const eyeButton = document.getElementById('eye-button');
const eyeButtonBis = document.getElementById('eye-button-bis');
const passwordInput = document.getElementById('password');
const passwordInputBis = document.getElementById('check-password');

eyeButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (passwordInput.type === 'password') {
        passwordInput.setAttribute('type', 'text');
        eyeButton.classList.add('button--eye--active');
    } else {
        passwordInput.setAttribute('type', 'password');
        eyeButton.classList.remove('button--eye--active');
    }
});

eyeButtonBis.addEventListener('click', function(e) {
    e.preventDefault();
    if (passwordInputBis.type === 'password') {
        passwordInputBis.setAttribute('type', 'text');
        eyeButtonBis.classList.add('button--eye--active');
    } else {
        passwordInputBis.setAttribute('type', 'password');
        eyeButtonBis.classList.remove('button--eye--active');
    }
});