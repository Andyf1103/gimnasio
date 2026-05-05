<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:ver metodos pago|crear metodos pago|editar metodos pago|eliminar metodos pago')->only(['index']);
        $this->middleware('permission:crear metodos pago')->only(['create', 'store']);
        $this->middleware('permission:editar metodos pago')->only(['edit', 'update']);
        $this->middleware('permission:eliminar metodos pago')->only(['destroy']);
    }

    private function routePrefix(): string
    {
        return Auth::guard('admin')->check() ? 'admin' : 'employee';
    }

    public function index()
    {
        $metodos = PaymentMethod::orderBy('id', 'asc')->paginate(10);
        return view('admin.metodos_pago.index', compact('metodos'));
    }

    public function create()
    {
        return view('admin.metodos_pago.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:40',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route($this->routePrefix() . '.metodos_pago.index')
            ->with('success', 'Método de pago creado.');
    }

    public function edit(PaymentMethod $metodo)
    {
        return view('admin.metodos_pago.edit', compact('metodo'));
    }

    public function update(Request $request, PaymentMethod $metodo)
    {
        $request->validate([
            'nombre' => 'required|string|max:40',
        ]);

        $metodo->update($request->all());

        return redirect()->route($this->routePrefix() . '.metodos_pago.index')
            ->with('success', 'Método de pago actualizado.');
    }

    public function destroy(PaymentMethod $metodo)
    {
        $metodo->delete();
        return redirect()->route($this->routePrefix() . '.metodos_pago.index')
            ->with('success', 'Método de pago eliminado.');
    }
}
