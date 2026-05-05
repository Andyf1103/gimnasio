<?php

namespace App\Http\Controllers;

use App\Models\ClientControl;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientControlController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:ver control usuarios|crear control usuarios|editar control usuarios|eliminar control usuarios')->only(['index', 'show']);
        $this->middleware('permission:crear control usuarios')->only(['create', 'store']);
        $this->middleware('permission:editar control usuarios')->only(['edit', 'update']);
        $this->middleware('permission:eliminar control usuarios')->only(['destroy']);
    }

    private function routePrefix(): string
    {
        return Auth::guard('admin')->check() ? 'admin' : 'employee';
    }

    public function index()
    {
        $controles = ClientControl::with('client')
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.controles.index', compact('controles'));
    }

    public function create()
    {
        $clientes = Client::orderBy('nombre')->get();
        return view('admin.controles.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'peso_inicial' => 'nullable|numeric|min:0',
            'peso_final' => 'nullable|numeric|min:0',
            'talla_usuario' => 'nullable|numeric|min:0',
        ]);

        ClientControl::create($request->all());

        return redirect()->route($this->routePrefix() . '.controles.index')
            ->with('success', 'Control registrado correctamente.');
    }

    public function show(ClientControl $control)
    {
        $control->load('client');
        return view('admin.controles.show', compact('control'));
    }

    public function edit(ClientControl $control)
    {
        $clientes = Client::orderBy('nombre')->get();
        return view('admin.controles.edit', compact('control', 'clientes'));
    }

    public function update(Request $request, ClientControl $control)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'peso_inicial' => 'nullable|numeric|min:0',
            'peso_final' => 'nullable|numeric|min:0',
            'talla_usuario' => 'nullable|numeric|min:0',
        ]);

        $control->update($request->all());

        return redirect()->route($this->routePrefix() . '.controles.index')
            ->with('success', 'Control actualizado correctamente.');
    }

    public function destroy(ClientControl $control)
    {
        $control->delete();
        return redirect()->route($this->routePrefix() . '.controles.index')
            ->with('success', 'Control eliminado correctamente.');
    }
}
