@extends('adminlte::page')

@section('title', 'Panel Recepcionista')

@section('content_header')
    <h1>Panel Recepcionista</h1>
@stop

@section('content')
    <p>Bienvenid@, <strong>{{ Auth::guard('employee')->user()->nombre }}</strong>.</p>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $usuariosActivos }}</h3>
                    <p>Usuarios Activos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Bs {{ number_format($ventasDia, 2) }}</h3>
                    <p>Mis Ventas del Día</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $membresiasPorVencer->count() }}</h3>
                    <p>Membresías por Vencer</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>+</h3>
                    <p>Atajos Rápidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bolt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary btn-block mb-2">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.ventas.create') }}" class="btn btn-success btn-block mb-2">
                <i class="fas fa-shopping-cart"></i> Nueva Venta
            </a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Membresías por Vencer (7 días)</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Plan</th>
                        <th>Vence</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($membresiasPorVencer as $m)
                        <tr>
                            <td>{{ $m->client->nombre ?? 'N/A' }} {{ $m->client->apellido ?? '' }}</td>
                            <td>{{ $m->planType->nombre_plan ?? 'N/A' }}</td>
                            <td>{{ $m->fecha_final->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">Sin membresías por vencer.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop