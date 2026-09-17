const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function (event) {
        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        const usernameError = document.getElementById('usernameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        usernameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        username.classList.remove('input-error');
        email.classList.remove('input-error');
        password.classList.remove('input-error');
        confirmPassword.classList.remove('input-error');

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passwordPattern = /^\w{4,}[-#@].*$/;
        let valid = true;

        if (username.value.trim() === '') {
            usernameError.textContent = 'Enter a username.';
            username.classList.add('input-error');
            valid = false;
        }

        if (!emailPattern.test(email.value)) {
            emailError.textContent = 'Enter a valid email address.';
            email.classList.add('input-error');
            valid = false;
        }

        if (!passwordPattern.test(password.value)) {
            passwordError.textContent = 'Use at least 4 word characters, then -, #, or @.';
            password.classList.add('input-error');
            valid = false;
        }

        if (password.value !== confirmPassword.value) {
            confirmPasswordError.textContent = 'Passwords do not match.';
            confirmPassword.classList.add('input-error');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });
}
