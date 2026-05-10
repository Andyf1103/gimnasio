@extends('adminlte::page')

@section('title', 'Panel Administrador')

@section('content_header')
    <h1>Panel Administrador</h1>
@stop

@section('content')
    <p>Bienvenido, <strong>{{ Auth::guard('admin')->user()->nombre }}</strong>.</p>

    <div class="row mb-3">
        <div class="col-md-4">
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary btn-block">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.asistencias.registro') }}" class="btn btn-info btn-block">
                <i class="fas fa-clipboard-check"></i> Registrar Ingreso
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.ventas.create') }}" class="btn btn-success btn-block">
                <i class="fas fa-shopping-cart"></i> Nueva Venta
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Usuarios Activos --}}
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

        {{-- Ingresos del Día --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Bs {{ number_format($ingresosDia, 2) }}</h3>
                    <p>Ingresos del Día</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
        </div>

        {{-- Ganancias del Mes --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>Bs {{ number_format($ingresosMes, 2) }}</h3>
                    <p>Ganancias del Mes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>

        {{-- Productos Bajo Stock --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $productosBajoStock->count() }}</h3>
                    <p>Productos Bajo Stock</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>

        {{-- Membresías por Vencer --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $membresiasPorVencer->count() }}</h3>
                    <p>Membresías por Vencer</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>

        {{-- Saldos Pendientes --}}
<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>Bs {{ number_format($saldosPendientes->sum('saldo'), 2) }}</h3>
            <p>{{ $saldosPendientes->count() }} Usuarios con Saldo</p>
        </div>
        <div class="icon">
            <i class="fas fa-hand-holding-usd"></i>
        </div>
    </div>
</div>
    </div>

    <div class="row">
        {{-- Membresías por Vencer - Detalle --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Membresías por Vencer (3 días)</h3>
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
        </div>

        {{-- Productos Bajo Stock - Detalle --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Productos con Bajo Stock</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productosBajoStock as $p)
                                <tr>
                                    <td>{{ $p->nombre }}</td>
                                    <td>{{ $p->stock }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center">Todo en orden.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Saldos Pendientes - Detalle --}}
<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="card-title">Saldos Pendientes</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($saldosPendientes as $sp)
                        <tr>
                            <td>{{ $sp->client->nombre ?? 'N/A' }} {{ $sp->client->apellido ?? '' }}</td>
                            <td>Bs {{ number_format($sp->saldo, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">Sin saldos pendientes.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
@stop