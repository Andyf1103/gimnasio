@extends('adminlte::page')

@section('title', 'Nuevo Método de Pago')

@section('content_header')
    <h1>Nuevo Método de Pago</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.metodos_pago.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" name="nombre" id="nombre" 
                           class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route($routePrefix . '.metodos_pago.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop