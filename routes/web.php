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

// Redirigir raíz al login
Route::get('/', function () {
    return redirect('/login');
});

// Login unificado
Route::get('/login', [UnifiedLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UnifiedLoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('logout');

// Admin
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');
    
    Route::resource('usuarios', ClientController::class)
        ->names('admin.usuarios')
        ->middleware('permission:ver usuarios');
    
    Route::resource('productos', ProductController::class)
        ->names('admin.productos')
        ->middleware('permission:gestionar productos');
    
    Route::resource('empleados', EmployeeController::class)->names('admin.empleados');
    
    Route::resource('roles', RoleController::class)->names('admin.roles');
    
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
});

// Employee
Route::middleware('auth:employee')->prefix('employee')->group(function () {
    Route::get('/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');
    
    Route::resource('usuarios', ClientController::class)
        ->names('employee.usuarios')
        ->middleware('permission:ver usuarios');
    
    Route::resource('productos', ProductController::class)
        ->names('employee.productos')
        ->middleware('permission:gestionar productos');
    
    Route::resource('membresias', MembershipController::class)
        ->names('employee.membresias')
        ->parameters(['membresias' => 'membresium']);
    
    Route::resource('ventas', SaleController::class)
        ->names('employee.ventas')
        ->parameters(['ventas' => 'venta']);
    
    Route::resource('metodos_pago', PaymentMethodController::class)
        ->names('employee.metodos_pago')
        ->parameters(['metodos_pago' => 'metodo']);
    
    Route::resource('controles', ClientControlController::class)
        ->names('employee.controles')
        ->parameters(['controles' => 'control']);
});