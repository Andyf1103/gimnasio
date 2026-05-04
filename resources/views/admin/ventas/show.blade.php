@extends('adminlte::page')

@section('title', 'Detalle de Venta')

@section('content_header')
    <h1>Detalle de Venta #{{ $venta->id }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p><strong>Empleado:</strong> {{ $venta->employee->nombre ?? 'N/A' }} {{ $venta->employee->apellido ?? '' }}</p>
                    <p><strong>Método de Pago:</strong> {{ $venta->paymentMethod->nombre ?? 'N/A' }}</p>
                    <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Total:</strong> <strong>Bs {{ number_format($venta->total, 2) }}</strong></p>
                    @if($venta->comprobante)
                        <p><strong>Comprobante:</strong> 
                            <a href="{{ asset('storage/' . $venta->comprobante) }}" target="_blank">Ver comprobante</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Productos Vendidos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->saleDetails as $detalle)
                                <tr>
                                    <td>{{ $detalle->product->nombre ?? 'N/A' }}</td>
                                    <td>Bs {{ number_format($detalle->precio_unitario, 2) }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total:</th>
                                <th>Bs {{ number_format($venta->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
@stop