@extends('layouts.dashboard')
@section('title', 'Editar Usuario')

@section('content')
<div class="w-full px-6 animate-fade-in text-slate-700">

    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <div class="w-1 h-6 bg-sky-500 rounded-full"></div>
            Editar Usuario
        </h1>
        <p class="text-slate-500 text-xs mt-1 ml-3">Modifique los campos para actualizar los datos del usuario.</p>
    </div>

    <form action="{{ route('admin.Usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600 shadow-sm border border-sky-100">
                    <i class="fa fa-user-pen text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Datos Principales</h2>
                    <p class="text-slate-400 text-xs tracking-tight">Información fundamental del usuario de acceso.</p>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-x-6 gap-y-8">

                    <div class="md:col-span-3 flex flex-col items-center justify-between border-r border-slate-100 pr-6 self-stretch">

                        <div class="relative group cursor-pointer" onclick="document.getElementById('fotoInput').click()">
                            <div class="w-32 h-32 rounded-[2rem] overflow-hidden border-2 border-slate-100 group-hover:border-sky-400 transition-all duration-300 shadow-inner bg-slate-50 flex items-center justify-center">
                                <img id="previewFoto"
                                    src="{{ $usuario->foto ? asset('storage/' . $usuario->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombres) . '&background=f1f5f9&color=cbd5e1' }}"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity rounded-[2rem]">
                                    <i class="fa fa-camera text-white"></i>
                                </div>
                            </div>
                            <input type="file" id="fotoInput" name="foto" class="hidden" onchange="previewImagen(this)">
                        </div>

                        <div class="w-full bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-tighter text-slate-500">¿Usuario Activo?</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="estado" value="1" class="sr-only peer" {{ $usuario->estado ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="md:col-span-9 flex flex-col gap-6">

                        {{-- FILA 1: DNI · Nombres · Cargo RRHH --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Número de DNI <span class="text-rose-500">*</span></label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-id-card"></i></div>
                                    <input type="text" name="dni" value="{{ old('dni', $usuario->dni) }}" placeholder="Ej: 72654321" class="w-full pl-11 pr-20 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none">
                                    <button type="button" class="absolute right-2 px-3 py-1.5 bg-slate-800 text-white rounded-lg text-[10px] font-bold hover:bg-slate-700 transition-colors">
                                        <i class="fa fa-search mr-1"></i> BUSCAR
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Nombres</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-user"></i></div>
                                    <input type="text" name="nombres" value="{{ old('nombres', $usuario->nombres) }}" placeholder="Ej: Juan Carlos" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none uppercase">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Cargo / RRHH</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-briefcase"></i></div>
                                    <input type="text" name="cargo_rrhh" value="{{ old('cargo_rrhh', $usuario->cargo_rrhh) }}" placeholder="Ej: Administrador" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none">
                                </div>
                            </div>

                        </div>

                        {{-- FILA 2: Apellido Paterno · Apellido Materno · Email --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Apellido Paterno</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-signature"></i></div>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}" placeholder="Ej: Pérez" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none uppercase">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Apellido Materno</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-signature"></i></div>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $usuario->apellido_materno) }}" placeholder="Ej: García" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none uppercase">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-600 uppercase ml-1">Correo Electrónico</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-envelope"></i></div>
                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" placeholder="usuario@empresa.com" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none">
                                </div>
                            </div>

                        </div>

                        {{-- FILA 3: Rol · Username · Password --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-5 mt-1 border-t border-slate-100">

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-800 uppercase ml-1">Rol de Acceso</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-shield-halved"></i></div>
                                    <select name="rol" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all outline-none appearance-none">
                                        <option value="">Seleccionar rol...</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol }}" {{ old('rol', $usuario->rol) == $rol ? 'selected' : '' }}>{{ $rol }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 pointer-events-none text-slate-400 text-xs"><i class="fa fa-chevron-down"></i></div>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-800 uppercase ml-1">Nombre de Usuario</label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-at"></i></div>
                                    <input type="text" name="username" value="{{ old('username', $usuario->username) }}" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-sky-700 outline-none focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-800 uppercase ml-1">
                                    Contraseña
                                    <span class="text-slate-400 normal-case font-normal ml-1">(dejar vacío para no cambiar)</span>
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400"><i class="fa fa-lock"></i></div>
                                    <input type="password" id="passwordInput" name="password" placeholder="••••••••" class="w-full pl-11 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-sky-400 focus:ring-4 focus:ring-sky-500/5 transition-all">
                                    <button type="button" onclick="togglePassword()" class="absolute right-4 top-3.5 text-slate-400"><i class="fa fa-eye" id="eyeIcon"></i></button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Footer / Botones --}}
            <div class="bg-slate-50/50 p-6 border-t border-slate-100 flex justify-between items-center">
                <a href="{{ route('admin.Usuarios.index') }}" class="text-slate-500 text-xs font-bold hover:text-slate-800 transition-colors">
                    <i class="fa fa-arrow-left mr-1"></i> Cancelar
                </a>
                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg shadow-sky-200 transition-all active:scale-95 flex items-center gap-2">
                    Actualizar Usuario <i class="fa fa-chevron-right text-[10px]"></i>
                </button>
            </div>
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
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>
@endpush
@endsection