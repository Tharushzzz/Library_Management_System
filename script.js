const menuBtn = document.getElementById('menu_btn');
const menu = document.getElementById('navbar');
const menuCloseBtn = document.getElementById('menu-close');
const navLinks = document.querySelectorAll('.menu_btn');

if (menuBtn && menu) {
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
}

if (menuCloseBtn && menu) {
    menuCloseBtn.addEventListener('click', () => {
        menu.classList.remove('active');
    });
}

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (menu) {
            menu.classList.remove('active');
        }
    });
});



// Login/Register Form Toggle

const loginButton = document.getElementById('LoginBtn');
const registerButton = document.getElementById('RegisterBtn');
const loginForm = document.getElementById('logIn_form');
const registerForm = document.getElementById('register_form');

loginButton.classList.add('active');

function showLoginForm() {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    loginButton.classList.add('active');
    registerButton.classList.remove('active');
}

function showRegisterForm() {
    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    registerButton.classList.add('active');
    loginButton.classList.remove('active');
}

loginButton.addEventListener('click', showLoginForm);
registerButton.addEventListener('click', showRegisterForm);

