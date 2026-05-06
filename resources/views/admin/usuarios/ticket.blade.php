<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante - Spasso Gym</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            width: 80mm;
            margin: 0 auto;
            padding: 5px;
            font-size: 11px;
        }
        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 8px 0; }
        .bold { font-weight: bold; }
        table { width: 100%; }
        td { padding: 2px 0; }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            background: #25D366;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        @media print {
            .btn-back { display: none; }
        }
    </style>
</head>
<body>
    <div class="center">
        <h3 style="margin:0">SPASSO GYM</h3>
        <p style="margin:2px 0">Sucre - Bolivia</p>
        <p style="margin:2px 0">spaziosaunaclub@gmail.com</p>
    </div>
    <div class="line"></div>
    <div class="center bold">COMPROBANTE DE INSCRIPCIÓN</div>
    <div class="center">Fecha: {{ $membresium->created_at->format('d/m/Y H:i') }}</div>
    <div class="line"></div>
    <table>
        <tr><td class="bold">Usuario:</td><td>{{ $membresium->client->nombre }} {{ $membresium->client->apellido }}</td></tr>
        <tr><td class="bold">Plan:</td><td>{{ $membresium->planType->nombre_plan }}</td></tr>
        <tr><td class="bold">Inicio:</td><td>{{ $membresium->fecha_inicio->format('d/m/Y') }}</td></tr>
        <tr><td class="bold">Vence:</td><td>{{ $membresium->fecha_final->format('d/m/Y') }}</td></tr>
        <tr><td class="bold">Total:</td><td>Bs {{ number_format($membresium->monto_total, 2) }}</td></tr>
        <tr><td class="bold">Saldo Pend:</td><td>Bs {{ number_format($membresium->saldo, 2) }}</td></tr>
        <tr><td class="bold">Método:</td><td>{{ $membresium->paymentMethod->nombre ?? 'N/A' }}</td></tr>
        <tr><td class="bold">Estado:</td><td>{{ $membresium->estado_real ?? $membresium->estado }}</td></tr>
    </table>
    <div class="line"></div>
    <table>
        <tr><td class="bold">Atendió:</td><td>{{ Auth::guard('admin')->user()->nombre ?? Auth::guard('employee')->user()->nombre ?? 'Admin' }}</td></tr>
    </table>
    <div class="line"></div>
    <div class="center">
        <p style="margin:5px 0">¡Gracias por tu preferencia!</p>
        <a href="{{ Auth::guard('admin')->check() ? route('admin.usuarios.index') : route('employee.usuarios.index') }}" class="btn-back">
            ← Volver al sistema
        </a>
    </div>
    <script>
        setTimeout(function() {
            window.print();
        }, 500);
    </script>
</body>
</html>