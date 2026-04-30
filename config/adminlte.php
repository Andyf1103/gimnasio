<?php

return [

    'title' => 'Gimnasio',
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => '<b>Gimnasio</b>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Gimnasio Logo',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_desc' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => false,
    'dashboard_url' => '/admin/dashboard',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

'menu' => [
    ['header' => 'MENÚ PRINCIPAL'],
    [
        'text' => 'Dashboard',
        'url' => '/admin/dashboard',
        'icon' => 'fas fa-fw fa-home',
    ],
    ['header' => 'GESTIÓN'],
    [
        'text' => 'Usuarios',
        'icon' => 'fas fa-fw fa-users',
        'submenu' => [
            [
                'text' => 'Registrar Usuario',
                'url' => '/admin/usuarios/create',
                'icon' => 'fas fa-fw fa-user-plus',
            ],
            [
                'text' => 'Lista de Usuarios',
                'url' => '/admin/usuarios',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    [
        'text' => 'Planes',
        'icon' => 'fas fa-fw fa-tag',
        'submenu' => [
            [
                'text' => 'Nuevo Plan',
                'url' => '/admin/planes/create',
                'icon' => 'fas fa-fw fa-plus',
            ],
            [
                'text' => 'Lista de Planes',
                'url' => '/admin/planes',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    [
        'text' => 'Membresías',
        'icon' => 'fas fa-fw fa-id-card',
        'url' => '/admin/membresias',
    ],
    [
        'text' => 'Productos',
        'icon' => 'fas fa-fw fa-box',
        'submenu' => [
            [
                'text' => 'Nuevo Producto',
                'url' => '/admin/productos/create',
                'icon' => 'fas fa-fw fa-plus',
            ],
            [
                'text' => 'Lista de Productos',
                'url' => '/admin/productos',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    [
        'text' => 'Ventas',
        'icon' => 'fas fa-fw fa-shopping-cart',
        'submenu' => [
            [
                'text' => 'Nueva Venta',
                'url' => '/admin/ventas/create',
                'icon' => 'fas fa-fw fa-plus',
            ],
            [
                'text' => 'Lista de Ventas',
                'url' => '/admin/ventas',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    [
        'text' => 'Empleados',
        'icon' => 'fas fa-fw fa-user-tie',
        'submenu' => [
            [
                'text' => 'Nuevo Empleado',
                'url' => '/admin/empleados/create',
                'icon' => 'fas fa-fw fa-plus',
            ],
            [
                'text' => 'Lista de Empleados',
                'url' => '/admin/empleados',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
    [
        'text' => 'Métodos de Pago',
        'icon' => 'fas fa-fw fa-credit-card',
        'url' => '/admin/metodos_pago',
    ],
    [
        'text' => 'Roles y Permisos',
        'icon' => 'fas fa-fw fa-lock',
        'submenu' => [
            [
                'text' => 'Nuevo Rol',
                'url' => '/admin/roles/create',
                'icon' => 'fas fa-fw fa-plus',
            ],
            [
                'text' => 'Lista de Roles',
                'url' => '/admin/roles',
                'icon' => 'fas fa-fw fa-list',
            ],
        ],
    ],
],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                ['type' => 'js', 'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'],
                ['type' => 'js', 'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'],
                ['type' => 'css', 'asset' => false, 'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                ['type' => 'js', 'asset' => false, 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'],
                ['type' => 'css', 'asset' => false, 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css'],
            ],
        ],
    ],

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    'livewire' => false,
];