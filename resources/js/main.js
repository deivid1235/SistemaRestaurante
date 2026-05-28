//Insumos 
document.addEventListener('DOMContentLoaded', function () {
    const buscador = document.getElementById('buscador');
    const btnTodos = document.getElementById('btnTodos');
    const btnActivos = document.getElementById('btnActivos');
    const btnInactivos = document.getElementById('btnInactivos');
    const insumos = document.querySelectorAll('.insumo');

    let filtroEstado = 'todos';

    function filtrar() {
        if (!buscador) return;

        const texto = buscador.value.toLowerCase();

        insumos.forEach(ins => {
            const nombre = (ins.dataset.nombre || '').toLowerCase();
            const estado = ins.dataset.estado || '';

            const coincideTexto = nombre.includes(texto);
            const coincideEstado = (filtroEstado === 'todos') || (estado === filtroEstado);

            ins.style.display = (coincideTexto && coincideEstado) ? 'flex' : 'none';
        });
    }

    if (buscador) {
        buscador.addEventListener('input', filtrar);
    }

    function activarBoton(botonActivo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            if (!btn) return;

            btn.classList.remove('text-white', 'shadow-md');
            btn.classList.add('text-slate-400');
            btn.style.background = 'transparent';
        });

        if (botonActivo) {
            botonActivo.classList.remove('text-slate-400');
            botonActivo.classList.add('text-white', 'shadow-md');
            botonActivo.style.background =
                "linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%)";
        }
    }

    if (btnTodos) {
        btnTodos.addEventListener('click', () => {
            filtroEstado = 'todos';
            activarBoton(btnTodos);
            filtrar();
        });
    }

    if (btnActivos) {
        btnActivos.addEventListener('click', () => {
            filtroEstado = 'a';
            activarBoton(btnActivos);
            filtrar();
        });
    }

    if (btnInactivos) {
        btnInactivos.addEventListener('click', () => {
            filtroEstado = 'i';
            activarBoton(btnInactivos);
            filtrar();
        });
    }
    const modal = document.getElementById('modalEliminarInsumo');
    const form = document.getElementById('formEliminarInsumo');
    const nombreSpan = document.getElementById('delete_nombre');

    if (modal && form && nombreSpan) {
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btnEliminarInsumo');

            if (btn) {
                const id = btn.dataset.id;
                const nombre = btn.dataset.nombre;

                nombreSpan.textContent = nombre;
                form.action = `/admin/Insumo/${id}`;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

    }

});

//Proveedor
document.addEventListener("DOMContentLoaded", () => {
    const buscador = document.getElementById("buscador");
    const cards = document.querySelectorAll(".area-card");
    const btnTodos = document.getElementById("btnTodosClientes");
    const btnActivos = document.getElementById("btnActivosClientes");
    const btnInactivos = document.getElementById("btnInactivosClientes");

    let filtroEstado = "todos";

    function filtrar() {
        if (!buscador) return;

        const texto = buscador.value.toLowerCase();

        cards.forEach(card => {
            const nombre = (card.querySelector("h3")?.textContent || "").toLowerCase();
            const estado = card.dataset.estado || "";

            const coincideTexto = nombre.includes(texto);
            const coincideEstado =
                filtroEstado === "todos" || estado === filtroEstado;

            card.style.display = (coincideTexto && coincideEstado) ? "flex" : "none";
        });
    }

    if (buscador) {
        buscador.addEventListener("input", filtrar);
    }

    function activarBoton(botonActivo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            if (!btn) return;

            btn.classList.remove("text-white", "shadow-md");
            btn.classList.add("text-slate-400");
            btn.style.background = "transparent";
        });

        if (botonActivo) {
            botonActivo.classList.remove("text-slate-400");
            botonActivo.classList.add("text-white", "shadow-md");
            botonActivo.style.background =
                "linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%)";
        }
    }

    if (btnTodos) {
        btnTodos.addEventListener("click", () => {
            filtroEstado = "todos";
            activarBoton(btnTodos);
            filtrar();
        });
    }

    if (btnActivos) {
        btnActivos.addEventListener("click", () => {
            filtroEstado = "a";
            activarBoton(btnActivos);
            filtrar();
        });
    }

    if (btnInactivos) {
        btnInactivos.addEventListener("click", () => {
            filtroEstado = "i";
            activarBoton(btnInactivos);
            filtrar();
        });
    }
    const modal = document.getElementById('modalEliminarProveedor');
    const form = document.getElementById('formEliminarProveedor');
    const nombreSpan = document.getElementById('delete_nombre');
    if (modal && form && nombreSpan) {

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btnEliminarProveedor');

            if (!btn) return;

            const id = btn.dataset.id;
            const nombre = btn.dataset.nombre;

            nombreSpan.textContent = nombre;
            form.action = `/admin/Proveedor/${id}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    }

});
