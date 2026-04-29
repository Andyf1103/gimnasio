<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40|unique:roles,name',
            'permisos' => 'array',
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

    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('admin.roles.edit', compact('role', 'permisos'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:40|unique:roles,name,' . $role->id,
            'permisos' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permisos ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}