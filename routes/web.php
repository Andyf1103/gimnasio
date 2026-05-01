<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ClientControlController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [UnifiedLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UnifiedLoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin,employee'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::resource('usuarios', ClientController::class)
        ->names('admin.usuarios');

    Route::resource('productos', ProductController::class)
        ->names('admin.productos');

    Route::resource('empleados', EmployeeController::class)
        ->names('admin.empleados');

    Route::resource('roles', RoleController::class)
        ->names('admin.roles');

    Route::resource('planes', PlanTypeController::class)
        ->names('admin.planes')
        ->parameters(['planes' => 'plan']);

    Route::resource('membresias', MembershipController::class)
        ->names('admin.membresias')
        ->parameters(['membresias' => 'membresium']);

    Route::resource('ventas', SaleController::class)
        ->names('admin.ventas')
        ->parameters(['ventas' => 'venta']);

    Route::resource('metodos_pago', PaymentMethodController::class)
        ->names('admin.metodos_pago')
        ->parameters(['metodos_pago' => 'metodo']);

    Route::resource('controles', ClientControlController::class)
        ->names('admin.controles')
        ->parameters(['controles' => 'control']);

    Route::get('/reportes/detalle', [DailyReportController::class, 'detalle'])
        ->name('admin.reportes.detalle');
    Route::get('/reportes/exportar', [DailyReportController::class, 'exportar'])
        ->name('admin.reportes.exportar');
});