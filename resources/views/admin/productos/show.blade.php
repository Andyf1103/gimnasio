@extends('adminlte::page')

@section('title', 'Detalle del Producto')

@section('content_header')
    <h1>Detalle del Producto</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $producto->id }}</p>
                    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Precio Venta:</strong> Bs {{ number_format($producto->precio_venta, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                </div>
            </div>

            <a href="{{ route($routePrefix . '.productos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop