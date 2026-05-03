<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        h3 { background: #eee; padding: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #ddd; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1>Reporte Detallado</h1>
    <p>Desde: {{ $fechaInicio }} - Hasta: {{ $fechaFin }}</p>

    <h3>Membresías Vendidas</h3>
    <table>
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

    <h3>Ventas de Productos</h3>
    <table>
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
                    <td>{{ $v->employee->nombre ?? 'N/A' }} {{ $v->employee->apellido ?? '' }}</td>
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
</body>
</html>