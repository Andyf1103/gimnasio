@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
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
                    @can('crear usuarios')
                        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Usuario
                        </a>
                    @endcan
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
                        <th>Fecha Inscripción</th>
                        <th>Saldo Pendiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellido }}</td>
                            <td>{{ $usuario->fecha_inscripcion->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $membresiaActiva = $usuario->memberships->whereIn('estado', ['ACTIVA', 'activa'])->first();
                                @endphp
                                @if($membresiaActiva && $membresiaActiva->saldo > 0)
                                    <span class="badge badge-warning">
                                        Bs {{ number_format($membresiaActiva->saldo, 2) }}
                                    </span>
                                    <br>
                                    <small class="text-danger">
                                        Vence: {{ $membresiaActiva->fecha_limite_pago ? $membresiaActiva->fecha_limite_pago->format('d/m/Y') : 'N/A' }}
                                    </small>
                                @elseif($membresiaActiva && $membresiaActiva->fecha_limite_pago)
                                    <span class="badge badge-success">Pagado</span>
                                @else
                                    <span class="text-muted">Ninguno</span>
                                @endif
                            </td>
                            <td>
                                @if($membresiaActiva)
                                    <button type="button" class="btn btn-sm btn-info btn-membresia" 
                                            data-id="{{ $membresiaActiva->id }}">
                                        <i class="fas fa-id-card"></i>
                                    </button>
                                @endif
                                @can('eliminar usuarios')
                                    <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $usuarios->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    {{-- Contenedor del Modal --}}
    <div class="modal fade" id="modalMembresia" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Membresía</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="contenidoMembresia">
                    Cargando...
                </div>
            </div>
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
            window.location = '{{ route("admin.usuarios.index") }}?buscar=' + encodeURIComponent(valor);
        }, 500);
    });

    $('.btn-membresia').click(function() {
        let id = $(this).data('id');
        $('#modalMembresia').modal('show');
        $('#contenidoMembresia').html('Cargando...');

        $.get('{{ url("/admin/membresias") }}/' + id + '?modal=1', function(data) {
            $('#contenidoMembresia').html(data);
        });
    });

    // Recargar página al cerrar el modal
    $('#modalMembresia').on('hidden.bs.modal', function() {
        location.reload();
    });
</script>
@stop