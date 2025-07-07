document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-bar-link');
    const closeBtn = document.querySelector('.close-menu');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('open');
        });
    }
    if (closeBtn && navLinks) {
        closeBtn.addEventListener('click', function() {
            navLinks.classList.remove('open');
        });
    }
});
document.querySelector('.hamburger').addEventListener('click', function() {
    document.querySelector('.nav-bar-link').classList.toggle('open');
});
