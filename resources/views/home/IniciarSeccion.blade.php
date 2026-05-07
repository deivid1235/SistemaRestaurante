<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporation AOSC | Gestión Gastronómica</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('iconos/logotipo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            background: linear-gradient(to bottom right, rgba(0, 98, 155, 0.8), rgba(0, 98, 155, 0.3));
            z-index: 2;
        }

        
        .form-view { display: none; }
        .form-view.active { display: block; animation: fadeIn 0.4s ease-out; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex flex-col lg:flex-row min-h-screen">
        
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
                    Corporación de <br> <span class="text-sky-300">Alta Gastronomía</span>
                </h2>
                <div class="h-1 w-16 bg-white/30 my-4 lg:my-6 mx-auto lg:mx-0"></div>
                <p class="text-xs lg:text-base font-light tracking-wide opacity-80 max-w-sm mx-auto lg:mx-0">
                    Excelencia culinaria y tecnología de gestión. Pureza en cada proceso.
                </p>
            </div>
        </div>

        <div class="flex-grow flex flex-col justify-center items-center p-6 lg:p-12 bg-white relative">
            
            <a href="/" class="absolute top-6 right-6 text-gray-400 hover:text-custom transition-colors flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                <i class="bi bi-house-door"></i> Inicio
            </a>

            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-xl font-black text-custom tracking-tighter uppercase">Corporation AOSC</h1>
                    <p class="text-[9px] font-bold text-gray-300 tracking-[0.4em] uppercase">Management System</p>
                </div>

                <div id="login-view" class="form-view active">
                    <div class="mb-8">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">Acceso</h3>
                        <p class="text-gray-400 text-xs font-semibold uppercase tracking-widest mt-1">Ingresa al sistema corporativo</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black text-custom uppercase tracking-widest ml-1">Email</label>
                            <input type="email" name="email" required class="w-full mt-2 p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-custom outline-none transition-all text-sm font-medium" placeholder="usuario@aosc.com">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-custom uppercase tracking-widest ml-1">Contraseña</label>
                            <input type="password" name="password" required class="w-full mt-2 p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-custom outline-none transition-all text-sm font-medium" placeholder="••••••••">
                        </div>

                        <div class="flex justify-between items-center text-[11px] font-bold">
                            <a href="#" class="text-gray-300 hover:text-custom transition-colors uppercase">¿Olvidó su clave?</a>
                            <button type="button" onclick="toggleForm('register')" class="text-custom hover:underline uppercase">Crear cuenta</button>
                        </div>

                        <button type="submit" class="w-full py-4 bg-custom text-white font-black rounded-2xl shadow-xl shadow-blue-100 hover:brightness-110 transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-xs">
                            Entrar <i class="bi bi-arrow-right-short text-xl"></i>
                        </button>
                    </form>
                </div>

                <div id="register-view" class="form-view">
                    <div class="mb-8">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">Nuevo Registro</h3>
                        <p class="text-gray-400 text-xs font-semibold uppercase tracking-widest mt-1">Únete a la corporación</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" placeholder="Nombre de Usuario" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-custom text-sm font-medium">
                        <input type="email" placeholder="Correo Corporativo" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-custom text-sm font-medium">
                        <input type="password" placeholder="Establecer Contraseña" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-custom text-sm font-medium">
                        
                        <button type="submit" class="w-full py-4 bg-emerald-600 text-white font-black rounded-2xl shadow-lg uppercase tracking-widest text-xs mt-2">
                            Finalizar Registro
                        </button>
                        
                        <button type="button" onclick="toggleForm('login')" class="w-full text-center text-[10px] font-black text-gray-400 hover:text-custom uppercase tracking-widest mt-4">
                            <i class="bi bi-chevron-left"></i> Volver al Login
                        </button>
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
        function toggleForm(view) {
            const login = document.getElementById('login-view');
            const register = document.getElementById('register-view');
            if(view === 'register') {
                login.classList.remove('active');
                register.classList.add('active');
            } else {
                register.classList.remove('active');
                login.classList.add('active');
            }
        }

        const items = document.querySelectorAll('.carousel-item');
        let current = 0;
        if(items.length > 1) {
            setInterval(() => {
                items[current].classList.remove('active');
                current = (current + 1) % items.length;
                items[current].classList.add('active');
            }, 5000);
        }
    </script>
</body>
</html>