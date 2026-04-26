const menuBtn = document.getElementById('menu_btn');
const menu = document.getElementById('navbar');
const menuCloseBtn = document.getElementById('menu-close');
let navLinks = document.querySelectorAll('.menu_btn');


menuBtn.addEventListener('click', () => {
    menu.classList.toggle('active');
});

menuCloseBtn.addEventListener('click', () => {
    menu.classList.remove('active');
});

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        menu.classList.remove('active');
    });
});