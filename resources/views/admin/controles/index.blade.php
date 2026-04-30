@extends('adminlte::page')

@section('title', 'Control de Usuarios')

@section('content_header')
    <h1>Control de Usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.controles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Control
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Peso Inicial (kg)</th>
                        <th>Peso Final (kg)</th>
                        <th>Talla (m)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controles as $control)
                        <tr>
                            <td>{{ $control->id }}</td>
                            <td>{{ $control->client->nombre ?? 'N/A' }} {{ $control->client->apellido ?? '' }}</td>
                            <td>{{ $control->peso_inicial }}</td>
                            <td>{{ $control->peso_final }}</td>
                            <td>{{ $control->talla_usuario }}</td>
                            <td>
                                <a href="{{ route('admin.controles.show', $control) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.controles.edit', $control) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.controles.destroy', $control) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $controles->links() }}
        </div>
    </div>
@stop