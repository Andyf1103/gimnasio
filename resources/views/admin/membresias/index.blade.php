@extends('adminlte::page')

@section('title', 'Membresías')

@section('content_header')
    <h1>Lista de Membresías</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear membresias'));
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($puedeCrear)
                        <a href="{{ route($routePrefix . '.membresias.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nueva Membresía
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="buscar" class="form-control" placeholder="Buscar por cliente..." value="{{ request('buscar') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

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
                                @can('editar membresias')
                                <a href="{{ route($routePrefix . '.membresias.edit', $membresia) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar membresias')
                                <form action="{{ route($routePrefix . '.membresias.destroy', $membresia) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar membresía?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $membresias->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@stop

@section('js')
<script>
    let timer;
    $('#buscar').on('input', function() {
        clearTimeout(timer);
        let valor = $(this).val();
        timer = setTimeout(function() {
            window.location = '{{ route($routePrefix . ".membresias.index") }}?buscar=' + encodeURIComponent(valor);
        }, 500);
    });
</script>
@stop