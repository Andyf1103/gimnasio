@extends('adminlte::page')

@section('title', 'Métodos de Pago')

@section('content_header')
    <h1>Métodos de Pago</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear metodos pago'));
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($puedeCrear)
                        <a href="{{ route($routePrefix . '.metodos_pago.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Método
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
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($metodos as $metodo)
                        <tr>
                            <td>{{ $metodo->id }}</td>
                            <td>{{ $metodo->nombre }}</td>
                            <td>
                                @can('editar metodos pago')
                                <a href="{{ route($routePrefix . '.metodos_pago.edit', $metodo) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar metodos pago')
                                <form action="{{ route($routePrefix . '.metodos_pago.destroy', $metodo) }}" method="POST" style="display:inline">
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
            {{ $metodos->links() }}
        </div>
    </div>
@stop