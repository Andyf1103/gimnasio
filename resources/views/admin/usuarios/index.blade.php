@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
        $urlPrefix = Auth::guard('admin')->check() ? '/admin' : '/employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear usuarios'));
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
                        <a href="{{ route($routePrefix . '.usuarios.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Usuario
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
                        <th>CI</th>
                        <th>Fecha Inscripción</th>
                        <th>Saldo Pendiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        @php
                            $membresiaActiva = $usuario->memberships->whereIn('estado', ['ACTIVA', 'activa', 'VENCIDA', 'vencida'])->first();
                        @endphp
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellido }}</td>
                            <td>{{ $usuario->ci ?? 'N/A' }}</td>
                            <td>{{ $usuario->fecha_inscripcion->format('d/m/Y') }}</td>
                            <td>
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
                                <button type="button" class="btn btn-sm btn-secondary btn-asistencias" 
                                        data-id="{{ $usuario->id }}">
                                    <i class="fas fa-clock"></i>
                                </button>
                                @if($membresiaActiva)
                                    @if($membresiaActiva->dias_disponibles <= 3)
                                        <button type="button" class="btn btn-sm btn-success btn-renovar" 
                                                data-id="{{ $membresiaActiva->id }}">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-info btn-membresia" 
                                            data-id="{{ $membresiaActiva->id }}">
                                        <i class="fas fa-id-card"></i>
                                    </button>
                                @endif
                                @can('eliminar usuarios')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                            data-id="{{ $usuario->id }}"
                                            data-url="{{ route($routePrefix . '.usuarios.destroy', $usuario) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $usuarios->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    {{-- Formulario oculto para eliminar --}}
    <form id="formEliminar" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

    {{-- Modal de Membresía --}}
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

    {{-- Modal de Historial de Asistencias --}}
    <div class="modal fade" id="modalAsistencias" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Historial de Asistencias</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="contenidoAsistencias">
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
            window.location = '{{ route($routePrefix . ".usuarios.index") }}?buscar=' + encodeURIComponent(valor);
        }, 500);
    });

    $('.btn-membresia').click(function() {
        let id = $(this).data('id');
        $('#modalMembresia').modal('show');
        $('#contenidoMembresia').html('Cargando...');
        $.get('{{ url($urlPrefix . "/membresias") }}/' + id + '?modal=1', function(data) {
            $('#contenidoMembresia').html(data);
        });
    });

    // Botón Historial de Asistencias
    $(document).on('click', '.btn-asistencias', function() {
        let id = $(this).data('id');
        $('#modalAsistencias').modal('show');
        $('#contenidoAsistencias').html('Cargando...');
        $.get('{{ url($urlPrefix . "/usuarios") }}/' + id + '/asistencias', function(data) {
            $('#contenidoAsistencias').html(data);
        });
    });

    // Botón Renovar
    $(document).on('click', '.btn-renovar', function() {
        let id = $(this).data('id');
        let btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '{{ url($urlPrefix . "/membresias") }}/' + id + '/renovar',
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                btn.prop('disabled', false).html('<i class="fas fa-sync-alt"></i>');
                $('#modalMembresia').modal('show');
                $('#contenidoMembresia').html('Cargando...');
                $.get(response.modal_url, function(data) {
                    $('#contenidoMembresia').html(data);
                });
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-sync-alt"></i>');
                Swal.fire('Error', 'Error al renovar la membresía.', 'error');
            }
        });
    });

    // Botón Eliminar con SweetAlert2
    $(document).on('click', '.btn-eliminar', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: '¿Eliminar usuario?',
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

    $('#modalMembresia').on('hidden.bs.modal', function() {
        location.reload();
    });
</script>
@stop