@extends('layouts.dashboard')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner animate-[spin_5s_linear_infinite]">
                        <i class="fa fa-th-large text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Dashboard 
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Bienvenido al panel de administración. Aquí puedes gestionar clientes, productos, pedidos y más.
                    </p>
                </div>
            </div>

        </div>

        <div class="absolute inset-y-0 right-0 w-full sm:w-1/2 md:w-2/5 h-full pointer-events-none select-none z-0 overflow-hidden opacity-40">
            <svg viewBox="0 0 100 40" preserveAspectRatio="none" class="w-full h-full overflow-visible px-4">
                <defs>
                    <linearGradient id="gridGradientMain" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#ffffff" stop-opacity="0.20" />
                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0.00" />
                    </linearGradient>
                </defs>
                
                <line x1="0" y1="10" x2="100" y2="10" stroke="#ffffff" stroke-width="0.15" stroke-opacity="0.2" />
                <line x1="0" y1="20" x2="100" y2="20" stroke="#ffffff" stroke-width="0.15" stroke-opacity="0.2" />
                <line x1="0" y1="30" x2="100" y2="30" stroke="#ffffff" stroke-width="0.15" stroke-opacity="0.2" />

                <path d="M 0,25 C 10,20 15,13 25,13 C 35,13 42,30 50,30 C 58,30 63,7 72,7 C 81,7 85,20 92,20 C 96,20 98,12 100,5 L 100,40 L 0,40 Z" fill="url(#gridGradientMain)" />
                
                <path d="M 0,25 C 10,20 15,13 25,13 C 35,13 42,30 50,30 C 58,30 63,7 72,7 C 81,7 85,20 92,20 C 96,20 98,12 100,5" fill="none" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="0.8" />
                
                <circle cx="25" cy="13" r="1.3" fill="#0096D9" stroke="#ffffff" stroke-width="0.5" />
                <circle cx="50" cy="30" r="1.3" fill="#0096D9" stroke="#ffffff" stroke-width="0.5" />
                <circle cx="72" cy="7" r="1.3" fill="#0096D9" stroke="#ffffff" stroke-width="0.5" />
                <circle cx="92" cy="20" r="1.3" fill="#0096D9" stroke="#ffffff" stroke-width="0.5" />
            </svg>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 p-1 w-full">
        <div class="cursor-pointer relative bg-white rounded-2xl p-4 border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] flex flex-col justify-between h-36 w-full overflow-hidden select-none transition-all duration-300 ease-out hover:scale-[1.01] hover:border-emerald-500 hover:shadow-[0_10px_25px_-5px_rgba(16,185,129,0.12)] group">
            <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-500/[0.03] group-hover:bg-emerald-500/[0.10] rounded-bl-full pointer-events-none transition-colors duration-300"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-base shadow-sm shadow-emerald-500/10">
                    <i class="fas fa-users"></i>
                </div>
                <span class="bg-emerald-50 text-emerald-600 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-emerald-100/50 flex items-center gap-0.5">
                    <i class="fas fa-arrow-up text-[7px]"></i>{{ number_format($porcentajeClientes ?? 0, 1) }}%
                </span>
            </div>
            <div class="relative z-10 flex flex-col mt-1">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Clientes</p>
                <h2 class="text-xl font-black text-slate-800 tracking-tight leading-none">{{ $totalClientes ?? 0 }}</h2>
            </div>
            <div class="relative z-10 space-y-1.5 border-t border-slate-50 pt-2">
                <div class="text-[9px] font-extrabold uppercase tracking-wider text-emerald-500 flex items-center gap-1">
                    <i class="far fa-calendar-alt text-[10px]"></i> Activos esta semana
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden relative">
                    <div class="h-full bg-emerald-500 w-[80%] rounded-full shadow-[0_0_6px_rgba(16,185,129,0.3)] relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full animate-[shimmer_2.5s_infinite]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-emerald-500/20 group-hover:bg-emerald-500 transition-colors duration-300 rounded-b-2xl"></div>
        </div>

        <div class="cursor-pointer relative bg-white rounded-2xl p-4 border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] flex flex-col justify-between h-36 w-full overflow-hidden select-none transition-all duration-300 ease-out hover:scale-[1.01] hover:border-blue-500 hover:shadow-[0_10px_25px_-5px_rgba(59,130,246,0.12)] group">
            <div class="absolute top-0 right-0 w-28 h-28 bg-blue-500/[0.03] group-hover:bg-blue-500/[0.10] rounded-bl-full pointer-events-none transition-colors duration-300"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="w-9 h-9 rounded-xl bg-blue-500 text-white flex items-center justify-center text-base shadow-sm shadow-blue-500/10">
                    <i class="fas fa-box"></i>
                </div>
                <span class="bg-blue-50 text-blue-600 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-blue-100/50 flex items-center gap-0.5">
                    <i class="fas fa-arrow-up text-[7px]"></i>{{ number_format($porcentajeProductos ?? 0, 1) }}%
                </span>
            </div>
            <div class="relative z-10 flex flex-col mt-1">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Productos</p>
                <h2 class="text-xl font-black text-slate-800 tracking-tight leading-none">{{ $totalProductos ?? 0 }}</h2>
            </div>
            <div class="relative z-10 space-y-1.5 border-t border-slate-50 pt-2">
                <div class="text-[9px] font-extrabold uppercase tracking-wider text-blue-500 flex items-center gap-1">
                    <i class="fas fa-check-circle text-[10px]"></i> Disponibles
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden relative">
                    <div class="h-full bg-blue-500 w-[70%] rounded-full shadow-[0_0_6px_rgba(59,130,246,0.3)] relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full animate-[shimmer_2.5s_infinite]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-blue-500/20 group-hover:bg-blue-500 transition-colors duration-300 rounded-b-2xl"></div>
        </div>

        <div class="cursor-pointer relative bg-white rounded-2xl p-4 border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] flex flex-col justify-between h-36 w-full overflow-hidden select-none transition-all duration-300 ease-out hover:scale-[1.01] hover:border-amber-500 hover:shadow-[0_10px_25px_-5px_rgba(245,158,11,0.12)] group">
            <div class="absolute top-0 right-0 w-28 h-28 bg-amber-500/[0.03] group-hover:bg-amber-500/[0.10] rounded-bl-full pointer-events-none transition-colors duration-300"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center text-base shadow-sm shadow-amber-500/10">
                    <i class="fas fa-store"></i>
                </div>
                <span class="bg-amber-50 text-amber-600 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-amber-100/50 flex items-center gap-0.5">
                    <i class="fas fa-circle text-[6px]"></i> Activos
                </span>
            </div>
            <div class="relative z-10 flex flex-col mt-1">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Salones</p>
                <h2 class="text-xl font-black text-slate-800 tracking-tight leading-none">{{ $totalSalones ?? 0 }}</h2>
            </div>
            <div class="relative z-10 space-y-1.5 border-t border-slate-50 pt-2">
                <div class="text-[9px] font-extrabold uppercase tracking-wider text-amber-500 flex items-center gap-1">
                    <i class="fas fa-door-open text-[10px]"></i> Zonas configuradas
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden relative">
                    <div class="h-full bg-amber-500 w-[50%] rounded-full shadow-[0_0_6px_rgba(245,158,11,0.3)] relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full animate-[shimmer_2.5s_infinite]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-amber-500/20 group-hover:bg-amber-500 transition-colors duration-300 rounded-b-2xl"></div>
        </div>

        <div class="cursor-pointer relative bg-white rounded-2xl p-4 border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] flex flex-col justify-between h-36 w-full overflow-hidden select-none transition-all duration-300 ease-out hover:scale-[1.01] hover:border-purple-500 hover:shadow-[0_10px_25px_-5px_rgba(147,51,234,0.12)] group">
            <div class="absolute top-0 right-0 w-28 h-28 bg-purple-500/[0.03] group-hover:bg-purple-500/[0.10] rounded-bl-full pointer-events-none transition-colors duration-300"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="w-9 h-9 rounded-xl bg-purple-500 text-white flex items-center justify-center text-base shadow-sm shadow-purple-500/10">
                    <i class="fas fa-chair"></i>
                </div>
                <span class="bg-purple-50 text-purple-600 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-purple-100/50 flex items-center gap-0.5">
                    <i class="fas fa-arrow-up text-[7px]"></i>{{ number_format($porcentajeMesas ?? 0, 1) }}%
                </span>
            </div>
            <div class="relative z-10 flex flex-col mt-1">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Mesas</p>
                <h2 class="text-xl font-black text-slate-800 tracking-tight leading-none">{{ $totalMesas ?? 0 }}</h2>
            </div>
            <div class="relative z-10 space-y-1.5 border-t border-slate-50 pt-2">
                <div class="text-[9px] font-extrabold uppercase tracking-wider text-purple-500 flex items-center gap-1">
                    <i class="fas fa-utensils text-[10px]"></i> Total ocupación
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden relative">
                    <div class="h-full bg-purple-500 w-[65%] rounded-full shadow-[0_0_6px_rgba(147,51,234,0.3)] relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full animate-[shimmer_2.5s_infinite]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-purple-500/20 group-hover:bg-purple-500 transition-colors duration-300 rounded-b-2xl"></div>
        </div>

        <div class="cursor-pointer relative bg-white rounded-2xl p-4 border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] flex flex-col justify-between h-36 w-full overflow-hidden select-none transition-all duration-300 ease-out hover:scale-[1.01] hover:border-rose-500 hover:shadow-[0_10px_25px_-5px_rgba(244,63,94,0.12)] group">
            <div class="absolute top-0 right-0 w-28 h-28 bg-rose-500/[0.03] group-hover:bg-rose-500/[0.10] rounded-bl-full pointer-events-none transition-colors duration-300"></div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center text-base shadow-sm shadow-rose-500/10">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="bg-rose-50 text-rose-600 text-[9px] font-extrabold px-1.5 py-0.5 rounded-md border border-rose-100/50 flex items-center gap-0.5">
                    <i class="fas fa-shield-alt text-[7px]"></i> Admin
                </span>
            </div>
            <div class="relative z-10 flex flex-col mt-1">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Usuarios</p>
                <h2 class="text-xl font-black text-slate-800 tracking-tight leading-none">{{ $totalUsuarios ?? 0 }}</h2>
            </div>
            <div class="relative z-10 space-y-1.5 border-t border-slate-50 pt-2">
                <div class="text-[9px] font-extrabold uppercase tracking-wider text-rose-500 flex items-center gap-1">
                    <i class="fas fa-lock-open text-[10px]"></i> Accesos al sistema
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden relative">
                    <div class="h-full bg-rose-500 w-[90%] rounded-full shadow-[0_0_6px_rgba(244,63,94,0.3)] relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full animate-[shimmer_2.5s_infinite]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-1 bg-rose-500/20 group-hover:bg-rose-500 transition-colors duration-300 rounded-b-2xl"></div>
        </div>

    </div>

</div>

@endsection