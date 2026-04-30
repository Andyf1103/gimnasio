<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        // Usuarios activos
        $usuariosActivos = Membership::where('estado', 'activa')
            ->distinct('client_id')
            ->count();

        // Ingresos del día
        $fechaHoy = date('Y-m-d');
        $ingresosMembresias = Membership::whereDate('created_at', $fechaHoy)->sum('monto_total');
        $ingresosVentas = \App\Models\Sale::whereDate('created_at', $fechaHoy)->sum('total');
        $ingresosDia = $ingresosMembresias + $ingresosVentas;

        // Membresías por vencer (7 días)
        $membresiasPorVencer = Membership::where('estado', 'activa')
            ->whereDate('fecha_final', '>=', $fechaHoy)
            ->whereDate('fecha_final', '<=', date('Y-m-d', strtotime('+7 days')))
            ->with('client')
            ->get();

        // Productos con bajo stock (3 o menos)
        $productosBajoStock = Product::where('stock', '<=', 3)->get();

        return view('admin.dashboard', compact(
            'usuariosActivos',
            'ingresosDia',
            'membresiasPorVencer',
            'productosBajoStock'
        ));
    }
}