<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporation AOSC | Gestión Gastronómica</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('iconos/logotipo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/styles.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; margin: 0; }

        .bg-custom { background-color: #00629b; }
        .text-custom { color: #00629b; }

        .half-moon-side {
            background: #00629b;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        @media (min-width: 1024px) {
            .half-moon-side {
                clip-path: ellipse(100% 100% at 0% 50%);
                width: 50%;
                min-height: 100vh;
            }
        }

        @media (max-width: 1023px) {
            .half-moon-side {
                clip-path: ellipse(100% 100% at 50% 0%);
                height: 35vh;
                width: 100%;
            }
        }

        .carousel-item {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        .carousel-item.active { opacity: 1; }

        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom right, rgba(0,98,155,0.8), rgba(0,98,155,0.3));
            z-index: 2;
        }

        /* ─── SISTEMA ÚNICO DE PANELES ─── */
        .form-panel { display: none; }
        .form-panel.visible {
            display: block;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased overflow-hidden">
<div class="flex flex-col lg:flex-row h-screen overflow-hidden">

    {{-- ── LADO IZQUIERDO (carrusel) ── --}}
    <div class="half-moon-side shadow-2xl flex items-center justify-center lg:justify-start">
        <div id="carousel-container">
            @if(isset($images) && count($images) > 0)
                @foreach($images as $index => $img)
                    <img src="{{ $img }}" class="carousel-item {{ $index == 0 ? 'active' : '' }}" alt="Gastronomía">
                @endforeach
            @else
                <div class="carousel-item active bg-[#00629b]"></div>
            @endif
        </div>

        <div class="overlay"></div>

        <div class="relative z-10 p-8 lg:p-24 text-white text-center lg:text-left">
            <h2 class="text-2xl lg:text-5xl font-black uppercase leading-tight tracking-tighter">
                Corporación de <br><span class="text-sky-300">Alta Gastronomía</span>
            </h2>
            <div class="h-1 w-16 bg-white/30 my-4 lg:my-6 mx-auto lg:mx-0"></div>
            <p class="text-xs lg:text-base font-light tracking-wide opacity-80 max-w-sm mx-auto lg:mx-0">
                Excelencia culinaria y tecnología de gestión. Pureza en cada proceso.
            </p>
        </div>
    </div>

    {{-- ── LADO DERECHO (formularios) ── --}}
    <div class="flex-grow flex flex-col justify-center items-center p-6 lg:p-12 bg-white relative">

        <a href="/" class="absolute top-6 right-6 text-gray-400 hover:text-custom transition-colors flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
            <i class="bi bi-house-door"></i> Inicio
        </a>

        <div class="w-full max-w-md">

            {{-- Encabezado --}}
            <div class="mb-8 text-center lg:text-left">
                <h1 class="text-2xl lg:text-3xl font-black tracking-tight uppercase text-sky-600">
                    Corporation AOSC
                </h1>
                <p class="text-[9px] font-bold text-slate-400 tracking-[0.35em] uppercase mt-1">
                    Management System
                </p>
            </div>

            {{-- Errores --}}
            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-100 text-rose-700 p-4 rounded-2xl mb-5 text-sm shadow-sm flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <ul class="space-y-1 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ── TABS ── --}}
            <div class="flex p-1.5 bg-[#f1f5f9] rounded-2xl mb-6 items-center">
                <button onclick="switchTab('cliente')" id="btnCliente"
                    class="w-1/2 py-2.5 bg-white text-slate-800 shadow-sm rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300">
                    <i class="bi bi-person mr-1.5"></i> Cliente
                </button>
                <button onclick="switchTab('admin')" id="btnAdmin"
                    class="w-1/2 py-2.5 text-slate-500 hover:text-slate-700 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300">
                    <i class="bi bi-lock mr-1.5"></i> Admin
                </button>
            </div>

            {{-- ── PANEL CLIENTE ── --}}
            <div id="panel-cliente" class="form-panel visible">
                <div class="mb-4">
                    <h3 class="text-lg font-extrabold text-slate-700">Acceso Cliente</h3>
                    <p class="text-xs text-slate-400">Por favor, ingrese sus credenciales asignadas.</p>
                </div>

                <form action="{{ route('cliente.login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wide ml-1">Correo Electrónico</label>
                        <input type="email" name="email" placeholder="usuario@empresa.com"
                               value="{{ old('email') }}" required
                               class="w-full bg-[#f8fafc] border border-transparent rounded-2xl py-3.5 px-4 text-sm text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wide ml-1">Contraseña</label>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full bg-[#f8fafc] border border-transparent rounded-2xl py-3.5 px-4 text-sm text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none font-medium">
                    </div>
                    <button class="w-full bg-[#00629b] text-white py-3.5 rounded-2xl font-bold text-sm tracking-wide shadow-lg shadow-blue-500/10 transition-all hover:opacity-95 active:scale-[0.99]">
                        Entrar como Cliente
                    </button>
                </form>

                <div class="text-center mt-3">
                    <button type="button" onclick="switchTab('register')"
                        class="text-xs font-bold text-[#00629b] hover:underline uppercase tracking-widest">
                        ¿No tienes cuenta? Registrarse
                    </button>
                </div>
            </div>

            {{-- ── PANEL ADMIN ── --}}
            <div id="panel-admin" class="form-panel">
                <div class="mb-4">
                    <h3 class="text-lg font-extrabold text-slate-700">Acceso Administrativo</h3>
                    <p class="text-xs text-slate-400">Panel exclusivo para personal autorizado.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wide ml-1">Correo Admin</label>
                        <input type="email" name="email" placeholder="admin@empresa.com" required
                               class="w-full bg-[#f8fafc] border border-transparent rounded-2xl py-3.5 px-4 text-sm text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-slate-600/10 focus:border-slate-600 focus:bg-white transition-all outline-none font-medium">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wide ml-1">Contraseña</label>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full bg-[#f8fafc] border border-transparent rounded-2xl py-3.5 px-4 text-sm text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-slate-600/10 focus:border-slate-600 focus:bg-white transition-all outline-none font-medium">
                    </div>
                    <button class="w-full bg-slate-800 hover:bg-slate-900 text-white py-3.5 rounded-2xl font-bold text-sm tracking-wide shadow-lg shadow-slate-800/10 transition-all active:scale-[0.99]">
                        Entrar como Admin
                    </button>
                </form>
            </div>

            {{-- ── PANEL REGISTRO ── --}}
            <div id="panel-register" class="form-panel bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <div class="mb-6 flex items-center gap-4 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 border border-emerald-100 shadow-sm">
                        <i class="bi bi-person-plus text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-gray-800 tracking-tight">Nuevo Cliente</h3>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-0.5">
                            Registro de clientes del sistema
                        </p>
                    </div>
                </div>

                <form action="{{ route('home.cliente.store') }}" method="POST">
                    @csrf
                    <div class="max-h-[440px] overflow-y-auto pr-2 space-y-4">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Tipo de Cliente</label>
                                <div class="relative">
                                    <select name="tipo_cliente" required
                                        class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 appearance-none text-gray-700 font-medium">
                                        <option value="">Seleccione tipo</option>
                                        <option value="1">Natural</option>
                                        <option value="2">Empresa</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-gray-400">
                                        <i class="bi bi-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Tipo Documento</label>
                                <div class="relative">
                                    <select name="tipo_documento" id="tipo_documento" required
                                        class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 appearance-none text-gray-700 font-medium">
                                        <option value="">Seleccione doc.</option>
                                        <option value="DNI">DNI</option>
                                        <option value="RUC">RUC</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-gray-400">
                                        <i class="bi bi-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Número de Documento</label>
                                <div class="relative flex items-center">
                                    <input type="text" name="numero_documento" id="numero_documento"
                                           placeholder="Ej. 74839201" required
                                           class="w-full p-3.5 pr-12 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                                    <button type="button" id="btnBuscar"
                                        class="absolute right-2 bg-slate-800 text-white p-2 rounded-lg hover:bg-slate-700 transition-colors shadow-sm flex items-center justify-center active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Nombres / Razón Social</label>
                                <input type="text" name="nombres" placeholder="Nombre completo" required
                                       class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Correo Electrónico</label>
                                <input type="email" name="correo" placeholder="ejemplo@correo.com"
                                       class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Contraseña</label>
                                <input type="password" name="password" placeholder="Mínimo 6 caracteres"
                                       class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                            </div>
                           
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Teléfono / Celular</label>
                                <input type="text" name="telefono" placeholder="Ej. 987654321"
                                    class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Referencia</label>
                                <input type="text" name="referencia" placeholder="Ej. Frente al parque central"
                                    class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nac"
                                   class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 font-medium">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Dirección Domiciliaria</label>
                            <input type="text" name="direccion" placeholder="Av. Las Magnolias 123..."
                                   class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide px-1">Referencia</label>
                            <input type="text" name="referencia" placeholder="Frente al parque central, portón azul..."
                                   class="w-full p-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none transition-all focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 text-gray-700 placeholder-gray-400 font-medium">
                        </div>

                    </div>

                    <div class="pt-4 space-y-3 border-t border-gray-100 mt-4">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-100/60 transition-all hover:opacity-95 active:scale-[0.98] uppercase tracking-widest text-xs">
                            <i class="bi bi-save text-sm"></i> Guardar Cliente
                        </button>

                        <button type="button" onclick="switchTab('cliente')"
                            class="w-full flex items-center justify-center gap-1.5 py-2 text-center text-[11px] font-black text-gray-400 hover:text-emerald-600 uppercase tracking-widest transition-colors">
                            <i class="bi bi-arrow-left text-[9px]"></i> Volver
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-12 text-center">
                <p class="text-gray-300 text-[9px] font-bold tracking-[0.3em] uppercase">
                    AOSC GRUPO &copy; 2026 TECHNOLOGY
                </p>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ── Carrusel ──
    const items = document.querySelectorAll('.carousel-item');
    let current = 0;
    if (items.length > 1) {
        setInterval(() => {
            items[current].classList.remove('active');
            current = (current + 1) % items.length;
            items[current].classList.add('active');
        }, 5000);
    }

    // ── Tabs / Paneles ──
    window.switchTab = function (tab) {
        const panels = {
            cliente:  document.getElementById('panel-cliente'),
            admin:    document.getElementById('panel-admin'),
            register: document.getElementById('panel-register'),
        };
        const btnC = document.getElementById('btnCliente');
        const btnA = document.getElementById('btnAdmin');

        // Ocultar todos
        Object.values(panels).forEach(p => p && p.classList.remove('visible'));

        // Mostrar el seleccionado
        if (panels[tab]) panels[tab].classList.add('visible');

        // Estilos de tabs
        btnC.className = 'w-1/2 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300 '
            + (tab === 'cliente' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700');

        btnA.className = 'w-1/2 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-300 '
            + (tab === 'admin' ? 'bg-slate-800 text-white' : 'text-slate-500 hover:text-slate-700');
    };

});
</script>
</body>
</html>