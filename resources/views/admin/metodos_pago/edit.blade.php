@extends('adminlte::page')

@section('title', 'Editar Método de Pago')

@section('content_header')
    <h1>Editar Método de Pago</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.metodos_pago.update', $metodo) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" name="nombre" id="nombre" 
                           class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre', $metodo->nombre) }}" required>
                    @error('nombre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route($routePrefix . '.metodos_pago.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop