<?php

namespace App\Http\View\Composers;

use App\Support\PermissionRegistry;
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
        config(['adminlte.dashboard_url' => ($isAdmin ? '/admin' : '/employee') . '/dashboard']);
    }

    private function buildMenu($user, bool $isAdmin): array
    {
        $base = $isAdmin ? '/admin' : '/employee';

        $menu = [
            ['header' => 'MENÚ PRINCIPAL'],
            [
                'text' => 'Dashboard',
                'url'  => $base . '/dashboard',
                'icon' => 'fas fa-fw fa-home',
            ],
            ['header' => 'GESTIÓN'],
        ];

        if ($this->canAccessModule($user, $isAdmin, 'usuarios')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear usuarios')) {
                $submenu[] = ['text' => 'Registrar Usuario', 'url' => $base . '/usuarios/create', 'icon' => 'fas fa-fw fa-user-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('usuarios'))) {
                $submenu[] = ['text' => 'Lista de Usuarios', 'url' => $base . '/usuarios', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text'    => 'Usuarios',
                'icon'    => 'fas fa-fw fa-users',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'planes')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear planes')) {
                $submenu[] = ['text' => 'Nuevo Plan', 'url' => $base . '/planes/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('planes'))) {
                $submenu[] = ['text' => 'Lista de Planes', 'url' => $base . '/planes', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text'    => 'Planes',
                'icon'    => 'fas fa-fw fa-tag',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'membresias')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear membresias')) {
                $submenu[] = ['text' => 'Nueva Membresia', 'url' => $base . '/membresias/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('membresias'))) {
                $submenu[] = ['text' => 'Lista de Membresias', 'url' => $base . '/membresias', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text' => 'Membresias',
                'icon' => 'fas fa-fw fa-id-card',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'productos')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear productos')) {
                $submenu[] = ['text' => 'Nuevo Producto', 'url' => $base . '/productos/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('productos'))) {
                $submenu[] = ['text' => 'Lista de Productos', 'url' => $base . '/productos', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text'    => 'Productos',
                'icon'    => 'fas fa-fw fa-box',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'ventas')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear ventas')) {
                $submenu[] = ['text' => 'Nueva Venta', 'url' => $base . '/ventas/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('ventas'))) {
                $submenu[] = ['text' => 'Lista de Ventas', 'url' => $base . '/ventas', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text'    => 'Ventas',
                'icon'    => 'fas fa-fw fa-shopping-cart',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'controles')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear control usuarios')) {
                $submenu[] = ['text' => 'Nuevo Control', 'url' => $base . '/controles/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('controles'))) {
                $submenu[] = ['text' => 'Lista de Controles', 'url' => $base . '/controles', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text' => 'Control de Usuarios',
                'icon' => 'fas fa-fw fa-weight',
                'submenu' => $submenu,
            ];
        }

        if ($this->canAccessModule($user, $isAdmin, 'metodos_pago')) {
            $submenu = [];

            if ($isAdmin || $user->can('crear metodos pago')) {
                $submenu[] = ['text' => 'Nuevo Metodo', 'url' => $base . '/metodos_pago/create', 'icon' => 'fas fa-fw fa-plus'];
            }

            if ($this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor('metodos_pago'))) {
                $submenu[] = ['text' => 'Lista de Metodos', 'url' => $base . '/metodos_pago', 'icon' => 'fas fa-fw fa-list'];
            }

            $menu[] = [
                'text' => 'Metodos de Pago',
                'icon' => 'fas fa-fw fa-credit-card',
                'submenu' => $submenu,
            ];
        }

        if ($isAdmin) {
            $menu[] = [
                'text'    => 'Empleados',
                'icon'    => 'fas fa-fw fa-user-tie',
                'submenu' => [
                    ['text' => 'Nuevo Empleado',     'url' => $base . '/empleados/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Empleados', 'url' => $base . '/empleados',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];

            $menu[] = [
                'text'    => 'Roles y Permisos',
                'icon'    => 'fas fa-fw fa-lock',
                'submenu' => [
                    ['text' => 'Nuevo Rol',      'url' => $base . '/roles/create', 'icon' => 'fas fa-fw fa-plus'],
                    ['text' => 'Lista de Roles', 'url' => $base . '/roles',        'icon' => 'fas fa-fw fa-list'],
                ],
            ];

            $menu[] = ['header' => 'FINANZAS'];
            $menu[] = [
                'text' => 'Reporte Detallado',
                'icon' => 'fas fa-fw fa-chart-bar',
                'url'  => $base . '/reportes/detalle',
            ];
        }

        return $menu;
    }

    private function canAccessModule($user, bool $isAdmin, string $module): bool
    {
        return $this->hasAnyPermission($user, $isAdmin, PermissionRegistry::permissionsFor($module));
    }

    private function hasAnyPermission($user, bool $isAdmin, array $permissions): bool
    {
        if ($isAdmin) {
            return true;
        }

        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return true;
            }
        }

        return false;
    }
}
