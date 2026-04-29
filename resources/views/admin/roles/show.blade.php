@extends('adminlte::page')

@section('title', 'Detalle del Rol')

@section('content_header')
    <h1>Detalle del Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $role->id }}</p>
            <p><strong>Nombre:</strong> {{ $role->name }}</p>
            <p><strong>Guard:</strong> {{ $role->guard_name }}</p>
            
            <h5>Permisos asignados:</h5>
            @if($role->permissions->isNotEmpty())
                @foreach($role->permissions as $permiso)
                    <span class="badge badge-info">{{ $permiso->name }}</span>
                @endforeach
            @else
                <p class="text-muted">Sin permisos asignados.</p>
            @endif

            <br><br>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop