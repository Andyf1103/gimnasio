<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required',
            'contrasena' => 'required',
        ]);

        if (Auth::guard('employee')->attempt([
            'correo' => $request->correo,
            'password' => $request->contrasena,
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('employee.dashboard'));
        }

        return back()->withErrors(['correo' => 'Credenciales incorrectas.'])->onlyInput('correo');
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employee.login');
    }
}