@extends('adminlte::page')

@section('title', 'Detalle del Usuario')

@section('content_header')
    <h1>Detalle del Usuario</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos Personales</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
                    <p><strong>Inscripción:</strong> {{ $usuario->fecha_inscripcion->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Membresías</h3>
                </div>
                <div class="card-body">
                    @if($usuario->memberships->isNotEmpty())
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
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route($routePrefix . '.usuarios.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
@stop