<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Support\PermissionRegistry;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gestionar roles');
    }

    public function index()
    {
        $roles = Role::where('guard_name', 'employee')
            ->with('permissions')
            ->orderBy('name')
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permission::where('guard_name', 'employee')->orderBy('name')->get();
        $modulos = PermissionRegistry::modules();

        return view('admin.roles.create', compact('permisos', 'modulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:40',
                Rule::unique('roles', 'name')->where(fn ($query) => $query->where('guard_name', 'employee')),
            ],
            'permisos' => 'array',
            'permisos.*' => [
                'string',
                Rule::exists('permissions', 'name')->where(fn ($query) => $query->where('guard_name', 'employee')),
            ],
        ]);

        $rol = Role::create([
            'name' => $request->name,
            'guard_name' => 'employee',
        ]);

        if ($request->permisos) {
            $rol->syncPermissions($request->permisos);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado correctamente.');
    }

    public function show(Role $role)
    {
        abort_unless($role->guard_name === 'employee', 404);

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        abort_unless($role->guard_name === 'employee', 404);

        $permisos = Permission::where('guard_name', 'employee')->orderBy('name')->get();
        $modulos = PermissionRegistry::modules();

        return view('admin.roles.edit', compact('role', 'permisos', 'modulos'));
    }

    public function update(Request $request, Role $role)
    {
        abort_unless($role->guard_name === 'employee', 404);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:40',
                Rule::unique('roles', 'name')
                    ->ignore($role->id)
                    ->where(fn ($query) => $query->where('guard_name', 'employee')),
            ],
            'permisos' => 'array',
            'permisos.*' => [
                'string',
                Rule::exists('permissions', 'name')->where(fn ($query) => $query->where('guard_name', 'employee')),
            ],
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permisos ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        abort_unless($role->guard_name === 'employee', 404);

        if (Employee::where('role_id', $role->id)->exists()) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'No puedes eliminar un rol que está asignado a empleados.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}
