<?php

namespace Tests\Feature;

use App\Http\View\Composers\MenuComposer;
use App\Models\Employee;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Tests\TestCase;

class EmployeeAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_employee_with_role_can_open_employee_module_without_redirect_to_login(): void
    {
        $employee = Employee::create([
            'nombre' => 'Empleado',
            'apellido' => 'Prueba',
            'telefono' => '70000000',
            'correo' => 'empleado@gym.test',
            'contrasena' => bcrypt('secret123'),
            'estado' => 'ACTIVO',
        ]);
        $employee->assignRole('Recepcionista');

        $response = $this->actingAs($employee, 'employee')->get('/employee/usuarios');

        $response->assertOk();
    }

    public function test_menu_uses_employee_routes_for_employee_guard(): void
    {
        $employee = Employee::create([
            'nombre' => 'Menu',
            'apellido' => 'Prueba',
            'telefono' => '71111111',
            'correo' => 'menu@gym.test',
            'contrasena' => bcrypt('secret123'),
            'estado' => 'ACTIVO',
        ]);
        $employee->assignRole('Recepcionista');

        Auth::guard('employee')->setUser($employee);

        $view = \Mockery::mock(View::class);
        app(MenuComposer::class)->compose($view);

        $menu = config('adminlte.menu');

        $this->assertSame('/employee/dashboard', $menu[1]['url']);
        $this->assertNotSame('/admin/dashboard', $menu[1]['url']);
    }
}
