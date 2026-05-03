<form action="{{ route('admin.membresias.update', $membresium) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Cliente</label>
                <select name="client_id" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $membresium->client_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Plan</label>
                <select name="plan_type_id" class="form-control" required>
                    @foreach($planes as $plan)
                        <option value="{{ $plan->id }}" {{ $membresium->plan_type_id == $plan->id ? 'selected' : '' }}>
                            {{ $plan->nombre_plan }} - Bs {{ $plan->precio_plan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Método de Pago</label>
                <select name="payment_method_id" class="form-control" required>
                    @foreach($metodos as $metodo)
                        <option value="{{ $metodo->id }}" {{ $membresium->payment_method_id == $metodo->id ? 'selected' : '' }}>
                            {{ $metodo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" 
                       value="{{ $membresium->fecha_inicio->format('Y-m-d') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Fecha Final</label>
                <input type="date" name="fecha_final" class="form-control" 
                       value="{{ $membresium->fecha_final->format('Y-m-d') }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Monto Total (Bs)</label>
                <input type="number" step="0.01" name="monto_total" class="form-control" 
                       value="{{ $membresium->monto_total }}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Saldo (Bs)</label>
                <input type="number" step="0.01" name="saldo" class="form-control" value="{{ $membresium->saldo }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="activa" {{ $membresium->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="vencida" {{ $membresium->estado == 'vencida' ? 'selected' : '' }}>Vencida</option>
                    <option value="congelada" {{ $membresium->estado == 'congelada' ? 'selected' : '' }}>Congelada</option>
                    <option value="cancelada" {{ $membresium->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Guardar Cambios
    </button>
</form>

<hr>

@if($membresium->saldo > 0)
    <h6>Registrar Pago</h6>
    <form action="{{ route('admin.membresias.registrarPago', $membresium) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="number" step="0.01" name="monto" class="form-control" placeholder="Monto" max="{{ $membresium->saldo }}" required>
            </div>
            <div class="col-md-3">
                <select name="payment_method_id" id="modalPagoMetodo" class="form-control" required>
                    <option value="">Método</option>
                    @foreach($metodos as $metodo)
                        <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <div id="modalComprobanteGrupo" style="display: none;">
                    <input type="file" name="comprobante" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-check"></i> Registrar
                </button>
            </div>
        </div>
    </form>
@endif

@if($membresium->pagos->isNotEmpty())
    <h6 class="mt-3">Historial de Pagos</h6>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Monto</th>
                <th>Método</th>
                <th>Comprobante</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membresium->pagos as $pago)
                <tr>
                    <td>Bs {{ number_format($pago->monto, 2) }}</td>
                    <td>{{ $pago->paymentMethod->nombre ?? 'N/A' }}</td>
                    <td>
                        @if($pago->comprobante)
                            <a href="{{ asset('storage/' . $pago->comprobante) }}" target="_blank">Ver</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<script>
    $('#modalPagoMetodo').on('change', function() {
        let metodo = $(this).find(':selected').text().toLowerCase();
        if (metodo.includes('qr')) {
            $('#modalComprobanteGrupo').show();
        } else {
            $('#modalComprobanteGrupo').hide();
        }
    });
</script>