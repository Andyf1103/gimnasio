@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @can('crear empleados')
                <a href="{{ route('admin.empleados.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Empleado
                </a>
            @endcan
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellido }}</td>
                            <td>{{ $empleado->correo }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->getRoleNames()->first() ?? 'Sin rol' }}</td>
                            <td>{{ $empleado->estado }}</td>
                            <td>
                                @can('editar empleados')
                                <a href="{{ route('admin.empleados.edit', $empleado) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar empleados')
                                <form action="{{ route('admin.empleados.destroy', $empleado) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar empleado?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $empleados->links() }}
        </div>
    </div>
@stop