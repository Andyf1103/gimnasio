<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MenuComposer
{
    public function compose(View $view): void
    {
        $isAdmin    = Auth::guard('admin')->check();
        $isEmployee = Auth::guard('employee')->check();

        if (!$isAdmin && !$isEmployee) return;

        $user = $isAdmin 
            ? Auth::guard('admin')->user() 
            : Auth::guard('employee')->user();

        $menu = $this->buildMenu($user, $isAdmin);

        config(['adminlte.menu' => $menu]);
    }

    private function buildMenu($user, bool $isAdmin): array
    {
        $menu = [
            ['header' => 'MENÚ PRINCIPAL'],
            [
                'text' => 'Dashboard',
                'url'  => '/admin/dashboard',
                'icon' => 'fas fa-fw fa-home',
            ],
            ['header' => 'GESTIÓN'],
        ];

        if ($isAdmin || $user->can('ver usuarios')) {
            $menu[] = [
                'text'    => 'Usuarios',
                'icon'    => 'fas fa-fw fa-users',
                'submenu' => [
                    ['text' => 'Registrar Usuario', 'url' => '/admin/usuarios/create', 'icon' => 'fas fa-fw fa-user-plus'],
                    ['text' => 'Lista de Usuarios',  'url' => '/admin/usuarios',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];
        }

        if ($isAdmin || $user->can('ver planes')) {
            $menu[] = [
                'text'    => 'Planes',
                'icon'    => 'fas fa-fw fa-tag',
                'submenu' => [
                    ['text' => 'Nuevo Plan',      'url' => '/admin/planes/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Planes', 'url' => '/admin/planes',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];
        }

        if ($isAdmin || $user->can('ver membresias')) {
            $menu[] = [
                'text' => 'Membresías',
                'icon' => 'fas fa-fw fa-id-card',
                'url'  => '/admin/membresias',
            ];
        }

        if ($isAdmin || $user->can('ver productos')) {
            $menu[] = [
                'text'    => 'Productos',
                'icon'    => 'fas fa-fw fa-box',
                'submenu' => [
                    ['text' => 'Nuevo Producto',     'url' => '/admin/productos/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Productos', 'url' => '/admin/productos',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];
        }

        if ($isAdmin || $user->can('ver ventas')) {
            $menu[] = [
                'text'    => 'Ventas',
                'icon'    => 'fas fa-fw fa-shopping-cart',
                'submenu' => [
                    ['text' => 'Nueva Venta',     'url' => '/admin/ventas/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Ventas', 'url' => '/admin/ventas',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];
        }

        if ($isAdmin || $user->can('ver control usuarios')) {
            $menu[] = [
                'text' => 'Control de Usuarios',
                'icon' => 'fas fa-fw fa-weight',
                'url'  => '/admin/controles',
            ];
        }

        if ($isAdmin || $user->can('ver metodos pago')) {
            $menu[] = [
                'text' => 'Métodos de Pago',
                'icon' => 'fas fa-fw fa-credit-card',
                'url'  => '/admin/metodos_pago',
            ];
        }

        if ($isAdmin) {
            $menu[] = [
                'text'    => 'Empleados',
                'icon'    => 'fas fa-fw fa-user-tie',
                'submenu' => [
                    ['text' => 'Nuevo Empleado',     'url' => '/admin/empleados/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Empleados', 'url' => '/admin/empleados',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];

            $menu[] = [
                'text'    => 'Roles y Permisos',
                'icon'    => 'fas fa-fw fa-lock',
                'submenu' => [
                    ['text' => 'Nuevo Rol',      'url' => '/admin/roles/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Roles', 'url' => '/admin/roles',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];

            $menu[] = ['header' => 'FINANZAS'];
            $menu[] = [
                'text' => 'Reporte Detallado',
                'icon' => 'fas fa-fw fa-chart-bar',
                'url'  => '/admin/reportes/detalle',
            ];
        }

        return $menu;
    }
}