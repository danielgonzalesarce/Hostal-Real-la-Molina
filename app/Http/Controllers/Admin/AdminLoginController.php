<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Mostrar formulario de login para administradores
     */
    public function showLoginForm()
    {
        // Si ya está autenticado como admin usando el guard admin, redirigir al dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Procesar login de administrador
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticación usando el guard 'admin' (sesión separada)
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Verificar que el usuario sea administrador
            if (Auth::guard('admin')->user()->role !== 'admin') {
                Auth::guard('admin')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Acceso denegado. Solo administradores pueden acceder.'],
                ]);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas no son correctas.'],
        ]);
    }

    /**
     * Cerrar sesión de administrador
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Sesión cerrada correctamente.');
    }
}

