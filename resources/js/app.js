function setupMobileMenu() {
    const button = document.getElementById('mobile-menu-button');
    const menu   = document.getElementById('mobile-menu');

    button?.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
}

document.addEventListener('DOMContentLoaded', setupMobileMenu);

// login del sistema 
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu-Celular');

    if (button && menu) {
        button.addEventListener('click', () => {
            menu.classList.toggle('open');
        });
    }

    
    const openBtn = document.getElementById('open-login-modal');
    const openBtnMobile = document.getElementById('open-login-modal-Celular');

    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-login-modal');

    if (openBtn && modal) {
        openBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.remove('hidden');
        });
    }

    if (openBtnMobile && modal) {
        openBtnMobile.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.remove('hidden');
        });
    }

    if (closeBtn && modal) {
        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    }

    window.addEventListener('click', (e) => {
        if (modal && e.target === modal) {
            modal.classList.add('hidden');
        }
    });

});

let images = [];
let idx = 0;

// Inicializacion
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

// Libro de reclamaciones 
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

//Modo color
function applyColor(color) {
    document.documentElement.style.setProperty('--primary', color);

    const input = document.getElementById('accentColor');
    if (input) input.value = color;

    const hex = document.getElementById('hexValue');
    if (hex) hex.value = color;
}

function guardarColorActual(url, csrf) {
    const color = document.getElementById('accentColor').value;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;

    const token = document.createElement('input');
    token.type = 'hidden';
    token.name = '_token';
    token.value = csrf;

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'accent_color';
    input.value = color;

    form.appendChild(token);
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
}

window.applyColor = applyColor;
window.guardarColorActual = guardarColorActual;


// Tabs configuracion
export function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    const selectedTab = document.getElementById('tab-' + tabName);
    if (selectedTab) {
        selectedTab.classList.remove('hidden');
    }

    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('bg-[var(--primary)]', 'text-white');
        btn.classList.add('hover:bg-gray-100', 'text-gray-700');
    });

    const activeButton = document.querySelector(`.tab-button[data-tab="${tabName}"]`);
    if (activeButton) {
        activeButton.classList.remove('hover:bg-gray-100', 'text-gray-700');
        activeButton.classList.add('bg-[var(--primary)]', 'text-white');
    }
}

export function previewCompanyLogo(event) {
    const preview = document.getElementById('companyLogoPreview');

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }
}

export function previewUserPhoto(event) {
    const preview = document.getElementById('userPhotoPreview');

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }
}
window.showTab = showTab;

window.previewCompanyLogo = previewCompanyLogo;
window.previewUserPhoto = previewUserPhoto;

document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("fileInput");
    const preview = document.getElementById("preview");
    const container = document.getElementById("previewContainer");
    const removeBtn = document.getElementById("removePreview");

    if (!input || !preview || !container) return;

    input.addEventListener("change", function () {

        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            container.classList.remove("hidden");
        };

        reader.readAsDataURL(file);
    });

    removeBtn.addEventListener("click", function () {
        input.value = "";
        preview.src = "";
        container.classList.add("hidden");
    });

});


//Modal Tipo pago
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modalPago');
    const btnAbrir = document.getElementById('btnAbrirModal');
    const btnCerrar = document.getElementById('btnCerrarModal');
    const form = document.getElementById('formTipoPago');

    // ABRIR MODAL
    btnAbrir.addEventListener('click', function () {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    // CERRAR MODAL
    btnCerrar.addEventListener('click', function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // CERRAR AL HACER CLICK FUERA
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    // EDITAR
    document.querySelectorAll('.btnEditar').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const descripcion = this.dataset.descripcion;

            document.getElementById('tipoPagoId').value = id;
            document.getElementById('descripcion').value = descripcion;

            form.action = '/admin/TipoPago/' + id;

            if (!document.getElementById('methodField')) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                input.value = 'PUT';
                input.id = 'methodField';
                form.appendChild(input);
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

});

// Cambiar pestañas
window.switchTab = function(event, tabId) {
    event.preventDefault();

    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));

    const tab = document.getElementById('tab-' + tabId);
    if (tab) tab.classList.remove('hidden');

    document.querySelectorAll('.nav-btn').forEach(b => {
        b.classList.remove('active-tab');
        b.classList.add('text-slate-500');
    });

    event.currentTarget.classList.add('active-tab');
    event.currentTarget.classList.remove('text-slate-500');
};


// Cambiar modo (Producción / Beta)
window.toggleModo = function(checkbox) {
    const textEl = document.getElementById('modo-label');

    if (!textEl) return;

    if (checkbox.checked) {
        textEl.innerText = "Modo Producción";
    } else {
        textEl.innerText = "Modo Beta (Pruebas)";
    }
};


//Modal de metodo de pago
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('paymentModal');
    const modalIcon = document.getElementById('modalIcon');
    const btnUp = document.getElementById('btnBackToTop');

    window.openModal = function (mode, data = null) {

        if (!modal) return;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('paymentForm');
        const title = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');

        if (mode === 'create') {

            title.innerText = 'Nuevo Método';

            modalIcon.innerHTML = '<i class="fa fa-plus"></i>';
            modalIcon.className = "w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center text-xl";

            form.action = "/admin/MetodoPago";

            methodField.innerHTML = '';
            form.reset();

            document.getElementById('inputTipo').value = "";
            document.getElementById('inputEstado').value = "";

        } else {

            title.innerText = 'Editar Método';

            modalIcon.innerHTML = '<i class="fa fa-edit"></i>';
            modalIcon.className = "w-12 h-12 bg-blue-50 text-[#0096D9] rounded-2xl flex items-center justify-center text-xl";

            form.action = `/admin/MetodoPago/${data.id}`;

            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('inputDescripcion').value = data.descripcion;
            document.getElementById('inputTipo').value = data.tipo_pago_id;
            document.getElementById('inputEstado').value = data.estado;
        }
    };

    window.closeModal = function () {
        if (!modal) return;

        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    
    if (btnUp) {
        window.addEventListener('scroll', function () {

            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                btnUp.classList.remove('opacity-0', 'invisible');
                btnUp.classList.add('opacity-100', 'visible');
            } else {
                btnUp.classList.add('opacity-0', 'invisible');
                btnUp.classList.remove('opacity-100', 'visible');
            }

        });
    }
    window.scrollToTop = function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const buscador = document.getElementById('buscador');

    buscador.addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaMetodos tr');

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();

            if (texto.includes(filtro)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });


});

// Modal de tipo de documento
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modalDocumento');
    const overlay = document.getElementById('modalOverlay');
    const content = document.getElementById('modalContent');
    const form = document.getElementById('formDocumento');
    const modalTitle = document.getElementById('modalTitle');
    const buscador = document.getElementById('buscador');

    const storeUrl = "/admin/TipoDocumento";

    if (!modal || !overlay || !content || !form) {
        console.error(" ERROR: No se encontraron elementos del modal");
        return;
    }

    const openModal = (edit = false, data = null) => {

        modal.classList.remove('hidden');

        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');

            content.classList.remove('opacity-0', 'scale-90');
            content.classList.add('opacity-100', 'scale-100');
        }, 10);

        if (edit && data) {
            modalTitle.innerText = 'Editar Documento';
            form.action = `/admin/TipoDocumento/${data.id}`;

            document.getElementById('methodField').value = 'PUT';
            document.getElementById('inputDesc').value = data.descripcion ?? '';
            document.getElementById('inputSerie').value = data.serie ?? '';
            document.getElementById('inputNum').value = data.numero ?? '';
            document.getElementById('inputEstado').value = data.estado.toUpperCase();

        } else {
            modalTitle.innerText = 'Nuevo Documento';
            form.action = storeUrl;

            document.getElementById('methodField').value = 'POST';
            form.reset();
        }
    };

    const closeModal = () => {
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');

        content.classList.remove('opacity-100', 'scale-100');
        content.classList.add('opacity-0', 'scale-90');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    const btnNuevo = document.getElementById('btnNuevo');
    const btnCerrar = document.getElementById('btnCerrar');
    const btnCancelar = document.getElementById('btnCancelar');

    if (btnNuevo) {
        btnNuevo.addEventListener('click', () => openModal(false));
    } else {
        console.error(" No existe #btnNuevo");
    }

    btnCerrar?.addEventListener('click', closeModal);
    btnCancelar?.addEventListener('click', closeModal);
    overlay?.addEventListener('click', closeModal);

    window.editarDocumento = (data) => {
        openModal(true, data);
    };

    window.eliminarDocumento = function(id) {
        if (!confirm('¿Seguro que deseas eliminar este documento?')) return;

        const formDelete = document.createElement('form');
        formDelete.method = 'POST';
        formDelete.action = `/admin/TipoDocumento/${id}`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;

        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';

        formDelete.appendChild(csrf);
        formDelete.appendChild(method);

        document.body.appendChild(formDelete);
        formDelete.submit();
    };

    if (buscador) {
        buscador.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tablaTipos tr');

            filas.forEach(fila => {
                const texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    }

});

//Modal de impresora
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modal');
    const form = document.getElementById('form');
    const method = document.getElementById('method');

    const storeUrl = document.getElementById('btnNueva')?.dataset.url;

    document.getElementById('btnNueva')?.addEventListener('click', () => {

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        form.action = storeUrl; 
        method.innerHTML = "";

        form.reset();

        document.getElementById('modalTitle').innerText = "Nueva Impresora";
    });

    document.getElementById('btnCerrar')?.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    document.querySelectorAll('.btnEditar').forEach(btn => {
        btn.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            form.action = "/admin/Inpresora/" + this.dataset.id;
            method.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('nombre').value = this.dataset.nombre;
            document.getElementById('estado').value = this.dataset.estado;

            document.getElementById('modalTitle').innerText = "Editar Impresora";
        });
    });

    const buscador = document.getElementById('buscador');

    if (buscador) {
        buscador.addEventListener('keyup', function () {

            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tablaImpresoras tr');

            filas.forEach(fila => {
                const texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    }

});