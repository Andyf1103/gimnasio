@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @can('crear productos')
                <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
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
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>Bs {{ number_format($producto->precio_venta, 2) }}</td>
                            <td>
                                <span class="badge {{ $producto->stock <= 3 ? 'badge-danger' : 'badge-success' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td>
                                @can('editar productos')
                                    <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('eliminar productos')
                                    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $productos->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@stop