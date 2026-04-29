<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\EmployeeLoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// ruta del admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin/dashboard');
        })->name('admin.dashboard');
        
        // CRUD Usuarios
        Route::resource('usuarios', ClientController::class)
            ->names('admin.usuarios')
            ->middleware('permission:ver usuarios');
        
        // CRUD Productos
        Route::resource('productos', ProductController::class)
            ->names('admin.productos')
            ->middleware('permission:gestionar productos');
        
        // CRUD Empleados (solo Admin)
        Route::resource('empleados', EmployeeController::class)->names('admin.empleados');
    });
});

// ruta del empleado
Route::prefix('employee')->group(function () {
    Route::get('/login', [EmployeeLoginController::class, 'showLoginForm'])->name('employee.login');
    Route::post('/login', [EmployeeLoginController::class, 'login'])->name('employee.login.submit');
    Route::post('/logout', [EmployeeLoginController::class, 'logout'])->name('employee.logout');
    
    Route::middleware('auth:employee')->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('employee.dashboard');
        
        // CRUD Usuarios
        Route::resource('usuarios', ClientController::class)
            ->names('employee.usuarios')
            ->middleware('permission:ver usuarios');
        
        // CRUD Productos
        Route::resource('productos', ProductController::class)
            ->names('employee.productos')
            ->middleware('permission:gestionar productos');
    });
});