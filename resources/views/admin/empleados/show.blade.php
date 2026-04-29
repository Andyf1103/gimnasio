@extends('adminlte::page')

@section('title', 'Detalle del Empleado')

@section('content_header')
    <h1>Detalle del Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> {{ $empleado->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $empleado->apellido }}</p>
                    <p><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Correo:</strong> {{ $empleado->correo }}</p>
                    <p><strong>Rol:</strong> {{ $empleado->getRoleNames()->first() ?? 'Sin rol' }}</p>
                    <p><strong>Estado:</strong> {{ $empleado->estado }}</p>
                    <p><strong>Fecha Creación:</strong> {{ $empleado->fecha_creacion }}</p>
                </div>
            </div>

            <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop