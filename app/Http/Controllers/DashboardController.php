<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        if (Auth::guard('employee')->check()) {
            return $this->employee();
        }

        $fechaHoy = date('Y-m-d');

        $usuariosActivos = Membership::where('estado', 'activa')
            ->distinct('client_id')
            ->count();

        $ingresosMembresias = Membership::whereDate('created_at', $fechaHoy)->sum('monto_total');
        $ingresosVentas = Sale::whereDate('created_at', $fechaHoy)->sum('total');
        $ingresosDia = $ingresosMembresias + $ingresosVentas;

        $membresiasPorVencer = Membership::where('estado', 'activa')
            ->whereDate('fecha_final', '>=', $fechaHoy)
            ->whereDate('fecha_final', '<=', date('Y-m-d', strtotime('+7 days')))
            ->with('client')
            ->get();

        $productosBajoStock = Product::where('stock', '<=', 3)->get();

        return view('admin.dashboard', compact(
            'usuariosActivos',
            'ingresosDia',
            'membresiasPorVencer',
            'productosBajoStock'
        ));
    }

    public function employee()
    {
        $fechaHoy = date('Y-m-d');

        $usuariosActivos = Membership::where('estado', 'activa')
            ->distinct('client_id')
            ->count();

        $ventasDia = Sale::whereDate('created_at', $fechaHoy)
            ->where('employee_id', Auth::guard('employee')->id())
            ->sum('total');

        $membresiasPorVencer = Membership::where('estado', 'activa')
            ->whereDate('fecha_final', '>=', $fechaHoy)
            ->whereDate('fecha_final', '<=', date('Y-m-d', strtotime('+7 days')))
            ->with('client')
            ->get();

        return view('employee.dashboard', compact(
            'usuariosActivos',
            'ventasDia',
            'membresiasPorVencer'
        ));
    }
}