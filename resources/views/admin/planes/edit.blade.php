@extends('adminlte::page')

@section('title', 'Editar Plan')

@section('content_header')
    <h1>Editar Plan</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.planes.update', $plan) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_plan">Nombre del Plan *</label>
                            <input type="text" name="nombre_plan" id="nombre_plan" 
                                   class="form-control @error('nombre_plan') is-invalid @enderror" 
                                   value="{{ old('nombre_plan', $plan->nombre_plan) }}" required>
                            @error('nombre_plan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duracion_dias">Duración (días) *</label>
                            <input type="number" name="duracion_dias" id="duracion_dias" 
                                   class="form-control @error('duracion_dias') is-invalid @enderror" 
                                   value="{{ old('duracion_dias', $plan->duracion_dias) }}" required>
                            @error('duracion_dias')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" 
                              class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $plan->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio_plan">Precio del Plan (Bs) *</label>
                            <input type="number" step="0.01" name="precio_plan" id="precio_plan" 
                                   class="form-control @error('precio_plan') is-invalid @enderror" 
                                   value="{{ old('precio_plan', $plan->precio_plan) }}" required>
                            @error('precio_plan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio_matricula">Precio de Matrícula (Bs)</label>
                            <input type="number" step="0.01" name="precio_matricula" id="precio_matricula" 
                                   class="form-control @error('precio_matricula') is-invalid @enderror" 
                                   value="{{ old('precio_matricula', $plan->precio_matricula) }}">
                            @error('precio_matricula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route($routePrefix . '.planes.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop