@extends('adminlte::page')

@section('title', 'Nueva Membresía')

@section('content_header')
    <h1>Registrar Nueva Membresía</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.membresias.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id">Cliente *</label>
                            <select name="client_id" id="client_id" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('client_id') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plan_type_id">Plan *</label>
                            <select name="plan_type_id" id="plan_type_id" class="form-control" required>
                                <option value="">Seleccione un plan</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}" {{ old('plan_type_id') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->nombre_plan }} - Bs {{ $plan->precio_plan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plan_type_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_method_id">Método de Pago *</label>
                            <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($metodos as $metodo)
                                    <option value="{{ $metodo->id }}" {{ old('payment_method_id') == $metodo->id ? 'selected' : '' }}>
                                        {{ $metodo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio *</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                   class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                   value="{{ old('fecha_inicio', date('Y-m-d')) }}" required>
                            @error('fecha_inicio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monto_total">Monto Total (Bs) *</label>
                            <input type="number" step="0.01" name="monto_total" id="monto_total" 
                                   class="form-control @error('monto_total') is-invalid @enderror" 
                                   value="{{ old('monto_total') }}" required>
                            @error('monto_total')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="saldo">Saldo Pendiente (Bs)</label>
                            <input type="number" step="0.01" name="saldo" id="saldo" 
                                   class="form-control @error('saldo') is-invalid @enderror" 
                                   value="{{ old('saldo', 0) }}">
                            <small class="text-muted">0 = Pagó completo</small>
                            @error('saldo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.membresias.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop