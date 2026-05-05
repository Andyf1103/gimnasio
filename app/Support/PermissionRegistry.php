<?php

namespace App\Support;

class PermissionRegistry
{
    public static function modules(): array
    {
        return [
            'usuarios' => [
                'label' => 'Usuarios',
                'permissions' => ['crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios'],
            ],
            'controles' => [
                'label' => 'Control Usuarios',
                'permissions' => ['crear control usuarios', 'editar control usuarios', 'eliminar control usuarios', 'ver control usuarios'],
            ],
            'productos' => [
                'label' => 'Productos',
                'permissions' => ['crear productos', 'editar productos', 'eliminar productos', 'ver productos'],
            ],
            'empleados' => [
                'label' => 'Empleados',
                'permissions' => ['crear empleados', 'editar empleados', 'eliminar empleados', 'ver empleados'],
            ],
            'planes' => [
                'label' => 'Planes',
                'permissions' => ['crear planes', 'editar planes', 'eliminar planes', 'ver planes'],
            ],
            'membresias' => [
                'label' => 'Membresias',
                'permissions' => ['crear membresias', 'editar membresias', 'eliminar membresias', 'ver membresias'],
            ],
            'ventas' => [
                'label' => 'Ventas',
                'permissions' => ['crear ventas', 'ver ventas', 'eliminar ventas'],
            ],
            'metodos_pago' => [
                'label' => 'Metodos de Pago',
                'permissions' => ['crear metodos pago', 'editar metodos pago', 'eliminar metodos pago', 'ver metodos pago'],
            ],
            'reportes' => [
                'label' => 'Reportes',
                'permissions' => ['ver reportes'],
            ],
            'roles' => [
                'label' => 'Roles',
                'permissions' => ['gestionar roles'],
            ],
        ];
    }

    public static function permissionsFor(string $module): array
    {
        return static::modules()[$module]['permissions'] ?? [];
    }
}
