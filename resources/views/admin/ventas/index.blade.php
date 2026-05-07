@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Lista de Ventas</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear ventas'));
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($puedeCrear)
                        <a href="{{ route($routePrefix . '.ventas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nueva Venta
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route($routePrefix . '.ventas.index', ['orden' => 'id', 'direccion' => $columna == 'id' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                # @if($columna == 'id') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>Recepcionista</th>
                        <th>Método</th>
                        <th>
                            <a href="{{ route($routePrefix . '.ventas.index', ['orden' => 'total', 'direccion' => $columna == 'total' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Total @if($columna == 'total') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route($routePrefix . '.ventas.index', ['orden' => 'created_at', 'direccion' => $columna == 'created_at' && $direccion == 'asc' ? 'desc' : 'asc']) }}">
                                Fecha @if($columna == 'created_at') @if($direccion == 'asc') 🔼 @else 🔽 @endif @endif
                            </a>
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>
                                @if($venta->employee)
                                    {{ $venta->employee->nombre }} {{ $venta->employee->apellido }}
                                @else
                                    Admin
                                @endif
                            </td>
                            <td>{{ $venta->paymentMethod->nombre ?? 'N/A' }}</td>
                            <td>Bs {{ number_format($venta->total, 2) }}</td>
                            <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route($routePrefix . '.ventas.show', $venta) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('eliminar ventas')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                            data-url="{{ route($routePrefix . '.ventas.destroy', $venta) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $ventas->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    <form id="formEliminar" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('js')
<script>
    $(document).on('click', '.btn-eliminar', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: '¿Eliminar venta?',
            text: 'Se repondrá el stock de los productos.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formEliminar').attr('action', url).submit();
            }
        });
    });
</script>
@stop