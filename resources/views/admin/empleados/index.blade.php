@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')
    @php
        $puedeCrear = Auth::guard('admin')->check();
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($puedeCrear)
                        <a href="{{ route('admin.empleados.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Empleado
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
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellido }}</td>
                            <td>{{ $empleado->correo }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->getRoleNames()->first() ?? 'Sin rol' }}</td>
                            <td>{{ $empleado->estado }}</td>
                            <td>
                                @can('editar empleados')
                                <a href="{{ route('admin.empleados.edit', $empleado) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('eliminar empleados')
                                <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                        data-url="{{ route('admin.empleados.destroy', $empleado) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $empleados->links() }}
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
            title: '¿Eliminar empleado?',
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