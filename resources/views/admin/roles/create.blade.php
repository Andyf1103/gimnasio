@extends('adminlte::page')

@section('title', 'Nuevo Rol')

@section('content_header')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nombre del Rol *</label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <h5>Permisos</h5>
                
                @php
                    $modulos = [
                        'Usuarios' => ['crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios'],
                        'Control Usuarios' => ['crear control usuarios', 'editar control usuarios', 'eliminar control usuarios', 'ver control usuarios'],
                        'Productos' => ['crear productos', 'editar productos', 'eliminar productos', 'ver productos'],
                        'Empleados' => ['crear empleados', 'editar empleados', 'eliminar empleados', 'ver empleados'],
                        'Planes' => ['crear planes', 'editar planes', 'eliminar planes', 'ver planes'],
                        'Membresías' => ['crear membresias', 'editar membresias', 'eliminar membresias', 'ver membresias'],
                        'Ventas' => ['crear ventas', 'ver ventas', 'eliminar ventas'],
                        'Caja' => ['gestionar caja', 'ver caja'],
                        'Reportes' => ['ver reportes'],
                        'Roles' => ['gestionar roles'],
                    ];
                @endphp

                @foreach($modulos as $modulo => $permisosDelModulo)
                    <div class="card card-outline card-secondary mb-2">
                        <div class="card-header">
                            <h6 class="card-title mb-0">{{ $modulo }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($permisosDelModulo as $permisoNombre)
                                    @php $permiso = $permisos->where('name', $permisoNombre)->first(); @endphp
                                    @if($permiso)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="permisos[]" value="{{ $permiso->name }}" 
                                                       class="form-check-input" id="permiso_{{ $permiso->id }}">
                                                <label class="form-check-label" for="permiso_{{ $permiso->id }}">
                                                    {{ ucfirst(str_replace('_', ' ', $permiso->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop