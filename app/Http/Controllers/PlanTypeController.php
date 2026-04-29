<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use Illuminate\Http\Request;

class PlanTypeController extends Controller
{
    public function index()
    {
        $planes = PlanType::orderBy('id', 'desc')->paginate(10);
        return view('admin.planes.index', compact('planes'));
    }

    public function create()
    {
        return view('admin.planes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_plan' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_plan' => 'required|numeric|min:0',
            'precio_matricula' => 'nullable|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
        ]);

        PlanType::create($request->all());

        return redirect()->route('admin.planes.index')
            ->with('success', 'Plan creado correctamente.');
    }

    public function edit(PlanType $plan)
    {
        return view('admin.planes.edit', compact('plan'));
    }

    public function update(Request $request, PlanType $plan)
    {
        $request->validate([
            'nombre_plan' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_plan' => 'required|numeric|min:0',
            'precio_matricula' => 'nullable|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
        ]);

        $plan->update($request->all());

        return redirect()->route('admin.planes.index')
            ->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(PlanType $plan)
    {
        $plan->delete();

        return redirect()->route('admin.planes.index')
            ->with('success', 'Plan eliminado correctamente.');
    }
}