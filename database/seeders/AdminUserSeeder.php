<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::firstOrCreate(
            ['email' => 'cristiansanabria@gmail.com'],
            [
                'nombre' => 'Cristian',
                'apellido' => 'Sanabria',
                'usuario' => 'Crissa.',
                'telefono' => '72888344',
                'contrasena' => bcrypt('Cristian.2026*'),
            ]
        );
        
        $admin->assignRole('Administrador');
    }
}