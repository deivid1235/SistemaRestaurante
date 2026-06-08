<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Aperturas_Caja;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarCajaAbierta
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $cajaAbierta = Aperturas_Caja::where('usuario_id', Auth::id())
        ->where('estado', 'abierto')
        ->exists();

    if (!$cajaAbierta) {
        return redirect()->route('caja.apertura')
            ->with('error', 'Debe abrir caja primero');
    }

    return $next($request);
    }
}
