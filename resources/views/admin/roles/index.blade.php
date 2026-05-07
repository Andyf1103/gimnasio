@extends('adminlte::page')

@section('title', 'Roles y Permisos')

@section('content_header')
    <h1>Roles y Permisos</h1>
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
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Rol
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                @foreach($rol->permissions as $permiso)
                                    <span class="badge badge-info">{{ $permiso->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.roles.edit', $rol) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                        data-url="{{ route('admin.roles.destroy', $rol) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            title: '¿Eliminar rol?',
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