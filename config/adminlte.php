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

'logo' => '<b>Spasso</b> Gym',
'logo_img' => 'img/logo.png',
'logo_img_class' => 'brand-image elevation-3',
'logo_img_xl' => null,
'logo_img_xl_class' => 'brand-image-xs',
'logo_img_alt' => 'Spasso Gym Logo',

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
        'path' => 'img/logo.png',
        'alt' => 'Spasso Gym',
        'effect' => 'animation__shake',
        'width' => 60,
        'height' => 60,
    ],
],

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_image' => true,
    'usermenu_desc' => true,

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
    ['header' => 'USUARIOS'],
    [
        'text' => 'Usuarios',
        'icon' => 'fas fa-fw fa-users',
        'submenu' => [
            ['text' => 'Usuarios', 'url' => '/admin/usuarios', 'icon' => 'fas fa-fw fa-user'],
            ['text' => 'Membresías', 'url' => '/admin/membresias', 'icon' => 'fas fa-fw fa-id-card'],
            ['text' => 'Control Físico', 'url' => '/admin/controles', 'icon' => 'fas fa-fw fa-weight'],
        ],
    ],
    ['header' => 'PLANES'],
    [
        'text' => 'Planes',
        'url' => '/admin/planes',
        'icon' => 'fas fa-fw fa-tag',
    ],
    ['header' => 'VENTAS'],
    [
        'text' => 'Ventas',
        'icon' => 'fas fa-fw fa-shopping-cart',
        'submenu' => [
            ['text' => 'Ventas', 'url' => '/admin/ventas', 'icon' => 'fas fa-fw fa-cash-register'],
            ['text' => 'Productos', 'url' => '/admin/productos', 'icon' => 'fas fa-fw fa-box'],
            ['text' => 'Métodos de Pago', 'url' => '/admin/metodos_pago', 'icon' => 'fas fa-fw fa-credit-card'],
        ],
    ],
    ['header' => 'ADMINISTRACIÓN'],
    [
        'text' => 'Administración',
        'icon' => 'fas fa-fw fa-cog',
        'submenu' => [
            ['text' => 'Empleados', 'url' => '/admin/empleados', 'icon' => 'fas fa-fw fa-user-tie'],
            ['text' => 'Roles y Permisos', 'url' => '/admin/roles', 'icon' => 'fas fa-fw fa-lock'],
        ],
    ],
    ['header' => 'FINANZAS'],
    [
        'text' => 'Reporte Detallado',
        'url' => '/admin/reportes/detalle',
        'icon' => 'fas fa-fw fa-chart-bar',
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
        'active' => true,
        'files' => [
            ['type' => 'js', 'asset' => false, 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'],
            ['type' => 'css', 'asset' => false, 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css'],
        ],
    ],
    'Sweetalert2' => [
        'active' => true,
        'files' => [
            [
                'type' => 'js',
                'asset' => false,
                'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
            ],
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
