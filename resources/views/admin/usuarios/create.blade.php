@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Registrar Nuevo Usuario</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @can('crear usuarios')
    <div class="card">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.usuarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h5>Datos del Usuario</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido *</label>
                            <input type="text" name="apellido" id="apellido" 
                                   class="form-control @error('apellido') is-invalid @enderror" 
                                   value="{{ old('apellido') }}" required>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Plan y Pago</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="plan_type_id">Plan *</label>
                            <select name="plan_type_id" id="plan_type_id" class="form-control select2" style="width: 100%;" required>
                                <option value="">Seleccione un plan</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->nombre_plan }} - Bs {{ $plan->precio_plan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio *</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                   class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monto_total">Monto Total *</label>
                            <input type="number" step="0.01" name="monto_total" id="monto_total" 
                                   class="form-control" value="{{ old('monto_total') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="saldo">Saldo Pendiente</label>
                            <input type="number" step="0.01" name="saldo" id="saldo" 
                                   class="form-control" value="{{ old('saldo', 0) }}">
                            <small class="text-muted">0 = Pagó completo</small>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="grupoComprobante" style="display: none;">
                    <label for="comprobante">Comprobante (QR)</label>
                    <input type="file" name="comprobante" id="comprobante" 
                           class="form-control @error('comprobante') is-invalid @enderror">
                    @error('comprobante')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route($routePrefix . '.usuarios.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
    @else
        <div class="alert alert-danger">No tienes permiso para registrar usuarios.</div>
    @endcan
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Buscar plan...',
            allowClear: true
        });

        @if(old('payment_method_id') && old('payment_method_id') != '' && $metodos->where('id', old('payment_method_id'))->first()?->nombre == 'QR')
            $('#grupoComprobante').show();
        @endif

        $('#payment_method_id').on('change', function() {
            let nombre = $(this).find(':selected').data('nombre');
            if (nombre && nombre.toLowerCase() === 'qr') {
                $('#grupoComprobante').show();
            } else {
                $('#grupoComprobante').hide();
                $('#comprobante').val('');
            }
        });
    });
</script>
@stop