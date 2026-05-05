<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    public function run(): void
    {
        $employee = Employee::firstOrCreate(
            ['correo' => 'recepcion@gimnasio.local'],
            [
                'nombre' => 'Recepcion',
                'apellido' => 'Test',
                'telefono' => '60000000',
                'contrasena' => Hash::make('Recep.2026*'),
                'estado' => 'ACTIVO',
            ]
        );

        // Asignar rol de Recepcionista (guard 'employee')
        try {
            $role = Role::findByName('Recepcionista', 'employee');
            $employee->assignRole($role);
            // Mantener role_id consistente si existe la columna
            if (method_exists($employee, 'getAttribute')) {
                $employee->role_id = $role->id;
                $employee->save();
            }
        } catch (\Exception $e) {
            // Si no existe el rol, mostrar en logs y continuar
            \Log::warning('EmployeeUserSeeder: rol Recepcionista no encontrado - ' . $e->getMessage());
        }
    }
}
