<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ], [
            'correo.required' => 'El correo electrónico es obligatorio',
            'correo.email' => 'Ingresa un correo válido',
            'password.required' => 'La contraseña es obligatoria'
        ]);

        $user = User::where('correo', $request->correo)
            ->where('contraseña', $request->password)
            ->first();

        if ($user) {
            Auth::login($user);
            
            if ($request->has('remember')) {
                Cookie::queue('remember_email', $request->correo, 43200); // 30 días
            } else {
                Cookie::queue(Cookie::forget('remember_email'));
            }
            
            return redirect('/')->with('success', '¡Bienvenido de vuelta!');
        }

        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    // ========== NUEVO MÉTODO: REGISTRO ==========
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:6'
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'Ingresa un correo válido',
            'correo.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres'
        ]);

        // Crear usuario automáticamente
        $user = User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => $request->password
        ]);

        // Iniciar sesión automáticamente después de registrar
        Auth::login($user);

        return redirect('/')->with('success', '¡Cuenta creada exitosamente! Bienvenido a FridgeChef');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}