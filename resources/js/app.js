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
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-login-modal');
    const openBtns = document.querySelectorAll('.open-login');
    openBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (!window.location.href.includes('inicio')) return;

            e.preventDefault();

            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    }

    const params = new URLSearchParams(window.location.search);

    if (params.get('login') === 'true') {
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

});

let images = [];
let idx = 0;

/* CARRUSEL*/

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

    images = window.carruselImages || [];

    if (!Array.isArray(images) || images.length === 0) {
        console.warn('No hay imágenes en el carrusel');
        return;
    }

    if (typeof window.selectThumb === 'function') {
        window.selectThumb(0);
    } else {
        idx = 0;
        updateCarousel();
    }

    const picker = document.getElementById('colorPicker');

    if (picker) {
        picker.addEventListener('input', (e) => {
            const color = e.target.value;
            document.documentElement.style.setProperty('--primary', color);
        });
    }
});

// Libro de reclamaciones Departamentos → provincia → distrito
document.addEventListener('DOMContentLoaded', function() {

    let ubigeoData = {};

    const deptSelect = document.getElementById('departamento');
    const provSelect = document.getElementById('provincia');
    const distSelect = document.getElementById('distrito');

    async function cargarUbigeo() {
        try {
            const response = await fetch('https://raw.githubusercontent.com/CONCYTEC/ubigeo-peru/master/equivalencia-ubigeos-oti-concytec.json');
            const dataFlat = await response.json();

            dataFlat.forEach(item => {
                let dep = item.desc_dep_inei;
                let prov = item.desc_prov_inei;
                let dist = item.desc_ubigeo_inei;

                if (dep && prov && dist) {
                    if (!ubigeoData[dep]) ubigeoData[dep] = {};
                    if (!ubigeoData[dep][prov]) ubigeoData[dep][prov] = [];

                    if (!ubigeoData[dep][prov].includes(dist)) {
                        ubigeoData[dep][prov].push(dist);
                    }
                }
            });

            // Cargar departamentos
            Object.keys(ubigeoData).sort().forEach(departamento => {
                let option = document.createElement('option');
                option.value = departamento;
                option.textContent = departamento;
                deptSelect.appendChild(option);
            });

        } catch (error) {
            console.error("Error al cargar datos:", error);
        }
    }

    // CUANDO CAMBIA DEPARTAMENTO
    deptSelect.addEventListener('change', function() {

        provSelect.innerHTML = '<option disabled selected>Seleccione una provincia...</option>';
        distSelect.innerHTML = '<option disabled selected>Seleccione un distrito...</option>';

        provSelect.disabled = false;
        distSelect.disabled = true;

        const depto = this.value;

        Object.keys(ubigeoData[depto]).sort().forEach(provincia => {
            let option = document.createElement('option');
            option.value = provincia;
            option.textContent = provincia;
            provSelect.appendChild(option);
        });

    });

    // CUANDO CAMBIA PROVINCIA
    provSelect.addEventListener('change', function() {

        distSelect.innerHTML = '<option disabled selected>Seleccione un distrito...</option>';
        distSelect.disabled = false;

        const depto = deptSelect.value;
        const provincia = this.value;

        ubigeoData[depto][provincia].sort().forEach(distrito => {
            let option = document.createElement('option');
            option.value = distrito;
            option.textContent = distrito;
            distSelect.appendChild(option);
        });

    });

    cargarUbigeo();

});

// Mostrar mensaje de éxito en el libro de reclamaciones
document.addEventListener('DOMContentLoaded', function () {

    const successElement = document.getElementById('flash-success-message');

    if (successElement) {
        const mensaje = successElement.getAttribute('data-message');

        Swal.fire({
            showConfirmButton: true,
            confirmButtonText: 'Continuar',
            buttonsStyling: false,

            // ⏱ TIEMPO AUTOMÁTICO
            timer: 3000, // 3 segundos
            timerProgressBar: true,

            background: '#ffffff',
            backdrop: `rgba(15, 23, 42, 0.5)`,

            html: `
                <div class="flex flex-col items-center py-6 px-4">

                    <div class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center shadow-inner mb-6">
                        <div class="w-16 h-16 rounded-full bg-emerald-200 flex items-center justify-center">
                            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">
                        ¡Excelente!
                    </h2>

                    <p class="text-slate-500 text-center text-sm px-4 leading-relaxed">
                        ${mensaje}
                    </p>

                </div>
            `,

            customClass: {
                popup: 'rounded-3xl shadow-2xl border border-slate-100 w-[26rem]',
                confirmButton: `
                    bg-emerald-500 hover:bg-emerald-600 text-white
                    font-bold px-6 py-3 rounded-xl w-full
                    shadow-lg shadow-emerald-500/30
                    transition-all duration-300
                    hover:-translate-y-1 active:scale-95
                    focus:ring-4 focus:ring-emerald-200
                `
            }
        });
    }

});

// Validación de formulario en el libro de reclamaciones
document.addEventListener('DOMContentLoaded', function () {

    const tipoDoc = document.getElementById('tipo_documento');
    const numeroDoc = document.getElementById('numero_documento');

    tipoDoc.addEventListener('change', function () {
        numeroDoc.value = ''; 
    });

    numeroDoc.addEventListener('input', function () {
        let valor = numeroDoc.value;
        const tipo = tipoDoc.value;

    
        if (tipo === 'DNI' || tipo === 'RUC') {
            valor = valor.replace(/\D/g, '');
        }

        if (tipo === 'DNI') {
            numeroDoc.value = valor.slice(0, 8); 
        } 
        else if (tipo === 'RUC') {
            numeroDoc.value = valor.slice(0, 11); 
        } 
        else if (tipo === 'CE') {
            numeroDoc.value = valor.slice(0, 12); 
        } 
        else if (tipo === 'Pasaporte') {
            numeroDoc.value = valor.slice(0, 12);
        }
    });

  
    const form = numeroDoc.closest('form');

    form.addEventListener('submit', function (e) {
        const tipo = tipoDoc.value;
        const valor = numeroDoc.value;

        if (tipo === 'DNI' && valor.length !== 8) {
            alert('El DNI debe tener 8 dígitos');
            e.preventDefault();
        }

        if (tipo === 'RUC' && valor.length !== 11) {
            alert('El RUC debe tener 11 dígitos');
            e.preventDefault();
        }

        if (!tipo) {
            alert('Seleccione un tipo de documento');
            e.preventDefault();
        }
    });

});

document.addEventListener('DOMContentLoaded', function () {

    const campos = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
       
    ];

    campos.forEach(id => {
        const input = document.getElementById(id);

        if (input) {
            input.addEventListener('input', function () {
                // Permitir solo letras, espacios y tildes
                this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            });
        }
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const telefono = document.getElementById('telefono');
    telefono.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        this.value = this.value.slice(0, 9);
    });

});