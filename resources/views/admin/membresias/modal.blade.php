@php
    $urlPrefix = Auth::guard('admin')->check() ? '/admin' : '/employee';
@endphp

<form id="formEditarMembresiaModal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" id="modalEditMembresiaId" value="{{ $membresium->id }}">
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Cliente</label>
                <select name="client_id" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $membresium->client_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->ci ?? 'S/N' }})
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
                    <option value="activa" {{ $membresium->estado_real == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="vencida" {{ $membresium->estado_real == 'vencida' || $membresium->estado_real == 'VENCIDA' ? 'selected' : '' }}>Vencida</option>
                    <option value="congelada" {{ $membresium->estado_real == 'congelada' ? 'selected' : '' }}>Congelada</option>
                    <option value="cancelada" {{ $membresium->estado_real == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Guardar Cambios
    </button>
</form>

<hr>

@if($membresium->comprobante)
    <h6>Comprobante del Primer Pago</h6>
    <p>
        <a href="{{ asset('storage/' . $membresium->comprobante) }}" target="_blank">Ver comprobante</a>
    </p>
    <hr>
@endif

@if($membresium->saldo > 0)
    <h6>Registrar Pago</h6>
    <form id="formPagoModal" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="modalMembresiaId" value="{{ $membresium->id }}">
        <div class="row">
            <div class="col-md-3">
                <input type="number" step="0.01" name="monto" id="modalMonto" class="form-control" placeholder="Monto" max="{{ $membresium->saldo }}" required>
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
                    <input type="file" name="comprobante" id="modalComprobante" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="fecha_pago" id="modalFechaPago" class="form-control" value="{{ date('Y-m-d') }}" required>
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
    // Mostrar/ocultar comprobante
    $('#modalPagoMetodo').on('change', function() {
        let metodo = $(this).find(':selected').text().toLowerCase();
        if (metodo.includes('qr')) {
            $('#modalComprobanteGrupo').show();
        } else {
            $('#modalComprobanteGrupo').hide();
        }
    });

    // Enviar edición por AJAX
    $('#formEditarMembresiaModal').on('submit', function(e) {
        e.preventDefault();
        let id = $('#modalEditMembresiaId').val();
        let formData = new FormData(this);

        $.ajax({
            url: '{{ $urlPrefix }}/membresias/' + id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Membresía actualizada',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalMembresia').modal('hide');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar la membresía.'
                });
            }
        });
    });

    // Enviar pago por AJAX
    $('#formPagoModal').on('submit', function(e) {
        e.preventDefault();
        let id = $('#modalMembresiaId').val();
        let formData = new FormData(this);

        $.ajax({
            url: '{{ $urlPrefix }}/membresias/' + id + '/pago',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $.get('{{ $urlPrefix }}/membresias/' + id + '?modal=1', function(data) {
                    $('#contenidoMembresia').html(data);
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al registrar el pago.'
                });
            }
        });
    });
</script>