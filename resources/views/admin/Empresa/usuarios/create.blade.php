@extends('layouts.dashboard')
@section('title', 'Nuevo Usuario')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">

    {{-- ── HEADER GRADIENTE ── --}}
    <div class="relative w-full rounded-[2rem] p-6 md:p-8 overflow-hidden shadow-lg flex flex-wrap lg:flex-nowrap justify-between items-center gap-6"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">

        <div class="z-10">
            <span class="bg-white/10 text-white/90 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/10">
                Empresa / Usuarios
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-white mt-3 tracking-tight">Nuevo Usuario</h1>
            <p class="text-white/70 text-xs mt-1">Complete los datos para registrar un nuevo usuario del sistema.</p>
        </div>

        <a href="{{ route('usuarios.index') }}"
           class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3 flex items-center gap-3 text-white font-bold text-sm transition-all duration-300 hover:-translate-y-1 active:scale-95 z-10">
            <i class="fa fa-arrow-left"></i> Volver al listado
        </a>
    </div>

    {{-- ── FLASH ERRORES ── --}}
    @if($errors->any())
        <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 text-sm px-5 py-4 rounded-2xl shadow-sm">
            <i class="fa fa-circle-exclamation mt-0.5 text-rose-500"></i>
            <div>
                <p class="font-bold mb-1">Corrige los siguientes errores:</p>
                <ul class="list-disc list-inside space-y-0.5 text-xs">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- ── ASIDE: foto + rol + estado ── --}}
            <aside class="lg:col-span-3 space-y-6">

                {{-- Foto de perfil --}}
                <div class="group bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 flex flex-col items-center transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                    <div class="relative w-40 h-40 bg-slate-50 border border-slate-100 rounded-3xl flex items-center justify-center overflow-hidden transition-all duration-500 group-hover:bg-white group-hover:border-blue-100 cursor-pointer"
                         onclick="document.getElementById('fotoInput').click()">

                        <img id="previewFoto"
                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23f1f5f9' width='100' height='100'/%3E%3Ccircle cx='50' cy='38' r='18' fill='%23cbd5e1'/%3E%3Cellipse cx='50' cy='80' rx='28' ry='20' fill='%23cbd5e1'/%3E%3C/svg%3E"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             alt="Foto de perfil">

                        <div class="absolute inset-0 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100 bg-blue-600/30 transition-opacity duration-300">
                            <i class="fa fa-camera text-white text-2xl drop-shadow"></i>
                        </div>
                    </div>

                    <label class="mt-4 flex items-center gap-2 text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] transition-colors duration-300 group-hover:text-blue-600 cursor-pointer"
                           for="fotoInput">
                        <i class="fa fa-camera text-[11px]"></i> Foto de Perfil
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">Click en la imagen para subir</p>
                    <input type="file" id="fotoInput" name="foto" accept="image/*" class="hidden" onchange="previewImagen(this)">
                </div>

                {{-- Rol --}}
                <div class="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-200 space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-5 bg-indigo-500 rounded-full"></div>
                        <p class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Rol / Cargo de Sistema</p>
                    </div>

                    <div class="relative">
                        <button type="button" id="rolBtn" onclick="toggleRoles()"
                                class="w-full flex items-center justify-between gap-2 px-4 py-3 rounded-2xl
                                       bg-indigo-600 text-white text-sm font-black shadow transition-all duration-300 hover:bg-indigo-700 active:scale-95">
                            <span id="rolLabel">Seleccionar Rol</span>
                            <i class="fa fa-chevron-down text-xs transition-transform duration-300" id="rolChevron"></i>
                        </button>

                        <div id="rolesDropdown"
                             class="absolute z-20 top-full mt-2 w-full bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden hidden">
                            <div class="p-2 border-b border-slate-50">
                                <input type="text" placeholder="Buscar rol..."
                                       class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 border border-slate-100 focus:outline-none focus:border-indigo-300"
                                       oninput="filtrarRoles(this.value)">
                            </div>
                            <div class="py-1 max-h-52 overflow-y-auto">
                                @foreach($roles as $rol)
                                    <button type="button"
                                            onclick="seleccionarRol('{{ $rol }}')"
                                            data-rol="{{ strtolower($rol) }}"
                                            class="rol-option w-full text-left px-4 py-2.5 text-xs font-black text-slate-500 hover:bg-indigo-50 hover:text-indigo-700 transition-colors uppercase tracking-wider">
                                        {{ $rol }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="rol" id="rolInput" value="{{ old('rol') }}">
                    @error('rol')
                        <p class="text-[10px] text-rose-500 font-bold">{{ $message }}</p>
                    @enderror

                    {{-- Estado --}}
                    <div class="flex items-center justify-between pt-2 border-t border-slate-50">
                        <div>
                            <p class="text-xs font-black text-slate-600">Estado</p>
                            <p class="text-[10px] text-slate-400">Usuario activo en el sistema</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="estado" value="1" class="sr-only peer"
                                   {{ old('estado', '1') == '1' ? 'checked' : '' }}>
                            <div class="w-10 h-5 bg-slate-200 rounded-full peer
                                        peer-checked:bg-emerald-500 transition-colors
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:rounded-full after:h-4 after:w-4
                                        after:transition-all peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                </div>

                {{-- Botón volver (desktop) --}}
                <a href="{{ route('usuarios.index') }}"
                   class="hidden lg:flex items-center gap-3 px-4 py-3 rounded-2xl text-rose-500 hover:bg-rose-50 font-black text-sm transition-all duration-300 border border-transparent hover:border-rose-100 hover:-translate-x-1 group">
                    <div class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-100 text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all">
                        <i class="fa fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                    </div>
                    Volver al Menú
                </a>
            </aside>

            {{-- ── MAIN: datos del usuario ── --}}
            <main class="lg:col-span-9 space-y-6">

                {{-- Datos personales --}}
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Datos Personales</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        {{-- DNI --}}
                        <div class="group bg-blue-50/50 p-4 rounded-2xl border border-blue-200/60 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-blue-500 uppercase mb-2 tracking-widest">
                                <i class="fa fa-fingerprint text-[11px]"></i> DNI
                            </label>
                            <input type="text" name="dni" value="{{ old('dni') }}"
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base tracking-wider"
                                   placeholder="12345678">
                        </div>

                        {{-- Nombres --}}
                        <div class="group bg-violet-50/50 p-4 rounded-2xl border border-violet-200/60 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md md:col-span-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-violet-500 uppercase mb-2 tracking-widest">
                                <i class="fa fa-user text-[11px]"></i> Nombres <span class="text-rose-400">*</span>
                            </label>
                            <input type="text" name="nombres" value="{{ old('nombres') }}" required
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base uppercase"
                                   placeholder="Ingrese nombres">
                            @error('nombres')<p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Apellido Paterno --}}
                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-200 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">
                                <i class="fa fa-user text-[11px]"></i> Ape. Paterno
                            </label>
                            <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base uppercase"
                                   placeholder="">
                        </div>

                        {{-- Apellido Materno --}}
                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-200 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">
                                <i class="fa fa-user text-[11px]"></i> Ape. Materno
                            </label>
                            <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base uppercase"
                                   placeholder="">
                        </div>

                        {{-- Cargo RRHH --}}
                        <div class="group bg-amber-50/50 p-4 rounded-2xl border border-amber-200/60 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-amber-600 uppercase mb-2 tracking-widest">
                                <i class="fa fa-briefcase text-[11px]"></i> Cargo (RRHH)
                            </label>
                            <input type="text" name="cargo_rrhh" value="{{ old('cargo_rrhh') }}"
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm"
                                   placeholder="Ej: Administrador">
                        </div>

                        {{-- Email --}}
                        <div class="group bg-rose-50/50 p-4 rounded-2xl border border-rose-200/60 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md md:col-span-3">
                            <label class="flex items-center gap-2 text-[10px] font-black text-rose-500 uppercase mb-2 tracking-widest">
                                <i class="fa fa-envelope text-[11px]"></i> Email / Correo
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm"
                                   placeholder="correo@ejemplo.com">
                            @error('email')<p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Credenciales --}}
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Credenciales de Acceso</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Usuario de sistema --}}
                        <div class="group flex items-center gap-4 bg-emerald-50/40 p-4 rounded-2xl border border-emerald-100 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <div class="w-12 h-12 bg-emerald-500/10 text-emerald-600 rounded-xl flex items-center justify-center text-lg transition-transform group-hover:scale-110 flex-shrink-0">
                                <i class="fa fa-user-shield"></i>
                            </div>
                            <div class="w-full">
                                <label class="block text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">
                                    Usuario de Sistema <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" name="username" value="{{ old('username') }}" required
                                       class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base"
                                       placeholder="usuario123">
                                @error('username')<p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Contraseña --}}
                        <div class="group flex items-center gap-4 bg-indigo-50/40 p-4 rounded-2xl border border-indigo-100 shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <div class="w-12 h-12 bg-indigo-500/10 text-indigo-600 rounded-xl flex items-center justify-center text-lg transition-transform group-hover:scale-110 flex-shrink-0">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="w-full">
                                <label class="block text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-1">
                                    Contraseña <span class="text-rose-400">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <input type="password" name="password" id="passwordInput" required
                                           class="w-full bg-transparent border-none p-0 pr-6 focus:ring-0 font-bold text-slate-700 text-base"
                                           placeholder="••••••••">
                                    <button type="button" onclick="togglePassword()"
                                            class="absolute right-0 text-slate-300 hover:text-slate-600 transition-colors">
                                        <i class="fa fa-eye text-sm" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')<p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botón guardar --}}
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-10 py-4 rounded-2xl font-black text-xs text-white uppercase tracking-widest shadow-xl shadow-blue-200 transition-all flex items-center gap-3 active:scale-95 hover:opacity-90"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-save text-sm"></i>
                        Guardar Usuario
                    </button>
                </div>
            </main>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImagen(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('previewFoto').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleRoles() {
        const dd      = document.getElementById('rolesDropdown');
        const chevron = document.getElementById('rolChevron');
        dd.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }

    function seleccionarRol(rol) {
        document.getElementById('rolInput').value  = rol;
        document.getElementById('rolLabel').textContent = rol;
        document.getElementById('rolesDropdown').classList.add('hidden');
        document.getElementById('rolChevron').classList.remove('rotate-180');
        document.querySelectorAll('.rol-option').forEach(btn => {
            const active = btn.dataset.rol === rol.toLowerCase();
            btn.classList.toggle('bg-indigo-600', active);
            btn.classList.toggle('text-white', active);
            btn.classList.toggle('text-slate-500', !active);
        });
    }

    function filtrarRoles(valor) {
        document.querySelectorAll('.rol-option').forEach(btn => {
            btn.style.display = btn.dataset.rol.includes(valor.toLowerCase()) ? '' : 'none';
        });
    }

    document.addEventListener('click', e => {
        const dd = document.getElementById('rolesDropdown');
        if (!dd.classList.contains('hidden') && !e.target.closest('#rolBtn') && !e.target.closest('#rolesDropdown')) {
            dd.classList.add('hidden');
            document.getElementById('rolChevron').classList.remove('rotate-180');
        }
    });

    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('eyeIcon');
        input.type  = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }

    @if(old('rol'))
        seleccionarRol('{{ old('rol') }}');
    @endif
</script>
@endpush

@endsection
