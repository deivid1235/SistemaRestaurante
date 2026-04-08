function setupMobileMenu() {
    const button = document.getElementById('mobile-menu-button');
    const menu   = document.getElementById('mobile-menu');

    button?.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
}

document.addEventListener('DOMContentLoaded', setupMobileMenu);

// Login del sistema
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.hero-slider .slide');
    let current = 0;

    if (slides.length > 1) {
        setInterval(() => {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');

            current = (current + 1) % slides.length;

            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
        }, 5000);
    }

    const openBtn = document.querySelector('a[href="#login-modal"]');
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-login-modal');

    if (openBtn && modal && closeBtn) {

        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.remove('hidden');
        });

        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-login-modal');
    const openBtns = document.querySelectorAll('a[href="#login-modal"]');
    openBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.remove('hidden');
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

});