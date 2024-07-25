const eyeButton = document.getElementById('eye-button');
const passwordInput = document.getElementById('password');

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