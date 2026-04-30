<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
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

        return redirect()->route('admin.metodos_pago.index')
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

        return redirect()->route('admin.metodos_pago.index')
            ->with('success', 'Método de pago actualizado.');
    }

    public function destroy(PaymentMethod $metodo)
    {
        $metodo->delete();
        return redirect()->route('admin.metodos_pago.index')
            ->with('success', 'Método de pago eliminado.');
    }
}