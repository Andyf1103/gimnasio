@extends('adminlte::page')

@section('title', 'Planes')

@section('content_header')
    <h1>Lista de Planes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.planes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Plan
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Matrícula</th>
                        <th>Duración (días)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planes as $plan)
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->nombre_plan }}</td>
                            <td>Bs {{ number_format($plan->precio_plan, 2) }}</td>
                            <td>{{ $plan->precio_matricula ? 'Bs '.number_format($plan->precio_matricula, 2) : 'N/A' }}</td>
                            <td>{{ $plan->duracion_dias }}</td>
                            <td>
                                <a href="{{ route('admin.planes.edit', $plan) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.planes.destroy', $plan) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar plan?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $planes->links() }}
        </div>
    </div>
@stop