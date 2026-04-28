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

        // Permisos (usando "usuarios" como los llama el dueño)
        Permission::create(['name' => 'crear usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'editar usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'eliminar usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'ver usuarios', 'guard_name' => 'employee']);
        Permission::create(['name' => 'gestionar productos', 'guard_name' => 'employee']);
        Permission::create(['name' => 'ver reportes', 'guard_name' => 'employee']);
        Permission::create(['name' => 'gestionar caja', 'guard_name' => 'employee']);

        // El administrador tendrá todos los permisos dentro del sistema 
        $admin = Role::create(['name' => 'Administrador', 'guard_name' => 'employee']);
        $admin->givePermissionTo(Permission::all());

        // Los permisos que la recepcionista va a tener 
        $recepcionista = Role::create(['name' => 'Recepcionista', 'guard_name' => 'employee']);
        $recepcionista->givePermissionTo([
            'crear usuarios',
            'editar usuarios',
            'ver usuarios',
            'gestionar productos',
            'gestionar caja',
        ]);
        

    }
}