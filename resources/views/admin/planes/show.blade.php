@extends('adminlte::page')

@section('title', 'Detalle del Plan')

@section('content_header')
    <h1>Detalle del Plan</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> {{ $plan->nombre_plan }}</p>
                    <p><strong>Descripción:</strong> {{ $plan->descripcion ?? 'Sin descripción' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Precio:</strong> Bs {{ number_format($plan->precio_plan, 2) }}</p>
                    <p><strong>Matrícula:</strong> {{ $plan->precio_matricula ? 'Bs '.number_format($plan->precio_matricula, 2) : 'N/A' }}</p>
                    <p><strong>Duración:</strong> {{ $plan->duracion_dias }} días</p>
                </div>
            </div>

            <h5 class="mt-4">Membresías con este plan</h5>
            @if($plan->memberships->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plan->memberships as $membresia)
                            <tr>
                                <td>{{ $membresia->client->nombre ?? 'N/A' }} {{ $membresia->client->apellido ?? '' }}</td>
                                <td>{{ $membresia->fecha_inicio->format('d/m/Y') }}</td>
                                <td>{{ $membresia->fecha_final->format('d/m/Y') }}</td>
                                <td>{{ $membresia->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Sin membresías registradas.</p>
            @endif

            <a href="{{ route($routePrefix . '.planes.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop