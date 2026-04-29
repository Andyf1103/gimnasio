@extends('adminlte::page')

@section('title', 'Detalle de Membresía')

@section('content_header')
    <h1>Detalle de Membresía</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Cliente:</strong> {{ $membresium->client->nombre ?? 'N/A' }} {{ $membresium->client->apellido ?? '' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Plan:</strong> {{ $membresium->planType->nombre_plan ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Método de Pago:</strong> {{ $membresium->paymentMethod->nombre ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <p><strong>Fecha Inicio:</strong> {{ $membresium->fecha_inicio->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Fecha Final:</strong> {{ $membresium->fecha_final->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Monto Total:</strong> Bs {{ number_format($membresium->monto_total, 2) }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Saldo:</strong> Bs {{ number_format($membresium->saldo, 2) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Estado:</strong> {{ $membresium->estado }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Creado:</strong> {{ $membresium->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <a href="{{ route('admin.membresias.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop