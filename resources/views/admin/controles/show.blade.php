@extends('adminlte::page')

@section('title', 'Detalle de Control')

@section('content_header')
    <h1>Detalle de Control Físico </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> {{ $control->client->nombre ?? 'N/A' }} {{ $control->client->apellido ?? '' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha:</strong> {{ $control->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Peso Inicial:</strong> {{ $control->peso_inicial ? $control->peso_inicial . ' kg' : 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Peso Final:</strong> {{ $control->peso_final ? $control->peso_final . ' kg' : 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Talla:</strong> {{ $control->talla_usuario ? $control->talla_usuario . ' m' : 'N/A' }}</p>
                </div>
            </div>

            <a href="{{ route('admin.controles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop