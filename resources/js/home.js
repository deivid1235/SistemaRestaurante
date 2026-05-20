//Cliente /Home
document.addEventListener("DOMContentLoaded", function () {
    const btnBuscar = document.getElementById("btnBuscar");
    if (!btnBuscar) return;
    btnBuscar.addEventListener("click", async function () {
        const tipo = document.getElementById("tipo_documento")?.value;
        const numero = document.getElementById("numero_documento")?.value;
        const nombres = document.querySelector("input[name='nombres']");
        const direccion = document.querySelector("input[name='direccion']");
        if (!tipo || !numero) {
            alert("Selecciona tipo y número");
            return;
        }
        if (tipo === "DNI" && numero.length !== 8) {
            alert("DNI debe tener 8 dígitos");
            return;
        }
        if (tipo === "RUC" && numero.length !== 11) {
            alert("RUC debe tener 11 dígitos");
            return;
        }

        nombres.value = "Buscando...";
        if (direccion) direccion.value = "";

        try {

            const url = `/home/cliente/buscar/${encodeURIComponent(tipo)}/${encodeURIComponent(numero)}`;

            const res = await fetch(url);

            const data = await res.json();

            console.log("RESPUESTA API:", data);

            if (data.error) {
                alert(data.error);
                nombres.value = "";
                return;
            }

            if (tipo === "DNI") {
                nombres.value = data.full_name || "";
            }

            if (tipo === "RUC") {
                nombres.value = data.razon_social || "";
                if (direccion) direccion.value = data.direccion || "";
            }

        } catch (error) {
            console.error("ERROR FETCH:", error);
            alert("Error al consultar API");
            nombres.value = "";
        }
    });

});