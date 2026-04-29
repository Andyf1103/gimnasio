@extends('adminlte::page')

@section('title', 'Nueva Venta')

@section('content_header')
    <h1>Punto de Venta</h1>
@stop

@section('content')
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
                            <select id="producto_id" class="form-control">
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" 
                                            data-nombre="{{ $producto->nombre }}"
                                            data-precio="{{ $producto->precio_venta }}">
                                        {{ $producto->nombre }} - Bs {{ number_format($producto->precio_venta, 2) }}
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
                    <form id="formVenta" action="{{ route('admin.ventas.store') }}" method="POST">
                        @csrf
                        
                        <div id="productosContainer"></div>

                        <div class="form-group">
                            <label for="client_id">Cliente (opcional)</label>
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="">Externo</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_method_id">Método de Pago *</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($metodos as $metodo)
                                    <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
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
    let contador = 0;

    $('#btnAgregar').click(function() {
        let select = $('#producto_id');
        let id = select.val();
        let nombre = select.find(':selected').data('nombre');
        let precio = parseFloat(select.find(':selected').data('precio'));
        let cantidad = parseInt($('#cantidad').val());

        if (!id || !nombre) {
            alert('Seleccione un producto.');
            return;
        }

        if (cantidad < 1) {
            alert('La cantidad debe ser al menos 1.');
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

        // Hidden inputs
        $('#productosContainer').append(`
            <input type="hidden" name="productos[${contador}][id]" value="${id}">
            <input type="hidden" name="productos[${contador}][cantidad]" value="${cantidad}">
        `);

        // Reset
        $('#producto_id').val('');
        $('#cantidad').val(1);

        actualizarTotal();
    });

    $(document).on('click', '.btnQuitar', function() {
        let fila = $(this).closest('tr');
        let index = fila.index();

        // Remover hidden inputs
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
    }
</script>
@stop