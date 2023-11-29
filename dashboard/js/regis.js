// Toggle class Active

const navbarNav = document.querySelector('.navbar-nav');

// Ketika Menu diklik

document.querySelector('#hamburger-menu').onclick = () => {
navbarNav.classList.toggle('active');
};

// Klik di luar sidebar

const hamburger = document.querySelector('#hamburger-menu');
document.addEventListener ('click', function(e){
    if(!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove('active');
    }
})

const passwordInput = document.getElementById('password');
const toggleButton = document.getElementById('toggleButton');
const icon = document.getElementById('icon');

toggleButton.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.src = "../img/hide.png";

    } else {
        passwordInput.type = 'password';
        icon.src = "img/show.png";
    }
});