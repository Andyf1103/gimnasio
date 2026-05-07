@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
    @php
        $routePrefix = Auth::guard('admin')->check() ? 'admin' : 'employee';
    @endphp
    @php
        $puedeCrear = Auth::guard('admin')->check() || (Auth::guard('employee')->check() && Auth::guard('employee')->user()->can('crear productos'));
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
                        <a href="{{ route($routePrefix . '.productos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Producto
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
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>Bs {{ number_format($producto->precio_venta, 2) }}</td>
                            <td>
                                <span class="badge {{ $producto->stock <= 3 ? 'badge-danger' : 'badge-success' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td>
                                @can('editar productos')
                                    <a href="{{ route($routePrefix . '.productos.edit', $producto) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('eliminar productos')
                                    <button type="button" class="btn btn-sm btn-danger btn-eliminar" 
                                            data-url="{{ route($routePrefix . '.productos.destroy', $producto) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $productos->links('pagination::bootstrap-4') !!}
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
            window.location = '{{ route($routePrefix . ".productos.index") }}?buscar=' + encodeURIComponent(valor);
        }, 500);
    });

    $(document).on('click', '.btn-eliminar', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: '¿Eliminar producto?',
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