@extends('adminlte::page')

@section('title', 'Control de Asistencia')

@section('content_header')
    <h1>Control de Asistencia</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Registrar Ingreso</h3>
                </div>
                <div class="card-body text-center">
                    <div class="form-group">
                        <label for="ci">Carnet de Identidad</label>
                        <input type="text" id="ci" class="form-control" placeholder="Ingrese el CI del cliente" 
                               style="font-size: 24px; text-align: center; font-weight: bold;" autofocus>
                    </div>
                    
                    <button type="button" id="btnVerificar" class="btn btn-primary btn-lg mt-3">
                        <i class="fas fa-search"></i> Verificar
                    </button>

                    <div id="resultado" class="mt-4" style="display: none;">
                        <h4 id="mensaje"></h4>
                        <p id="detalle"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $('#btnVerificar').click(function() {
        let ci = $('#ci').val();
        
        if (!ci) {
            Swal.fire('Atención', 'Ingrese un número de carnet.', 'warning');
            return;
        }

        $.ajax({
            url: '{{ request()->is("admin*") ? url("/admin/asistencias/registrar") : url("/employee/asistencias/registrar") }}',
            type: 'POST',
            data: {
                ci: ci,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#resultado').show();
                
                if (response.status === 'ok') {
                    $('#mensaje').html('<span class="text-success">✅ ' + response.mensaje + '</span>');
                    $('#detalle').text(response.detalle);
                    Swal.fire({
                        icon: 'success',
                        title: 'Acceso Permitido',
                        text: response.detalle,
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    $('#mensaje').html('<span class="text-danger">❌ ' + response.mensaje + '</span>');
                    $('#detalle').text('');
                    Swal.fire({
                        icon: 'error',
                        title: 'Acceso Denegado',
                        text: response.mensaje
                    });
                }
                
                $('#ci').val('').focus();
            },
            error: function() {
                Swal.fire('Error', 'Ocurrió un error al verificar.', 'error');
            }
        });
    });

    // También permitir presionar Enter
    $('#ci').on('keypress', function(e) {
        if (e.which === 13) {
            $('#btnVerificar').click();
        }
    });
</script>
@stop