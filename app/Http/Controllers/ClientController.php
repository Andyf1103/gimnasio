<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PlanType;
use App\Models\PaymentMethod;
use App\Models\Membership;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $usuarios = Client::orderBy('id', 'asc')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $planes = PlanType::all();
        $metodos = PaymentMethod::all();
        return view('admin.usuarios.create', compact('planes', 'metodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'plan_type_id' => 'required|exists:plan_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'fecha_inicio' => 'required|date',
            'monto_total' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'comprobante' => 'nullable|image|max:2048',
        ]);

        $cliente = Client::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        $plan = PlanType::find($request->plan_type_id);
        $fecha_final = date('Y-m-d', strtotime($request->fecha_inicio . ' + ' . $plan->duracion_dias . ' days'));

        $rutaComprobante = null;
        $metodo = PaymentMethod::find($request->payment_method_id);
        if ($metodo && strtolower($metodo->nombre) == 'qr' && $request->hasFile('comprobante')) {
            $rutaComprobante = $request->file('comprobante')->store('comprobantes', 'public');
        }

        Membership::create([
            'client_id' => $cliente->id,
            'plan_type_id' => $request->plan_type_id,
            'payment_method_id' => $request->payment_method_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $fecha_final,
            'monto_total' => $request->monto_total,
            'saldo' => $request->saldo,
            'comprobante' => $rutaComprobante,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario y membresía registrados correctamente.');
    }

    public function show(Client $usuario)
    {
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(Client $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Client $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Client $usuario)
    {
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}