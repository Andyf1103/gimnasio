<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:ver planes|crear planes|editar planes|eliminar planes')->only(['index']);
        $this->middleware('permission:crear planes')->only(['create', 'store']);
        $this->middleware('permission:editar planes')->only(['edit', 'update']);
        $this->middleware('permission:eliminar planes')->only(['destroy']);
    }

    private function routePrefix(): string
    {
        return Auth::guard('admin')->check() ? 'admin' : 'employee';
    }

    public function index()
    {
        $planes = PlanType::orderBy('id', 'asc')->paginate(10);
        return view('admin.planes.index', compact('planes'));
    }

    public function create()
    {
        return view('admin.planes.create');
    }

    public function show(PlanType $plan)
    {
        $plan->load(['memberships.client']);

        return view('admin.planes.show', compact('plan'));
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

        return redirect()->route($this->routePrefix() . '.planes.index')
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

        return redirect()->route($this->routePrefix() . '.planes.index')
            ->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(PlanType $plan)
    {
        $plan->delete();

        return redirect()->route($this->routePrefix() . '.planes.index')
            ->with('success', 'Plan eliminado correctamente.');
    }
}
