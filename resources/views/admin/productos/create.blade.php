@extends('adminlte::page')

@section('title', 'Nuevo Producto')

@section('content_header')
    <h1>Registrar Nuevo Producto</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @if(auth('admin')->check() || auth('employee')->check())
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.productos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="precio_venta">Precio Venta (Bs) *</label>
                            <input type="number" step="0.01" name="precio_venta" id="precio_venta" 
                                   class="form-control @error('precio_venta') is-invalid @enderror" 
                                   value="{{ old('precio_venta') }}" required>
                            @error('precio_venta')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stock">Stock Inicial</label>
                            <input type="number" name="stock" id="stock" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', 0) }}">
                            @error('stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route($routePrefix . '.productos.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
    @else
        <div class="alert alert-danger">No tienes permiso.</div>
    @endif
@stop