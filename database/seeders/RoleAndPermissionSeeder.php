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

        // Permisos para admin
        Permission::create(['name' => 'crear usuarios', 'guard_name' => 'admin']);
        Permission::create(['name' => 'editar usuarios', 'guard_name' => 'admin']);
        Permission::create(['name' => 'eliminar usuarios', 'guard_name' => 'admin']);
        Permission::create(['name' => 'ver usuarios', 'guard_name' => 'admin']);
        Permission::create(['name' => 'gestionar productos', 'guard_name' => 'admin']);
        Permission::create(['name' => 'ver reportes', 'guard_name' => 'admin']);
        Permission::create(['name' => 'gestionar caja', 'guard_name' => 'admin']);

        // Permisos para empleados
        Permission::create(['name' => 'crear usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'editar usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'ver usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'gestionar productos', 'guard_name' => 'employee']);
        Permission::create(['name' => 'gestionar caja', 'guard_name' => 'employee']);

        // Rol Admin
        $admin = Role::create(['name' => 'Administrador', 'guard_name' => 'admin']);
        $admin->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        // Rol Recepcionista
        $recepcionista = Role::create(['name' => 'Recepcionista', 'guard_name' => 'employee']);
        $recepcionista->givePermissionTo(Permission::where('guard_name', 'employee')->get());
    }
}