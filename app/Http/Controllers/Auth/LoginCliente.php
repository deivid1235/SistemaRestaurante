<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class LoginCliente extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('cliente')->attempt([
            'correo' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect()->route('inicio'); 
    }
}