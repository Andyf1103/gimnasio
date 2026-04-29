<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $empleados = Employee::orderBy('id', 'desc')->paginate(10);
        return view('admin.empleados.index', compact('empleados'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'employee')->get();
        return view('admin.empleados.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:employees,correo',
            'contrasena' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $empleado = Employee::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'role_id' => $request->role_id,
            'estado' => 'ACTIVO',
        ]);

        $rol = Role::findById($request->role_id, 'employee');
        $empleado->assignRole($rol);

        return redirect()->route('admin.empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function edit(Employee $empleado)
    {
        $roles = Role::where('guard_name', 'employee')->get();
        return view('admin.empleados.edit', compact('empleado', 'roles'));
    }

    public function update(Request $request, Employee $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|unique:employees,correo,' . $empleado->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $empleado->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
        ]);

        if ($request->contrasena) {
            $empleado->update(['contrasena' => Hash::make($request->contrasena)]);
        }

        // Sincronizar rol
        $rol = Role::findById($request->role_id, 'employee');
        $empleado->syncRoles([$rol]);

        return redirect()->route('admin.empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Employee $empleado)
    {
        $empleado->delete();

        return redirect()->route('admin.empleados.index')
            ->with('success', 'Empleado eliminado correctamente.');
    }
}