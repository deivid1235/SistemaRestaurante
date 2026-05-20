
document.addEventListener("DOMContentLoaded", function () {
    const btnBuscar = document.getElementById("btnBuscar");
    if (!btnBuscar) return;
    btnBuscar.addEventListener("click", async function () {
        const tipo = document.getElementById("tipo")?.value;
        const numero = document.getElementById("numero")?.value;
        const nombres = document.getElementById("nombres");
        const razonSocial = document.getElementById("razon_social");
        const direccion = document.getElementById("direccion");
        if (!tipo || !numero) {
            alert("Ingresa tipo y número");
            return;
        }

        if (tipo === "DNI" && numero.length !== 8) {
            alert("El DNI debe tener 8 dígitos");
            return;
        }

        if (tipo === "RUC" && numero.length !== 11) {
            alert("El RUC debe tener 11 dígitos");
            return;
        }

        if (nombres) nombres.value = "Buscando...";

        try {
            const url = `/admin/Clientes/buscar/${tipo}/${numero}`;

            const res = await fetch(url);

            if (!res.ok) {
                const text = await res.text();
                throw new Error(text);
            }

            const data = await res.json();

            if (!data || data.success === false) {
                alert(data.message || "No se encontró información");
                if (nombres) nombres.value = "";
                return;
            }

            // DNI
            if (tipo === "DNI") {
                if (nombres) nombres.value = data.full_name || "";
            }

            // RUC
            if (tipo === "RUC") {
                if (nombres) nombres.value = data.razon_social || "";
                if (razonSocial) razonSocial.value = data.razon_social || "";
                if (direccion) direccion.value = data.direccion || "";
            }

        } catch (error) {
            console.error("ERROR:", error);
            alert("Error al consultar API o servidor");
            if (nombres) nombres.value = "";
        }

    });

});

///admin Clientes
document.addEventListener("DOMContentLoaded", () => {

    const btnTodos = document.getElementById("btnTodosClientes");
    const btnActivos = document.getElementById("btnActivosClientes");
    const btnInactivos = document.getElementById("btnInactivosClientes");
    const buscador = document.getElementById("buscadorClientes");

    const cards = document.querySelectorAll(".area-card");

    let estado = "todos";
    let texto = "";

    function activarBoton(botonActivo) {

        const botones = [btnTodos, btnActivos, btnInactivos];

        botones.forEach(btn => {
            if (!btn) return;

            btn.classList.remove(
                "text-white",
                "font-black",
                "shadow-md",
                "shadow-blue-200"
            );

            btn.classList.add(
                "text-slate-400",
                "font-bold"
            );

            btn.style.background = "transparent";
        });

        // activar actual
        if (botonActivo) {
            botonActivo.classList.remove("text-slate-400", "font-bold");

            botonActivo.classList.add(
                "text-white",
                "font-black",
                "shadow-md",
                "shadow-blue-200"
            );

            botonActivo.style.background =
                "linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%)";
        }
    }

    function filtrar() {

        cards.forEach(card => {

            const dataEstado = card.dataset.estado || "";

            const contenido = (card.innerText || "").toLowerCase();

            const coincideEstado =
                (estado === "todos") || (dataEstado === estado);

            const coincideTexto =
                contenido.includes(texto);

            card.style.display =
                (coincideEstado && coincideTexto)
                    ? "flex"
                    : "none";
        });
    }

    btnTodos?.addEventListener("click", () => {
        estado = "todos";
        activarBoton(btnTodos);
        filtrar();
    });

    btnActivos?.addEventListener("click", () => {
        estado = "a";
        activarBoton(btnActivos);
        filtrar();
    });

    btnInactivos?.addEventListener("click", () => {
        estado = "i";
        activarBoton(btnInactivos);
        filtrar();
    });

    buscador?.addEventListener("input", (e) => {
        texto = (e.target.value || "").toLowerCase().trim();
        filtrar();
    });

    activarBoton(btnTodos);
    filtrar();

});

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalEliminar");
    const spanNombre = document.getElementById("delete_nombre");
    const form = document.getElementById("formEliminarCliente");
    let currentId = null;

    function confirmarEliminar(id, nombre) {

        if (!modal || !spanNombre || !form) {
            console.error("Modal o elementos no encontrados");
            return;
        }
        if (!id) {
            console.error("ID no válido:", id);
            return;
        }
        currentId = id;
        spanNombre.textContent = nombre || "Cliente";
        form.action = `/admin/Clientes/${id}`;
        console.log("ID:", id);
        console.log("ACTION:", form.action);
        modal.classList.remove("hidden");
    }

    function cerrarEliminarCliente() {
        if (!modal) return;

        modal.classList.add("hidden");
        currentId = null;
    }

    modal?.addEventListener("click", (e) => {
        if (e.target === modal) {
            cerrarEliminarCliente();
        }
    });

    form?.addEventListener("submit", (e) => {

        if (!form.action || !form.action.includes("/admin/Clientes/")) {
            e.preventDefault();
            console.error("El form no tiene ID en el action");
            alert("Error: no se puede eliminar, falta ID");
        }

    });

    window.confirmarEliminar = confirmarEliminar;
    window.cerrarEliminarCliente = cerrarEliminarCliente;

});


// APERTURA CAJA 
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalEliminarAperturaCaja');
    const form = document.getElementById('formEliminar');
    const nombreSpan = document.getElementById('delete_nombre');
    if (!modal || !form || !nombreSpan) return;
    window.abrirModalEliminar = function (id, nombre) {
        nombreSpan.textContent = nombre;
        form.action = `/admin/AperturaCaja/delete/${id}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.cerrarModalEliminar = function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const nombre = btn.dataset.nombre;

            window.abrirModalEliminar(id, nombre);
        });
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            window.cerrarModalEliminar();
        }
    });

    const buscador = document.getElementById('buscadorApertura');
    const btnTodos = document.getElementById('btnTodosApertura');
    const btnActivos = document.getElementById('btnActivosApertura');
    const btnInactivos = document.getElementById('btnInactivosApertura');

    const cards = document.querySelectorAll('.card-apertura');

    let filtroEstado = 'todos';

    function filtrarTodo() {
        const texto = (buscador?.value || '').toLowerCase();

        cards.forEach(card => {
            const contenido = card.innerText.toLowerCase();
            const estado = card.dataset.estado;

            const coincideTexto = contenido.includes(texto);

            let coincideEstado = filtroEstado === 'todos'
                || (filtroEstado === 'activos' && estado === 'activo')
                || (filtroEstado === 'inactivos' && estado === 'cerrado');

            card.style.display = (coincideTexto && coincideEstado) ? 'flex' : 'none';
        });
    }

    buscador?.addEventListener('keyup', filtrarTodo);

    btnTodos?.addEventListener('click', () => {
        filtroEstado = 'todos';
        activarBoton(btnTodos);
        filtrarTodo();
    });

    btnActivos?.addEventListener('click', () => {
        filtroEstado = 'activos';
        activarBoton(btnActivos);
        filtrarTodo();
    });

    btnInactivos?.addEventListener('click', () => {
        filtroEstado = 'inactivos';
        activarBoton(btnInactivos);
        filtrarTodo();
    });

    function activarBoton(botonActivo) {
        [btnTodos, btnActivos, btnInactivos].forEach(btn => {
            if (!btn) return;

            btn.classList.remove('text-white', 'shadow-md', 'shadow-blue-200');
            btn.classList.add('text-slate-400');
            btn.style.background = 'transparent';
        });

        botonActivo.classList.remove('text-slate-400');
        botonActivo.classList.add('text-white', 'shadow-md', 'shadow-blue-200');
        botonActivo.style.background = 'linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%)';
    }
});

