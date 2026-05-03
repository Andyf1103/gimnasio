<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Client;
use App\Models\PlanType;
use App\Models\PaymentMethod;
use App\Models\PagoMembresia;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Membership::with(['client', 'planType', 'paymentMethod']);

        if ($request->buscar) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('apellido', 'like', '%' . $request->buscar . '%');
            });
        }

        $membresias = $query->orderBy('id', 'asc')->paginate(10);

        return view('admin.membresias.index', compact('membresias'));
    }

    public function create()
    {
        $clientes = Client::orderBy('nombre')->get();
        $planes = PlanType::all();
        $metodos = PaymentMethod::all();
        return view('admin.membresias.create', compact('clientes', 'planes', 'metodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_type_id' => 'required|exists:plan_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'fecha_inicio' => 'required|date',
            'monto_total' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'comprobante' => 'nullable|image|max:2048',
        ]);

        $plan = PlanType::find($request->plan_type_id);
        $fecha_final = $this->calcularFechaFinal($request->fecha_inicio, $plan->duracion_dias);

        $rutaComprobante = null;
        $metodo = PaymentMethod::find($request->payment_method_id);
        if ($metodo && strtolower($metodo->nombre) == 'qr' && $request->hasFile('comprobante')) {
            $rutaComprobante = $request->file('comprobante')->store('comprobantes', 'public');
        }

        Membership::create([
            'client_id' => $request->client_id,
            'plan_type_id' => $request->plan_type_id,
            'payment_method_id' => $request->payment_method_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $fecha_final,
            'monto_total' => $request->monto_total,
            'saldo' => $request->saldo,
            'comprobante' => $rutaComprobante,
        ]);

        return redirect()->route('admin.membresias.index')
            ->with('success', 'Membresía creada correctamente.');
    }

    public function show(Membership $membresium, Request $request)
    {
        $membresium->load(['client', 'planType', 'paymentMethod', 'pagos.paymentMethod']);

        if ($request->modal == '1') {
            $clientes = Client::orderBy('nombre')->get();
            $planes = PlanType::all();
            $metodos = PaymentMethod::all();
            return view('admin.membresias.modal', compact('membresium', 'clientes', 'planes', 'metodos'));
        }

        return view('admin.membresias.show', compact('membresium'));
    }

    public function edit(Membership $membresium)
    {
        $clientes = Client::orderBy('nombre')->get();
        $planes = PlanType::all();
        $metodos = PaymentMethod::all();
        return view('admin.membresias.edit', compact('membresium', 'clientes', 'planes', 'metodos'));
    }

    public function update(Request $request, Membership $membresium)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_type_id' => 'required|exists:plan_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'monto_total' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'estado' => 'required|in:activa,vencida,congelada,cancelada',
            'comprobante' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('comprobante');

        $metodo = PaymentMethod::find($request->payment_method_id);
        if ($request->hasFile('comprobante')) {
            $data['comprobante'] = $request->file('comprobante')->store('comprobantes', 'public');
        } elseif (strtolower($metodo->nombre ?? '') != 'qr') {
            $data['comprobante'] = null;
        }

        $membresium->update($data);

        return redirect()->route('admin.membresias.index')
            ->with('success', 'Membresía actualizada correctamente.');
    }

    public function destroy(Membership $membresium)
    {
        $membresium->delete();
        return redirect()->route('admin.membresias.index')
            ->with('success', 'Membresía eliminada correctamente.');
    }

    public function registrarPago(Request $request, Membership $membresium)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01|max:' . $membresium->saldo,
            'payment_method_id' => 'required|exists:payment_methods,id',
            'comprobante' => 'nullable|image|max:2048',
            'fecha_pago' => 'required|date',
        ]);

        $rutaComprobante = null;
        $metodo = PaymentMethod::find($request->payment_method_id);
        if ($metodo && strtolower($metodo->nombre) == 'qr' && $request->hasFile('comprobante')) {
            $rutaComprobante = $request->file('comprobante')->store('comprobantes', 'public');
        }

        PagoMembresia::create([
            'membership_id' => $membresium->id,
            'monto' => $request->monto,
            'payment_method_id' => $request->payment_method_id,
            'comprobante' => $rutaComprobante,
            'fecha_pago' => $request->fecha_pago,
        ]);

        $membresium->saldo = $membresium->saldo - $request->monto;
        $membresium->save();

        return redirect()->route('admin.membresias.edit', $membresium)
            ->with('success', 'Pago registrado correctamente.');
    }

    private function calcularFechaFinal($fechaInicio, $diasHabiles)
    {
        $fecha = new \DateTime($fechaInicio);
        $diasAgregados = 0;

        while ($diasAgregados < $diasHabiles) {
            $fecha->modify('+1 day');
            if ($fecha->format('w') != 0) {
                $diasAgregados++;
            }
        }

        return $fecha->format('Y-m-d');
    }
}