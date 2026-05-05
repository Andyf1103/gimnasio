@extends('adminlte::page')

@section('title', 'Control de Usuarios')

@section('content_header')
    <h1>Control Físico de Usuarios</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear control usuarios'));
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($puedeCrear)
                        <a href="{{ route($routePrefix . '.controles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Control
                        </a>
                    @endif
                </div>
            </div>
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
                                <a href="{{ route($routePrefix . '.controles.show', $control) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('editar control usuarios')
                                <a href="{{ route($routePrefix . '.controles.edit', $control) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar control usuarios')
                                <form action="{{ route($routePrefix . '.controles.destroy', $control) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $controles->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@stop