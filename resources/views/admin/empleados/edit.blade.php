@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5>Datos Personales</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $empleado->nombre) }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido *</label>
                            <input type="text" name="apellido" id="apellido" 
                                   class="form-control @error('apellido') is-invalid @enderror" 
                                   value="{{ old('apellido', $empleado->apellido) }}" required>
                            @error('apellido')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono *</label>
                            <input type="text" name="telefono" id="telefono" 
                                   class="form-control @error('telefono') is-invalid @enderror" 
                                   value="{{ old('telefono', $empleado->telefono) }}" required>
                            @error('telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role_id">Rol *</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" 
                                        {{ $empleado->roles->first()?->id == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Datos de Acceso</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo">Correo Electrónico *</label>
                            <input type="email" name="correo" id="correo" 
                                   class="form-control @error('correo') is-invalid @enderror" 
                                   value="{{ old('correo', $empleado->correo) }}" required>
                            @error('correo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contrasena">Contraseña (dejar vacío para no cambiar)</label>
                            <input type="password" name="contrasena" id="contrasena" 
                                   class="form-control @error('contrasena') is-invalid @enderror">
                            @error('contrasena')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
@stop