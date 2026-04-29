@extends('adminlte::page')

@section('title', 'Membresías')

@section('content_header')
    <h1>Lista de Membresías</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Plan</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Monto</th>
                        <th>Saldo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membresias as $membresia)
                        <tr>
                            <td>{{ $membresia->id }}</td>
                            <td>{{ $membresia->client->nombre ?? 'N/A' }} {{ $membresia->client->apellido ?? '' }}</td>
                            <td>{{ $membresia->planType->nombre_plan ?? 'N/A' }}</td>
                            <td>{{ $membresia->fecha_inicio->format('d/m/Y') }}</td>
                            <td>{{ $membresia->fecha_final->format('d/m/Y') }}</td>
                            <td>Bs {{ number_format($membresia->monto_total, 2) }}</td>
                            <td>Bs {{ number_format($membresia->saldo, 2) }}</td>
                            <td>{{ $membresia->estado }}</td>
                            <td>
                                <a href="{{ route('admin.membresias.edit', $membresia) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.membresias.destroy', $membresia) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar membresía?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $membresias->links() }}
        </div>
    </div>
@stop