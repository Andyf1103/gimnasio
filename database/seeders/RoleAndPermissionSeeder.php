<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $todosLosPermisos = [
            // Usuarios (Clientes)
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver usuarios',
            // Control de usuarios (peso, talla)
            'crear control usuarios',
            'editar control usuarios',
            'eliminar control usuarios',
            'ver control usuarios',
            // Productos
            'crear productos',
            'editar productos',
            'eliminar productos',
            'ver productos',
            // Empleados
            'crear empleados',
            'editar empleados',
            'eliminar empleados',
            'ver empleados',
            // Planes
            'crear planes',
            'editar planes',
            'eliminar planes',
            'ver planes',
            // Membresías
            'crear membresias',
            'editar membresias',
            'eliminar membresias',
            'ver membresias',
            // Ventas
            'crear ventas',
            'ver ventas',
            'eliminar ventas',
            // Métodos de Pago
            'crear metodos pago',
            'editar metodos pago',
            'eliminar metodos pago',
            'ver metodos pago',
            // Asistencias
            'ver asistencias',
            'registrar asistencia',
            // Reportes
            'ver reportes',
            // Roles y permisos
            'gestionar roles',
        ];

        foreach ($todosLosPermisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'admin']);
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'employee']);
        }

        // Rol Admin - Todos los permisos
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'admin']);
        $admin->syncPermissions(Permission::where('guard_name', 'admin')->get());

        // Rol Recepcionista - Permisos limitados
        $recepcionista = Role::firstOrCreate(['name' => 'Recepcionista', 'guard_name' => 'employee']);
        $recepcionista->syncPermissions([
            'crear usuarios',
            'editar usuarios',
            'ver usuarios',
            'ver control usuarios',
            'crear control usuarios',
            'editar control usuarios',
            'ver productos',
            'crear planes',
            'editar planes',
            'ver planes',
            'crear membresias',
            'editar membresias',
            'eliminar membresias',
            'ver membresias',
            'crear ventas',
            'ver ventas',
            'ver metodos pago',
            'crear metodos pago',
            'ver asistencias',
            'registrar asistencia',
        ]);
    }
}