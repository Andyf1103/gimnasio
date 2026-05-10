<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function registro()
    {
        return view('admin.asistencias.registro');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
        ]);

        // Buscar cliente por CI
        $cliente = Client::where('ci', $request->ci)->first();

        if (!$cliente) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'No se encontró un cliente con ese carnet.'
            ]);
        }

        // Buscar membresía activa
        $membresia = Membership::where('client_id', $cliente->id)
            ->whereIn('estado', ['ACTIVA', 'activa'])
            ->where('dias_disponibles', '>', 0)
            ->first();

        if (!$membresia) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'No tiene membresía activa. Días disponibles: 0'
            ]);
        }

        // Verificar si ya ingresó hoy
        $hoy = now()->format('Y-m-d');
        $yaIngreso = Asistencia::where('client_id', $cliente->id)
            ->whereDate('fecha_hora_ingreso', $hoy)
            ->exists();

        if ($yaIngreso) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'Ya ingresó hoy. No puede acceder nuevamente.'
            ]);
        }

        // Registrar asistencia
        Asistencia::create([
            'client_id' => $cliente->id,
            'membership_id' => $membresia->id,
            'fecha_hora_ingreso' => now(),
        ]);

        // Descontar día
        $membresia->decrement('dias_disponibles');
        $membresia->refresh();

        return response()->json([
            'status' => 'ok',
            'mensaje' => 'Acceso permitido',
            'detalle' => 'Bienvenido ' . $cliente->nombre . ' ' . $cliente->apellido . 
                         '. Plan: ' . $membresia->planType->nombre_plan . 
                         '. Días restantes: ' . $membresia->dias_disponibles
        ]);
    }
}