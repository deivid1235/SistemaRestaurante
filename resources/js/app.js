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

let images = [];
let idx = 0;

/* =========================
   CARRUSEL
========================= */

// Seleccionar imagen
window.selectThumb = function (i) {
    if (!images || images.length === 0) return;

    // evitar desbordes de índice
    idx = Math.max(0, Math.min(i, images.length - 1));

    const activeImg   = document.getElementById('activeImg');
    const counterText = document.getElementById('counterText');
    const deleteInput = document.getElementById('deleteInput');
    const btnPrev     = document.getElementById('btnPrev');
    const btnNext     = document.getElementById('btnNext');

    if (!activeImg || !counterText || !deleteInput) return;

    activeImg.src = images[idx].src;
    counterText.textContent = (idx + 1) + ' / ' + images.length;
    deleteInput.value = images[idx].name;

    if (btnPrev) btnPrev.disabled = (idx === 0);
    if (btnNext) btnNext.disabled = (idx === images.length - 1);

    document.querySelectorAll('.thumb-item').forEach((t, j) => {
        t.classList.toggle('border-blue-500', j === idx);
        t.classList.toggle('border-transparent', j !== idx);
    });
};

// Navegación
window.navigate = function (dir) {
    window.selectThumb(idx + dir);
};

/* PREVIEW UPLOAD */

window.handlePreview = function (input) {
    const file = input.files[0];
    if (!file) return;

    const previewImg     = document.getElementById('previewImg');
    const previewSection = document.getElementById('previewSection');
    const dropZone       = document.getElementById('dropZone');

    if (!previewImg || !previewSection || !dropZone) return;

    const reader = new FileReader();

    reader.onload = e => {
        previewImg.src = e.target.result;
        previewSection.classList.remove('hidden');
        dropZone.classList.add('hidden');
    };

    reader.readAsDataURL(file);
};

// Cancelar subida
window.cancelUpload = function () {
    const previewSection = document.getElementById('previewSection');
    const dropZone       = document.getElementById('dropZone');
    const fileInput      = document.getElementById('fileInput');

    if (previewSection) previewSection.classList.add('hidden');
    if (dropZone) dropZone.classList.remove('hidden');
    if (fileInput) fileInput.value = '';
};

/* INICIALIZACIÓN */
document.addEventListener('DOMContentLoaded', () => {

    // cargar imágenes del backend
    images = window.carruselImages || [];

    if (!Array.isArray(images) || images.length === 0) {
        console.warn('No hay imágenes en el carrusel');
        return;
    }

    // esperar a que funciones existan
    if (typeof window.selectThumb === 'function') {
        window.selectThumb(0);
    } else {
        // fallback seguro
        idx = 0;
        updateCarousel();
    }

    /* COLOR PICKER */
    const picker = document.getElementById('colorPicker');

    if (picker) {
        picker.addEventListener('input', (e) => {
            const color = e.target.value;
            document.documentElement.style.setProperty('--primary', color);
        });
    }
});