@extends('adminlte::page')

@section('title', 'Planes')

@section('content_header')
    <h1>Lista de Planes</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear planes'));
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="buscar" class="form-control" placeholder="Buscar..." value="{{ request('buscar') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 text-right">
                    @if($puedeCrear)
                        <a href="{{ route($routePrefix . '.planes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Plan
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
                                @can('editar planes')
                                <a href="{{ route($routePrefix . '.planes.edit', $plan) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar planes')
                                <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                        data-url="{{ route($routePrefix . '.planes.destroy', $plan) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $planes->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    <form id="formEliminar" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('js')
<script>
    let timer;
    $('#buscar').on('input', function() {
        clearTimeout(timer);
        let valor = $(this).val();
        timer = setTimeout(function() {
            window.location = '{{ route($routePrefix . ".planes.index") }}?buscar=' + encodeURIComponent(valor);
        }, 500);
    });

    $(document).on('click', '.btn-eliminar', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: '¿Eliminar plan?',
            text: 'No podrás deshacer esta acción.',
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