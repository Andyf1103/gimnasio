@extends('adminlte::page')

@section('title', 'Reporte Detallado')

@section('content_header')
    <h1>Reporte Detallado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                   class="form-control" value="{{ request('fecha_inicio', date('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" 
                                   class="form-control" value="{{ request('fecha_fin', date('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Todos</option>
                                <option value="efectivo" {{ request('tipo') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="digital" {{ request('tipo') == 'digital' ? 'selected' : '' }}>Digital</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.reportes.pdf', request()->query()) }}" class="btn btn-danger btn-block mt-2" target="_blank">
                                <i class="fas fa-file-pdf"></i> Exportar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <h5>Membresías Vendidas</h5>
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Monto</th>
                        <th>Método</th>
                        <th>Recepcionista</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($membresias as $m)
                        <tr>
                            <td>{{ $m->planType->nombre_plan ?? 'N/A' }}</td>
                            <td>Bs {{ number_format($m->monto_total, 2) }}</td>
                            <td>{{ $m->paymentMethod->nombre ?? 'N/A' }}</td>
                            <td>{{ $m->creator->nombre ?? 'Admin' }} {{ $m->creator->apellido ?? '' }}</td>
                            <td>{{ $m->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Sin membresías.</td></tr>
                    @endforelse
                    <tr>
                        <th class="text-right">Total:</th>
                        <th>Bs {{ number_format($membresias->sum('monto_total'), 2) }}</th>
                        <th colspan="3"></th>
                    </tr>
                </tbody>
            </table>

            <h5>Ventas de Productos</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Método</th>
                        <th>Recepcionista</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $v)
                        <tr>
                            <td>
                                @foreach($v->saleDetails as $d)
                                    {{ $d->product->nombre ?? 'N/A' }} (x{{ $d->cantidad }})<br>
                                @endforeach
                            </td>
                            <td>Bs {{ number_format($v->total, 2) }}</td>
                            <td>{{ $v->paymentMethod->nombre ?? 'N/A' }}</td>
                            <td>
                                @if($v->employee)
                                    {{ $v->employee->nombre }} {{ $v->employee->apellido }}
                                @else
                                    Admin
                                @endif
                            </td>
                            <td>{{ $v->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Sin ventas.</td></tr>
                    @endforelse
                    <tr>
                        <th class="text-right">Total:</th>
                        <th>Bs {{ number_format($ventas->sum('total'), 2) }}</th>
                        <th colspan="3"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop