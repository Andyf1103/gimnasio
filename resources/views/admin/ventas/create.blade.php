@extends('adminlte::page')

@section('title', 'Nueva Venta')

@section('content_header')
    <h1>Punto de Venta</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    <div class="row">
        {{-- Columna productos --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Productos</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select id="producto_id" class="form-control select2" style="width: 100%;">
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" 
                                            data-nombre="{{ $producto->nombre }}"
                                            data-precio="{{ $producto->precio_venta }}"
                                            data-stock="{{ $producto->stock }}">
                                        {{ $producto->nombre }} - Bs {{ number_format($producto->precio_venta, 2) }} (Stock: {{ $producto->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="cantidad" class="form-control" placeholder="Cantidad" min="1" value="1">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-block" id="btnAgregar">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </div>

                    <table class="table table-bordered" id="tablaCarrito">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="filaVacia">
                                <td colspan="5" class="text-center text-muted">Sin productos agregados</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total:</th>
                                <th id="totalCarrito">Bs 0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Columna datos venta --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos de la Venta</h3>
                </div>
                <div class="card-body">
                    <form id="formVenta" action="{{ route($routePrefix . '.ventas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div id="productosContainer"></div>

                        <div class="form-group">
                            <label for="payment_method_id">Método de Pago *</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($metodos as $metodo)
                                    <option value="{{ $metodo->id }}" data-nombre="{{ $metodo->nombre }}">
                                        {{ $metodo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="grupoComprobante" style="display: none;">
                            <label for="comprobante">Comprobante (QR)</label>
                            <input type="file" name="comprobante" id="comprobante" 
                                   class="form-control @error('comprobante') is-invalid @enderror">
                            @error('comprobante')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="grupoEfectivo" style="display: none;">
                            <div class="form-group">
                                <label for="paga_con">Paga con (Bs)</label>
                                <input type="number" step="0.01" id="paga_con" class="form-control" placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label>Cambio:</label>
                                <h4 id="cambio" class="text-success">Bs 0.00</h4>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="btnCobrar">
                            <i class="fas fa-shopping-cart"></i> Cobrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#producto_id').select2({
            placeholder: 'Buscar producto...',
            allowClear: true
        });
    });

    let contador = 0;

    $('#payment_method_id').on('change', function() {
        let nombre = $(this).find(':selected').data('nombre');
        if (nombre && nombre.toLowerCase() === 'qr') {
            $('#grupoComprobante').show();
            $('#grupoEfectivo').hide();
            $('#paga_con').val('');
            $('#cambio').text('Bs 0.00');
        } else if (nombre && nombre.toLowerCase() === 'efectivo') {
            $('#grupoComprobante').hide();
            $('#comprobante').val('');
            $('#grupoEfectivo').show();
        } else {
            $('#grupoComprobante').hide();
            $('#grupoEfectivo').hide();
        }
    });

    $('#paga_con').on('input', function() {
        let paga = parseFloat($(this).val()) || 0;
        let total = parseFloat($('#totalCarrito').text().replace('Bs ', '')) || 0;
        let cambio = paga - total;
        $('#cambio').text('Bs ' + cambio.toFixed(2));
    });

    $('#btnAgregar').click(function() {
        let select = $('#producto_id');
        let id = select.val();
        let nombre = select.find(':selected').data('nombre');
        let precio = parseFloat(select.find(':selected').data('precio'));
        let stockDisponible = parseInt(select.find(':selected').data('stock'));
        let cantidad = parseInt($('#cantidad').val());

        if (!id || !nombre) {
            Swal.fire({ icon: 'warning', title: 'Atención', text: 'Seleccione un producto.' });
            return;
        }

        if (stockDisponible === 0) {
            Swal.fire({ icon: 'error', title: 'Sin stock', text: 'No hay stock de este producto.' });
            return;
        }

        if (cantidad < 1) {
            Swal.fire({ icon: 'warning', title: 'Cantidad inválida', text: 'La cantidad debe ser al menos 1.' });
            return;
        }

        if (cantidad > stockDisponible) {
            Swal.fire({ icon: 'error', title: 'Stock insuficiente', text: 'No hay suficiente stock. Solo hay ' + stockDisponible + ' disponible(s).' });
            return;
        }

        let subtotal = precio * cantidad;
        contador++;

        $('#filaVacia').hide();

        let fila = `
            <tr>
                <td>${nombre}</td>
                <td>Bs ${precio.toFixed(2)}</td>
                <td>${cantidad}</td>
                <td>Bs ${subtotal.toFixed(2)}</td>
                <td><button type="button" class="btn btn-sm btn-danger btnQuitar"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;

        $('#tablaCarrito tbody').append(fila);

        $('#productosContainer').append(`
            <input type="hidden" name="productos[${contador}][id]" value="${id}">
            <input type="hidden" name="productos[${contador}][cantidad]" value="${cantidad}">
        `);

        $('#producto_id').val('').trigger('change');
        $('#cantidad').val(1);

        actualizarTotal();
    });

    $(document).on('click', '.btnQuitar', function() {
        let fila = $(this).closest('tr');
        let index = fila.index();

        $('#productosContainer input').eq(index - 1).remove();
        $('#productosContainer input').eq(index - 1).remove();

        fila.remove();

        if ($('#tablaCarrito tbody tr').length === 0) {
            $('#filaVacia').show();
        }

        actualizarTotal();
    });

    function actualizarTotal() {
        let total = 0;
        $('#tablaCarrito tbody tr').each(function() {
            let subtotal = parseFloat($(this).find('td:eq(3)').text().replace('Bs ', ''));
            if (!isNaN(subtotal)) total += subtotal;
        });
        $('#totalCarrito').text('Bs ' + total.toFixed(2));
        $('#paga_con').trigger('input');
    }
</script>
@stop