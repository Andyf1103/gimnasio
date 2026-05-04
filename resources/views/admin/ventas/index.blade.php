@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Lista de Ventas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Venta
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('admin.ventas.index', ['orden' => 'id', 'direccion' => $columna == 'id' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                # @if($columna == 'id') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>Recepcionista</th>
                        <th>Método</th>
                        <th>
                            <a href="{{ route('admin.ventas.index', ['orden' => 'total', 'direccion' => $columna == 'total' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Total @if($columna == 'total') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.ventas.index', ['orden' => 'created_at', 'direccion' => $columna == 'created_at' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Fecha @if($columna == 'created_at') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>
                                @if($venta->employee)
                                    {{ $venta->employee->nombre }} {{ $venta->employee->apellido }}
                                @else
                                    Admin
                                @endif
                            </td>
                            <td>{{ $venta->paymentMethod->nombre ?? 'N/A' }}</td>
                            <td>Bs {{ number_format($venta->total, 2) }}</td>
                            <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ventas.show', $venta) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.ventas.destroy', $venta) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar venta?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $ventas->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@stop