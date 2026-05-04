@extends('adminlte::page')

@section('title', 'Nuevo Control')

@section('content_header')
    <h1>Registrar Control Físico  de Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.controles.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="client_id">Usuario *</label>
                    <select name="client_id" id="client_id" class="form-control select2" style="width: 100%;" required>
                        <option value="">Seleccione un usuario</option>
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

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="peso_inicial">Peso Inicial (kg)</label>
                            <input type="number" step="0.01" name="peso_inicial" id="peso_inicial" 
                                   class="form-control @error('peso_inicial') is-invalid @enderror" 
                                   value="{{ old('peso_inicial') }}">
                            @error('peso_inicial')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="peso_final">Peso Final (kg)</label>
                            <input type="number" step="0.01" name="peso_final" id="peso_final" 
                                   class="form-control @error('peso_final') is-invalid @enderror" 
                                   value="{{ old('peso_final') }}">
                            @error('peso_final')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="talla_usuario">Talla (m)</label>
                            <input type="number" step="0.01" name="talla_usuario" id="talla_usuario" 
                                   class="form-control @error('talla_usuario') is-invalid @enderror" 
                                   value="{{ old('talla_usuario') }}">
                            @error('talla_usuario')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.controles.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#client_id').select2({
            placeholder: 'Buscar usuario...',
            allowClear: true
        });
    });
</script>
@stop