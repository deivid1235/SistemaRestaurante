import './clientes';
import './home';
import './main';

function setupMobileMenu() {
    const button = document.getElementById('mobile-menu-button');
    const menu   = document.getElementById('mobile-menu');

    if (!button || !menu) return; // CLAVE

    button.addEventListener('click', () => {
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

    if (deptSelect && provSelect && distSelect) {

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

                Object.keys(ubigeoData).sort().forEach(departamento => {
                    let option = document.createElement('option');
                    option.value = departamento;
                    option.textContent = departamento;
                    deptSelect.appendChild(option);
                });

            } catch (error) {
                console.error("Error al cargar ubigeo:", error);
            }
        }

        deptSelect.addEventListener('change', function() {

            provSelect.innerHTML = '<option disabled selected>Seleccione una provincia...</option>';
            distSelect.innerHTML = '<option disabled selected>Seleccione un distrito...</option>';

            provSelect.disabled = false;
            distSelect.disabled = true;

            const depto = this.value;

            if (!ubigeoData[depto]) return;

            Object.keys(ubigeoData[depto]).sort().forEach(provincia => {
                let option = document.createElement('option');
                option.value = provincia;
                option.textContent = provincia;
                provSelect.appendChild(option);
            });
        });

        provSelect.addEventListener('change', function() {

            distSelect.innerHTML = '<option disabled selected>Seleccione un distrito...</option>';
            distSelect.disabled = false;

            const depto = deptSelect.value;
            const provincia = this.value;

            if (!ubigeoData[depto] || !ubigeoData[depto][provincia]) return;

            ubigeoData[depto][provincia].forEach(distrito => {
                let option = document.createElement('option');
                option.value = distrito;
                option.textContent = distrito;
                distSelect.appendChild(option);
            });
        });

        cargarUbigeo();
    }
});

document.addEventListener('DOMContentLoaded', function () {

    const tipoDoc = document.getElementById('tipo_documento');
    const numeroDoc = document.getElementById('numero_documento');

    if (tipoDoc && numeroDoc) {

        tipoDoc.addEventListener('change', function () {
            numeroDoc.value = '';
        });

        numeroDoc.addEventListener('input', function () {

            let valor = numeroDoc.value;
            const tipo = tipoDoc.value;

            if (tipo === 'DNI' || tipo === 'RUC') {
                valor = valor.replace(/\D/g, '');
            }

            if (tipo === 'DNI') numeroDoc.value = valor.slice(0, 8);
            else if (tipo === 'RUC') numeroDoc.value = valor.slice(0, 11);
            else numeroDoc.value = valor.slice(0, 12);
        });

        const form = numeroDoc.closest('form');

        if (form) {
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
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {

    const campos = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido'
    ];

    campos.forEach(id => {
        const input = document.getElementById(id);

        if (input) {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            });
        }
    });

});

document.addEventListener('DOMContentLoaded', function () {

    const telefono = document.getElementById('telefono');

    if (telefono) {
        telefono.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 9);
        });
    }

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

    if (!modal || !form) return;

    if (btnAbrir) {
        btnAbrir.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    }

    if (btnCerrar) {
        btnCerrar.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }

    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    document.querySelectorAll('.btnEditar').forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const descripcion = this.dataset.descripcion;

            const inputId = document.getElementById('tipoPagoId');
            const inputDesc = document.getElementById('descripcion');

            if (!inputId || !inputDesc) return;

            inputId.value = id;
            inputDesc.value = descripcion;

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

    document.querySelectorAll('.btnEliminarTipoPago').forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const nombre = this.dataset.nombre;

            const m = document.getElementById('modalEliminar');
            const f = document.getElementById('formEliminar');
            const span = document.getElementById('delete_nombre');

            if (!m || !f || !span) {
                console.error("ERROR: Modal eliminar no encontrado");
                return;
            }

            f.action = `/admin/TipoPago/${id}`;
            span.innerText = nombre;

            m.classList.remove('hidden');
            m.classList.add('flex');
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

            form.action = "/admin/MetodoPago";
            methodField.innerHTML = '';

            form.reset();

        } else {

            title.innerText = 'Editar Método';

            form.action = `/admin/MetodoPago/${data.id}`;
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('inputDescripcion').value = data.descripcion ?? '';
            document.getElementById('inputTipo').value = data.tipo_pago_id ?? '';
            document.getElementById('inputEstado').value = data.estado ?? '';
        }
    };

    window.closeModal = function () {
        if (!modal) return;

        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    if (btnUp) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
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

    if (buscador) {
        buscador.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const tarjetas = document.querySelectorAll('.metodo-card');

            tarjetas.forEach(card => {
                const nombre = card.dataset.nombre;
                card.style.display = nombre.includes(filtro) ? '' : 'none';
            });
        });
    }

    const btnTodos = document.getElementById('btnTodos');
    const btnActivos = document.getElementById('btnActivos');
    const btnInactivos = document.getElementById('btnInactivos');

    const tarjetas = document.querySelectorAll('.metodo-card');

    function filtrar(estado) {
        tarjetas.forEach(card => {
            if (estado === 'todos') {
                card.style.display = '';
            } else {
                card.style.display = card.dataset.estado == estado ? '' : 'none';
            }
        });
    }

    btnTodos?.addEventListener('click', () => filtrar('todos'));
    btnActivos?.addEventListener('click', () => filtrar('1'));
    btnInactivos?.addEventListener('click', () => filtrar('0'));

    document.querySelectorAll('.btnEliminarMetodoPago').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;

            const modalEliminar = document.getElementById('modalEliminar');
            const formEliminar = document.getElementById('formEliminar');

            formEliminar.action = `/admin/MetodoPago/${id}`;
            document.getElementById('delete_nombre').innerText = nombre;

            modalEliminar.classList.remove('hidden');
            modalEliminar.classList.add('flex');
        });
    });

});

// Modal de tipo de documento
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modalDocumento');
    const form = document.getElementById('formDocumento');
    const modalTitle = document.getElementById('modalTitle');
    const buscador = document.getElementById('buscador');
    const btnTodos = document.getElementById('btnTodos');
    const btnActivos = document.getElementById('btnActivos');
    const btnInactivos = document.getElementById('btnInactivos');
    const cards = document.querySelectorAll('.documento-card');
    const storeUrl = "/admin/TipoDocumento";
    let filtroEstado = "todos";

    if (!modal || !form) return;

    const openModal = (edit = false, data = null) => {

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        const methodField = document.getElementById('methodField');
        const inputDesc = document.getElementById('inputDesc');
        const inputSerie = document.getElementById('inputSerie');
        const inputNum = document.getElementById('inputNum');
        const inputEstado = document.getElementById('inputEstado');

        if (edit && data) {

            if (modalTitle) modalTitle.innerText = 'Editar Documento';
            form.action = `/admin/TipoDocumento/${data.id}`;

            if (methodField) methodField.value = 'PUT';
            if (inputDesc) inputDesc.value = data.descripcion ?? '';
            if (inputSerie) inputSerie.value = data.serie ?? '';
            if (inputNum) inputNum.value = data.numero ?? '';
            if (inputEstado) inputEstado.value = (data.estado || '').toUpperCase();

        } else {

            if (modalTitle) modalTitle.innerText = 'Nuevo Documento';
            form.action = storeUrl;

            if (methodField) methodField.value = 'POST';
            form.reset();
        }
    };

    const closeModal = () => {
        modal.classList.add('hidden');
    };

    document.getElementById('btnNuevo')?.addEventListener('click', () => openModal(false));

    document.querySelectorAll('[onclick="closeModal()"]').forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    window.editarDocumento = (data) => {
        openModal(true, data);
    };

    document.querySelectorAll('.btnEliminarDocumento').forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const nombre = this.dataset.nombre;

            const m = document.getElementById('modalEliminar');
            const f = document.getElementById('formEliminar');
            const span = document.getElementById('delete_nombre');

            if (!m || !f || !span) return;

            f.action = `/admin/TipoDocumento/${id}`;
            span.innerText = nombre;

            m.classList.remove('hidden');
            m.classList.add('flex');
        });
    });

    const filtrar = () => {
        const texto = buscador?.value.toLowerCase() || "";

        cards.forEach(card => {
            const nombre = (card.dataset.nombre || "").toLowerCase();
            const estado = card.dataset.estado;

            const coincideTexto = nombre.includes(texto);
            const coincideEstado =
                filtroEstado === "todos" ||
                estado === filtroEstado;

            card.style.display = (coincideTexto && coincideEstado) ? '' : 'none';
        });
    };

    buscador?.addEventListener('keyup', filtrar);

    btnTodos?.addEventListener('click', () => {
        filtroEstado = "todos";
        activarBoton(btnTodos);
        filtrar();
    });

    btnActivos?.addEventListener('click', () => {
        filtroEstado = "activo";
        activarBoton(btnActivos);
        filtrar();
    });

    btnInactivos?.addEventListener('click', () => {
        filtroEstado = "inactivo";
        activarBoton(btnInactivos);
        filtrar();
    });

    const activarBoton = (btnActivo) => {

        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            if (!btn) return;

            btn.classList.remove('text-white', 'shadow-md');
            btn.classList.add('text-slate-400');
            btn.style.background = '';
        });

        if (!btnActivo) return;

        btnActivo.classList.add('text-white', 'shadow-md');
        btnActivo.classList.remove('text-slate-400');

        btnActivo.style.background =
            "linear-gradient(135deg, var(--primary) 0%, #0096D9 100%)";
    };

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

    document.querySelectorAll('.btnEliminarImpresora').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;

            const m = document.getElementById('modalEliminar');
            const f = document.getElementById('formEliminar');

            f.action = `/admin/Inpresora/${id}`;
            document.getElementById('delete_nombre').innerText = nombre;

            m.classList.remove('hidden');
            m.classList.add('flex');
        });
    });

    const buscador = document.getElementById('buscador');
    const btnTodos = document.getElementById('btnTodos');
    const btnActivos = document.getElementById('btnActivos');
    const btnInactivos = document.getElementById('btnInactivos');

    let filtroEstado = 'todos';

    function filtrar() {
        const texto = buscador.value.toLowerCase();

        document.querySelectorAll('.impresora').forEach(card => {
            const nombre = card.dataset.nombre;
            const estado = card.dataset.estado;

            const coincideTexto = nombre.includes(texto);
            const coincideEstado = (filtroEstado === 'todos') || (estado === filtroEstado);

            if (coincideTexto && coincideEstado) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function activarBoton(activo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            btn.classList.remove('text-white', 'shadow-md');
            btn.classList.add('text-slate-400');
            btn.style.background = 'transparent';
        });

        activo.classList.add('text-white', 'shadow-md');
        activo.classList.remove('text-slate-400');
        activo.style.background = 'linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%)';
    }

    btnTodos?.addEventListener('click', () => {
        filtroEstado = 'todos';
        activarBoton(btnTodos);
        filtrar();
    });

    btnActivos?.addEventListener('click', () => {
        filtroEstado = 'activo';
        activarBoton(btnActivos);
        filtrar();
    });

    btnInactivos?.addEventListener('click', () => {
        filtroEstado = 'inactivo';
        activarBoton(btnInactivos);
        filtrar();
    });

    buscador?.addEventListener('input', filtrar);

});
window.cerrarModal = function(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


// SALONES Y MESAS
let salonSeleccionado = null;

window.seleccionarSalon = function (id, nombre) {
    salonSeleccionado = id;
    document.getElementById('tituloMesas').innerText = nombre;

    document.querySelectorAll('tbody tr').forEach(tr =>
        tr.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500')
    );

    const fila = document.getElementById(`fila-salon-${id}`);
    if (fila) fila.classList.add('bg-blue-50', 'border-l-4', 'border-blue-500');

    document.querySelectorAll('.mesa').forEach(mesa => {
        mesa.classList.toggle('hidden', mesa.dataset.salon != id);
    });
};

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modalEliminar');
    const form = document.getElementById('formEliminar');
    const texto = document.getElementById('delete_nombre');

    if (!modal || !form || !texto) {
        console.error('Faltan elementos del modal eliminar');
        return;
    }
    document.querySelectorAll('.btnEliminarMesa, .btnEliminarSalon').forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const nombre = this.dataset.nombre;

            let tipo = this.classList.contains('btnEliminarMesa')
                ? 'mesa'
                : 'salon';

            let baseUrl = '';

            if (tipo === 'mesa') {
                baseUrl = '/admin/mesa/';
            } else if (tipo === 'salon') {
                baseUrl = '/admin/Salon/';
            }

            form.action = baseUrl + id;
            texto.innerText = nombre;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    window.cerrarModal = function (id) {
        const m = document.getElementById(id);
        if (!m) return;

        m.classList.add('hidden');
        m.classList.remove('flex');
    };

});

window.abrirCrearSalon = function () {
    const form = document.getElementById('formSalon');

    form.action = '/admin/Salon';
    document.getElementById('methodSalon').value = 'POST';
    document.getElementById('modalSalonTitulo').innerText = 'Nuevo Salón';

    form.reset();
    document.getElementById('modalSalon').classList.replace('hidden', 'flex');
};

window.abrirEditarSalon = function (id, nombre, estado) {
    const form = document.getElementById('formSalon');

    form.action = '/admin/Salon/' + id;

    document.getElementById('methodSalon').value = 'PUT';
    document.getElementById('modalSalonTitulo').innerText = 'Editar Salón: ' + nombre;
    document.getElementById('inputSalonNombre').value = nombre;
    document.getElementById('inputSalonEstado').value = estado;

    document.getElementById('modalSalon').classList.replace('hidden', 'flex');
};

window.abrirCrearMesa = function () {
    if (!salonSeleccionado) {
        Swal.fire({
            icon: 'info',
            title: 'Atención',
            text: 'Selecciona un salón primero'
        });
        return;
    }

    const form = document.getElementById('formMesa');

    form.action = '/admin/mesa';
    document.getElementById('methodMesa').value = 'POST';
    document.getElementById('modalMesaTitulo').innerText = 'Nueva Mesa';

    form.reset();
    document.getElementById('mesa_salon_id').value = salonSeleccionado;

    document.getElementById('modalMesa').classList.replace('hidden', 'flex');
};

window.abrirEditarMesa = function (id, nombre, estado, salonId) {
    const form = document.getElementById('formMesa');

    form.action = '/admin/mesa/' + id;

    document.getElementById('methodMesa').value = 'PUT';
    document.getElementById('modalMesaTitulo').innerText = 'Editar Mesa ' + nombre;

    document.getElementById('inputMesaNombre').value = nombre;
    document.getElementById('inputMesaEstado').value = estado;
    document.getElementById('mesa_salon_id').value = salonId;

    document.getElementById('modalMesa').classList.replace('hidden', 'flex');
};

window.cerrarModal = function (id) {
    document.getElementById(id).classList.replace('flex', 'hidden');
};

window.onload = function () {
    const primeraFila = document.querySelector('tbody tr');
    if (primeraFila) primeraFila.click();
};

window.UI = {
    modals: {
        usuarios: document.getElementById('modalUsuarios')
    },
    toggle: function (el, show) {
        if (!el) return;
        el.classList.toggle('hidden', !show);
        el.classList.toggle('flex', show); 
    }
};

//Caja
window.abrirCrear = function () {
    const modal = document.getElementById('modalCaja');

    modal.classList.remove('hidden');
    modal.classList.add('flex'); 

    document.getElementById('formCaja').action = "/admin/Caja";
    document.getElementById('methodCaja').value = "POST";

    document.getElementById('tituloModal').innerText = "Nueva Caja";
    document.getElementById('btnGuardar').innerText = "Guardar";
    document.getElementById('iconModal').className = "fa fa-plus text-white";

    document.getElementById('formCaja').reset();
};

window.abrirEditar = function (id, nombre, estado, apertura, cierre) {
    const modal = document.getElementById('modalCaja');

    modal.classList.remove('hidden');
    modal.classList.add('flex'); 

    document.getElementById('formCaja').action = `/admin/Caja/${id}`;
    document.getElementById('methodCaja').value = "PUT";

    document.getElementById('tituloModal').innerText = "Editar Caja";
    document.getElementById('btnGuardar').innerText = "Actualizar";
    document.getElementById('iconModal').className = "fa fa-edit text-white";

    document.getElementById('nombre').value = nombre;
    document.getElementById('estado').value = estado;

   
    document.getElementById('fecha_apertura').value = apertura 
        ? apertura.replace(' ', 'T') 
        : '';

    document.getElementById('fecha_cierre').value = cierre 
        ? cierre.replace(' ', 'T') 
        : '';
};

window.cerrarModalCaja = function () {
    const modal = document.getElementById('modalCaja');

    modal.classList.add('hidden');
    modal.classList.remove('flex'); 
};

window.cajaIdActual = null;
window.usuariosAsignados = [];

window.abrirModalUsuarios = function (id) {
    window.cajaIdActual = id;

    document.getElementById('formUsuarios').action =
        `/admin/Caja/${id}/asignar-usuarios`;

    window.UI.toggle(window.UI.modals.usuarios, true);
    cargarUsuarios(id);
};

window.cerrarModalUsuarios = function () {
    window.UI.toggle(window.UI.modals.usuarios, false);
};

function cargarUsuarios(id) {
    const tbody = document.getElementById('tablaUsuariosAsignados');

    tbody.innerHTML = `
        <tr>
            <td class="px-4 py-6 text-center text-gray-400 text-xs">
                <i class="fa fa-spinner fa-spin mr-2"></i> Cargando...
            </td>
        </tr>
    `;

    fetch(`/admin/Caja/${id}/usuarios`)
        .then(res => res.json())
        .then(data => {

            window.usuariosAsignados = (data.asignados || []).map(Number);

            const select = document.getElementById('selectUsuarioAñadir');
            select.innerHTML = '<option value="">Buscar usuario...</option>';

            (data.usuarios || []).forEach(u => {
                const idNum = Number(u.id);

                if (!window.usuariosAsignados.includes(idNum)) {
                    select.innerHTML += `
                        <option value="${idNum}">
                            ${u.nombre_completo}
                        </option>
                    `;
                }
            });

            renderTablaAsignados(data.usuarios || []);
        })
        .catch(() => {
            tbody.innerHTML = `
                <tr>
                    <td class="px-4 py-6 text-center text-red-400 text-xs">
                        Error al cargar usuarios
                    </td>
                </tr>
            `;
        });
}

function renderTablaAsignados(todos) {
    const tbody = document.getElementById('tablaUsuariosAsignados');

    const asignados = todos.filter(u =>
        window.usuariosAsignados.includes(Number(u.id))
    );

    if (asignados.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td class="px-4 py-6 text-center text-gray-400 text-xs">
                    Sin usuarios asignados.
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = asignados.map(u => `
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-3 text-sm font-medium text-gray-700">
                ${u.nombre_completo}
            </td>
            <td class="px-4 py-3 text-right">
                <button type="button"
                    onclick="quitarUsuario(${u.id})"
                    class="text-red-400 hover:text-red-600 p-1.5 rounded-lg transition-colors">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

window.añadirUsuario = function () {
    const select = document.getElementById('selectUsuarioAñadir');
    const uid = Number(select.value);

    if (!uid) return;

    if (!window.usuariosAsignados.includes(uid)) {
        window.usuariosAsignados.push(uid);
    }

    select.value = "";
    sincronizarYEnviar();
};

window.quitarUsuario = function (uid) {
    window.usuariosAsignados = window.usuariosAsignados.filter(id =>
        Number(id) !== Number(uid)
    );

    sincronizarYEnviar();
};

function sincronizarYEnviar() {
    const hiddenDiv = document.getElementById('inputsUsuariosHidden');

    hiddenDiv.innerHTML = window.usuariosAsignados.map(id =>
        `<input type="hidden" name="usuarios[]" value="${id}">`
    ).join('');

    document.getElementById('formUsuarios').submit();
}

window.onclick = function (e) {
    if (!window.UI || !window.UI.modals) return;

    Object.values(window.UI.modals).forEach(m => {
        if (e.target === m) {
            window.UI.toggle(m, false);
        }
    });
};

document.addEventListener('DOMContentLoaded', function () {
    const buscador = document.getElementById('buscador');
    if (!buscador) return;

    buscador.addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaCaja tr');

        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(filtro) ? '' : 'none';
        });
    });
});

//Categorias productos
document.addEventListener("DOMContentLoaded", function () {

    let categoriaIdEliminar = null;

    window.abrirEliminar = function (id, nombre) {
        const form = document.getElementById("formEliminarCategoria");
        const modal = document.getElementById("modalEliminar");
        const nombreSpan = document.getElementById("delete_nombre");

        if (!form || !modal || !nombreSpan) {
            console.error("Elementos del modal no encontrados");
            return;
        }

        categoriaIdEliminar = id;

        nombreSpan.innerText = nombre;
        form.action = `/admin/Categoria/delete/${id}`;

        modal.classList.remove("hidden");
        modal.classList.add("flex");
    };

    window.cerrarModal = function (id) {
        const modal = document.getElementById(id);
        if (!modal) return;

        modal.classList.add("hidden");
        modal.classList.remove("flex");
    };

    document.addEventListener("click", function (e) {
        const modal = document.getElementById("modalEliminar");
        if (modal && e.target === modal) {
            cerrarModal("modalEliminar");
        }
    });

   
    let filtroActual = "todos";

    const btnTodos = document.getElementById("btnTodos");
    const btnActivos = document.getElementById("btnActivos");
    const btnInactivos = document.getElementById("btnInactivos");
    const buscador = document.getElementById("buscador");
    const categorias = document.querySelectorAll(".categoria");

    function filtrarCategorias() {
        const texto = (buscador?.value || "").toLowerCase();

        categorias.forEach(cat => {
            const estado = cat.dataset.estado || "";
            const nombre = cat.dataset.nombre || "";

            const coincideBusqueda = nombre.includes(texto);

            let coincideFiltro = false;

            if (filtroActual === "todos") {
                coincideFiltro = true;
            } else if (filtroActual === "activos") {
                coincideFiltro = (estado === "a");
            } else if (filtroActual === "inactivos") {
                coincideFiltro = (estado !== "a");
            }

            cat.style.display = (coincideBusqueda && coincideFiltro) ? "block" : "none";
        });
    }

    function activarBoton(botonActivo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            if (!btn) return;

            btn.classList.remove("text-white");
            btn.classList.add("text-slate-400");
            btn.style.background = "transparent";
        });

        if (botonActivo) {
            botonActivo.classList.remove("text-slate-400");
            botonActivo.classList.add("text-white");
            botonActivo.style.background = "linear-gradient(135deg, var(--primary) 0%, #0096D9 100%)";
        }
    }

    btnTodos?.addEventListener("click", () => {
        filtroActual = "todos";
        activarBoton(btnTodos);
        filtrarCategorias();
    });

    btnActivos?.addEventListener("click", () => {
        filtroActual = "activos";
        activarBoton(btnActivos);
        filtrarCategorias();
    });

    btnInactivos?.addEventListener("click", () => {
        filtroActual = "inactivos";
        activarBoton(btnInactivos);
        filtrarCategorias();
    });

    buscador?.addEventListener("input", filtrarCategorias);

});
document.addEventListener("DOMContentLoaded", function () {
    window.previewImage = function (event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        if (!file || !previewContainer || !imagePreview) {
            console.error("Error en preview: elementos o archivo no encontrados");
            return;
        }
        const reader = new FileReader();

        reader.onload = function () {
            imagePreview.src = reader.result;
            previewContainer.classList.remove('hidden');
            previewContainer.classList.add('flex');
        };
        reader.readAsDataURL(file);
    };

});

// ÁREAS DE PRODUCCIÓN

window.UI_Area = {
    modals: {
        crear:    document.getElementById('modalCrearArea'),
        editar:   document.getElementById('modalEditarArea'),
        eliminar: document.getElementById('modalEliminarArea'),
    },

    toggle(modal, show) {
        if (!modal) return;
        modal.classList.toggle('hidden', !show);
        modal.classList.toggle('flex', show);
    }
};

window.abrirModalCrearArea = function () {
    window.UI_Area.toggle(window.UI_Area.modals.crear, true);
};

window.cerrarModalCrearArea = function () {
    window.UI_Area.toggle(window.UI_Area.modals.crear, false);
};

window.abrirModalEditarArea = function (id, nombre, inpresoraId, estado) {
    const form = document.getElementById('formEditarArea');

    form.action = `/admin/AreaProduccion/${id}`;

    document.getElementById('editArea_nombre').value    = nombre;
    document.getElementById('editArea_estado').value    = estado;

    const selectImp = document.getElementById('editArea_inpresora');
    selectImp.value = inpresoraId ?? '';

    window.UI_Area.toggle(window.UI_Area.modals.editar, true);
};

window.cerrarModalEditarArea = function () {
    window.UI_Area.toggle(window.UI_Area.modals.editar, false);
};

window.abrirModalEliminarArea = function (id, nombre) {
    const form = document.getElementById('formEliminarArea');

    form.action = `/admin/AreaProduccion/${id}`;
    document.getElementById('deleteArea_nombre').innerText = nombre;

    window.UI_Area.toggle(window.UI_Area.modals.eliminar, true);
};

window.cerrarModalEliminarArea = function () {
    window.UI_Area.toggle(window.UI_Area.modals.eliminar, false);
};


document.addEventListener('click', function (e) {
    Object.values(window.UI_Area.modals).forEach(m => {
        if (m && e.target === m) {
            window.UI_Area.toggle(m, false);
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {

    const buscador = document.getElementById("buscador");
    const btnTodos = document.getElementById("btnTodos");
    const btnActivos = document.getElementById("btnActivos");
    const btnInactivos = document.getElementById("btnInactivos");
    const cards = document.querySelectorAll(".area-card");
    if (!buscador || !btnTodos || !btnActivos || !btnInactivos) return;

    let filtroEstado = "todos";

    function filtrar() {
        const texto = buscador.value.toLowerCase();

        cards.forEach(card => {
            const nombre = (card.dataset.nombre || "").toLowerCase();
            const estado = card.dataset.estado;

            let coincideBusqueda = nombre.includes(texto);
            let coincideEstado =
                filtroEstado === "todos" ||
                estado === filtroEstado;

            if (coincideBusqueda && coincideEstado) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    buscador.addEventListener("input", filtrar);

    btnTodos.addEventListener("click", () => {
        filtroEstado = "todos";
        activarBoton(btnTodos);
        filtrar();
    });

    btnActivos.addEventListener("click", () => {
        filtroEstado = "activo";
        activarBoton(btnActivos);
        filtrar();
    });

    btnInactivos.addEventListener("click", () => {
        filtroEstado = "inactivo";
        activarBoton(btnInactivos);
        filtrar();
    });

    function activarBoton(botonActivo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            btn.classList.remove("text-white", "shadow-md");
            btn.classList.add("text-slate-400");
            btn.style.background = "transparent";
        });

        botonActivo.classList.remove("text-slate-400");
        botonActivo.classList.add("text-white", "shadow-md");
        botonActivo.style.background =
            "linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%)";
    }

});

// CARTA DIGITAL
window.copiarUrl = function () {
    const input = document.getElementById('inputUrl');
    if (!input || !input.value) return;

    navigator.clipboard.writeText(input.value).then(() => {
        const btn = document.querySelector('[onclick="copiarUrl()"]');
        if (!btn) return;

        const original = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-check text-xs text-emerald-500"></i> <span class="text-emerald-500">Copiado</span>';

        setTimeout(() => {
            btn.innerHTML = original;
        }, 2000);
    }).catch(() => {
       
        input.select();
        document.execCommand('copy');
    });
};

document.addEventListener('DOMContentLoaded', function () {
    const inputUrl  = document.getElementById('inputUrl');
    const btnAbrir  = document.getElementById('btnAbrir');

    if (!inputUrl || !btnAbrir) return;

    inputUrl.addEventListener('input', function () {
        const val = this.value.trim();

        if (val) {
            btnAbrir.href = val;
            btnAbrir.classList.remove('pointer-events-none', 'opacity-40');
        } else {
            btnAbrir.href = '#';
            btnAbrir.classList.add('pointer-events-none', 'opacity-40');
        }
    });
});
// CONFIGURACIÓN INICIAL

window.cambiarTab = function (tabId) {


    document.querySelectorAll('.config-tab-content').forEach(el => {
        el.classList.add('hidden');
    });

   
    document.querySelectorAll('.config-tab-btn').forEach(btn => {
        btn.classList.remove(
            'bg-white',
            'shadow-md',
            'shadow-slate-200/50',
            'text-sky-600',
            'border',
            'border-slate-50'
        );

        btn.classList.add('text-slate-500');
    });

    const content = document.getElementById('tab-' + tabId);
    if (content) content.classList.remove('hidden');

    
    const btn = document.getElementById('tab-btn-' + tabId);
    if (btn) {
        btn.classList.add(
            'bg-white',
            'shadow-md',
            'shadow-slate-200/50',
            'text-sky-600',
            'border',
            'border-slate-50'
        );

        btn.classList.remove('text-slate-500');
    }
};

document.addEventListener('DOMContentLoaded', function () {
    cambiarTab('zona-horaria');
});

const _optimizacionRoutes = {
    'optimizar-pedidos':      '/admin/Optimizacion/pedidos',
    'restaurar-ventas':       '/admin/Optimizacion/ventas',
    'restaurar-productos':    '/admin/Optimizacion/productos',
    'restaurar-insumos':      '/admin/Optimizacion/insumos',
    'restaurar-clientes':     '/admin/Optimizacion/clientes',
    'restaurar-proveedores':  '/admin/Optimizacion/proveedores',
    'restaurar-salones':      '/admin/Optimizacion/salones',
    'restaurar-notas-ventas': '/admin/Optimizacion/notas-ventas',
};

window.abrirModalOptimizacion = function (accion, mensaje) {
    const modal   = document.getElementById('modalOptimizacion');
    const form    = document.getElementById('formOptimizacion');
    const msgEl   = document.getElementById('modalOptimizacion_mensaje');

    if (!modal || !form || !msgEl) return;

    form.action = _optimizacionRoutes[accion] ?? '#';
    msgEl.innerText = mensaje;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
};

window.cerrarModalOptimizacion = function () {
    const modal = document.getElementById('modalOptimizacion');
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

document.addEventListener('click', function (e) {
    const modal = document.getElementById('modalOptimizacion');
    if (modal && e.target === modal) {
        cerrarModalOptimizacion();
    }
});

//Empresa
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("logo-input");
    const preview = document.getElementById("logo-preview");
    const placeholder = document.getElementById("logo-placeholder");

    if (input) {
        input.addEventListener("change", function () {

            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
                if (placeholder) {
                    placeholder.style.display = "none";
                }
            };

            reader.readAsDataURL(file);
        });
    }

    // activar tab inicial
    const tabLegal = document.getElementById("tab-btn-legal");
    if (tabLegal) {
        tabLegal.click();
    }
});

// Productos
document.addEventListener('DOMContentLoaded', function () {
    const inputImagen = document.getElementById('imagen');
    if (inputImagen) {
        inputImagen.addEventListener('change', function (e) {

            const file = e.target.files[0];
            const label = e.target.nextElementSibling;

            if (!file || !label) return;

            const reader = new FileReader();

            reader.onload = function (event) {
                label.innerHTML = `
                    <img src="${event.target.result}" 
                        style="width:100%; height:100%; object-fit:cover; border-radius:16px;">
                `;
            };
            reader.readAsDataURL(file);
        });
    }

});

window.abrirEliminarProducto = function (id, nombre) {

    const modal = document.getElementById("modalEliminar");
    const form = document.getElementById("formEliminarProducto");
    const nombreSpan = document.getElementById("delete_nombre");

    if (!modal || !form || !nombreSpan) {
        console.error("Modal eliminar no encontrado");
        return;
    }

    nombreSpan.textContent = nombre;
    form.action = `/admin/producto/${id}`;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
};

window.cerrarEliminarProducto = function () {
    const modal = document.getElementById("modalEliminar");

    if (!modal) return;

    modal.classList.add("hidden");
    modal.classList.remove("flex");
};
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById("btnGenerarCodigo");
    const input = document.getElementById("codigo_barra");

    if (btn && input) {
        btn.addEventListener("click", function () {
            let codigo = "";
            for (let i = 0; i < 13; i++) {
                codigo += Math.floor(Math.random() * 10);
            }
            input.value = codigo;
        });
    }

    // ======================
    // FILTROS
    // ======================
    const btnTodos = document.getElementById('btnTodos');
    const btnActivos = document.getElementById('btnActivos');
    const btnInactivos = document.getElementById('btnInactivos');
    const btnDelivery = document.getElementById('btnDelivery');
    const buscador = document.getElementById('buscador');
    const productos = document.querySelectorAll('.producto');

    let filtroActual = 'todos';

    function filtrar() {
        const texto = buscador ? buscador.value.toLowerCase() : '';

        productos.forEach(p => {
            const nombre = (p.dataset.nombre || '').toLowerCase();
            const estado = p.dataset.estado;
            const delivery = p.dataset.delivery;

            let mostrar = true;

            if (texto && !nombre.includes(texto)) mostrar = false;
            if (filtroActual === 'activos' && estado !== 'a') mostrar = false;
            if (filtroActual === 'inactivos' && estado !== 'i') mostrar = false;
            if (filtroActual === 'delivery' && delivery !== '1') mostrar = false;

            p.style.display = mostrar ? '' : 'none';
        });
    }

    if (btnTodos) btnTodos.onclick = () => { filtroActual = 'todos'; filtrar(); };
    if (btnActivos) btnActivos.onclick = () => { filtroActual = 'activos'; filtrar(); };
    if (btnInactivos) btnInactivos.onclick = () => { filtroActual = 'inactivos'; filtrar(); };
    if (btnDelivery) btnDelivery.onclick = () => { filtroActual = 'delivery'; filtrar(); };
    if (buscador) buscador.addEventListener('input', filtrar);

});
// Combos
document.addEventListener("DOMContentLoaded", () => {

    const modalCombo = document.getElementById("modalCombo");
    const comboForm = document.getElementById("comboForm");
    const buscador = document.getElementById("buscador");

    const btnTodos = document.getElementById("btnTodos");
    const btnActivos = document.getElementById("btnActivos");
    const btnInactivos = document.getElementById("btnInactivos");
    const btnNuevo = document.getElementById("btnNuevoCombo");

    let filtroEstado = "todos";
    // 1. MODAL (FIX SEGURO)
    const openModal = () => {
        if (!modalCombo) return console.error(" modalCombo no existe");

        modalCombo.classList.remove('hidden');
        modalCombo.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        if (!modalCombo) return;

        modalCombo.classList.add('hidden');
        modalCombo.classList.remove('flex');
        document.body.style.overflow = 'auto';
    };

    window.closeComboModal = closeModal;

    // 2. FILTRADO
    function filtrarCombos() {
        const texto = buscador?.value.toLowerCase() || "";
        const cards = document.querySelectorAll(".combo-card");

        cards.forEach(card => {
            const nombre = (card.dataset.nombre || "").toLowerCase();
            const estado = card.dataset.estado || "";

            const coincideTexto = nombre.includes(texto);
            const coincideEstado = filtroEstado === "todos" || estado === filtroEstado;

            card.style.display = (coincideTexto && coincideEstado) ? "flex" : "none";
        });
    }

    buscador?.addEventListener("keyup", filtrarCombos);

    btnTodos?.addEventListener("click", () => {
        filtroEstado = "todos";
        filtrarCombos();
    });

    btnActivos?.addEventListener("click", () => {
        filtroEstado = "activo";
        filtrarCombos();
    });

    btnInactivos?.addEventListener("click", () => {
        filtroEstado = "inactivo";
        filtrarCombos();
    });

    // 3. CREAR (FIX IMPORTANTE)
    btnNuevo?.addEventListener("click", () => {
        if (!comboForm) return console.error(" comboForm no existe");

        comboForm.reset();
        document.getElementById('modalTitle').innerText = "Nuevo Combo";
        document.getElementById('formMethod').value = "POST";

        const storeRoute = comboForm.dataset.store;

        if (!storeRoute) {
            console.error(" data-store no definido en el form");
            return;
        }

        comboForm.action = storeRoute;

        openModal();
    });

    // 4. EDITAR (FIX JSON + EVENTO)
    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".btnEditarCombo");

        if (!btn) return;

        try {
            const combo = JSON.parse(btn.dataset.combo);

            document.getElementById('modalTitle').innerText = "Editar Combo";
            document.getElementById('formMethod').value = "PUT";

            comboForm.action = `/admin/Combos/${combo.id}`;

            document.getElementById('nombre').value = combo.nombre || "";
            document.getElementById('descripcion').value = combo.descripcion || "";
            document.getElementById('nota').value = combo.nota || "";
            document.getElementById('id_area').value = combo.id_area || "";
            document.getElementById('estado').value = combo.estado || "activo";
            document.getElementById('delivery').value = combo.delivery ? "1" : "0";

            openModal();

        } catch (error) {
            console.error(" Error parseando combo:", error);
        }
    });

    // 5. ELIMINAR
    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".btnEliminarCombos");

        if (!btn) return;

        const comboId = btn.dataset.id;
        const comboNombre = btn.dataset.nombre;
        const modalEliminar = document.getElementById('modalEliminar');

        document.getElementById('delete_nombre').innerText = comboNombre;
        document.getElementById('formEliminar').action = `/admin/Combos/${comboId}`;

        modalEliminar.classList.remove('hidden');
        modalEliminar.classList.add('flex');
    });

});


//  USUARIOS 
document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador");
    const btnTodos = document.getElementById("btnTodos");
    const btnActivos = document.getElementById("btnActivos");
    const btnInactivos = document.getElementById("btnInactivos");
    const cards = document.querySelectorAll(".area-card");
    const modal = document.getElementById("modalEliminarUsuario");
    const form = document.getElementById("formEliminarUsuario");
    const nombreEl = document.getElementById("delete_nombre");
    const botonesEliminar = document.querySelectorAll(".btnEliminarUsuario");
    window.formIdPendiente = null;
    if (buscador) {
        buscador.addEventListener("input", function () {
            const texto = this.value.toLowerCase();

            cards.forEach(card => {
                const contenido = card.innerText.toLowerCase();
                card.style.display = contenido.includes(texto) ? "flex" : "none";
            });
        });
    }

    if (btnTodos) {
        btnTodos.addEventListener("click", () => {
            cards.forEach(card => card.style.display = "flex");
        });
    }

    if (btnActivos) {
        btnActivos.addEventListener("click", () => {
            cards.forEach(card => {
                const estado = card.getAttribute("data-estado");
                card.style.display = (estado === "1") ? "flex" : "none";
            });
        });
    }

    if (btnInactivos) {
        btnInactivos.addEventListener("click", () => {
            cards.forEach(card => {
                const estado = card.getAttribute("data-estado");
                card.style.display = (estado === "0") ? "flex" : "none";
            });
        });
    }

    botonesEliminar.forEach(btn => {
        btn.addEventListener("click", function () {

            const id = this.getAttribute("data-id");
            const nombre = this.getAttribute("data-nombre");

            window.formIdPendiente = id;

            if (nombreEl) nombreEl.textContent = nombre;

            if (modal) {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
        });
    });

    if (modal) {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                cerrarEliminarUsuario();
            }
        });
    }


    if (form) {
        form.addEventListener("submit", function () {
            if (window.formIdPendiente) {
                this.action = `/admin/Usuarios/${window.formIdPendiente}`;
            } else {
                alert("Error: No se seleccionó usuario");
            }
        });
    }

});

window.cerrarEliminarUsuario = function () {
    const modal = document.getElementById("modalEliminarUsuario");

    if (modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    window.formIdPendiente = null;
};

window.previewImagen = function (input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const preview = document.getElementById('previewFoto');
            if (preview) preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
};

window.togglePassword = function () {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');

    if (!input || !icon) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
};

//admin Libro de reclamaciones
document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador");
    const btnTodos = document.getElementById("btnTodos");
    const btnActivos = document.getElementById("btnActivos");
    const btnInactivos = document.getElementById("btnInactivos");

    const cards = document.querySelectorAll(".reclamo-card");

    //  BUSCADOR EN TIEMPO REAL
    if (buscador) {
        buscador.addEventListener("input", function () {

            const texto = this.value.toLowerCase();

            cards.forEach(card => {
                const contenido = card.innerText.toLowerCase();

                card.style.display = contenido.includes(texto) ? "block" : "none";
            });
        });
    }

    //  MOSTRAR TODOS
    if (btnTodos) {
        btnTodos.addEventListener("click", () => {

            cards.forEach(card => {
                card.style.display = "block";
            });
        });
    }

    //  ACTIVOS
    if (btnActivos) {
        btnActivos.addEventListener("click", () => {

            cards.forEach(card => {

                const estado = card.getAttribute("data-estado");

                if (estado == "1" || estado == "activo") {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

    //  INACTIVOS
    if (btnInactivos) {
        btnInactivos.addEventListener("click", () => {

            cards.forEach(card => {

                const estado = card.getAttribute("data-estado");

                if (estado == "0" || estado == "inactivo") {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

});

