<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha y Hora</th>
                <th>Plan</th>
                <th>Días Restantes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id }}</td>
                    <td>{{ $asistencia->fecha_hora_ingreso->format('d/m/Y H:i') }}</td>
                    <td>{{ $asistencia->membership->planType->nombre_plan ?? 'N/A' }}</td>
                    <td>{{ $asistencia->membership->dias_disponibles ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Sin asistencias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>