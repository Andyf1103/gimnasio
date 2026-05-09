@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @can('editar usuarios')
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5>Datos del Usuario</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $usuario->nombre) }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido">Apellido *</label>
                            <input type="text" name="apellido" id="apellido" 
                                   class="form-control @error('apellido') is-invalid @enderror" 
                                   value="{{ old('apellido', $usuario->apellido) }}" required>
                            @error('apellido')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ci">Carnet de Identidad *</label>
                            <input type="text" name="ci" id="ci" 
                                   class="form-control @error('ci') is-invalid @enderror" 
                                   value="{{ old('ci', $usuario->ci) }}" required>
                            @error('ci')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Fecha de Inscripción</label>
                    <input type="text" class="form-control" 
                           value="{{ $usuario->fecha_inscripcion->format('d/m/Y H:i') }}" disabled>
                </div>

                @if($usuario->memberships->isNotEmpty())
                    <h5 class="mt-4">Membresías</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Monto</th>
                                <th>Saldo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuario->memberships as $membresia)
                                <tr>
                                    <td>{{ $membresia->planType->nombre_plan ?? 'N/A' }}</td>
                                    <td>{{ $membresia->fecha_inicio->format('d/m/Y') }}</td>
                                    <td>{{ $membresia->fecha_final->format('d/m/Y') }}</td>
                                    <td>Bs {{ number_format($membresia->monto_total, 2) }}</td>
                                    <td>Bs {{ number_format($membresia->saldo, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $membresia->estado == 'activa' ? 'success' : 'secondary' }}">
                                            {{ $membresia->estado }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Sin membresías registradas.</p>
                @endif

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route($routePrefix . '.usuarios.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
    @else
        <div class="alert alert-danger">No tienes permiso para editar usuarios.</div>
    @endcan
@stop