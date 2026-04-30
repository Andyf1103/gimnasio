<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Sale;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function detalle(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', date('Y-m-d'));
        $fechaFin = $request->get('fecha_fin', date('Y-m-d'));
        $tipo = $request->get('tipo');

        $membresias = Membership::with(['client', 'planType', 'paymentMethod'])
            ->whereDate('created_at', '>=', $fechaInicio)
            ->whereDate('created_at', '<=', $fechaFin)
            ->when($tipo, function ($query, $tipo) {
                if ($tipo == 'efectivo') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) LIKE ?', ['%efectivo%']));
                } elseif ($tipo == 'digital') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) NOT LIKE ?', ['%efectivo%']));
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $ventas = Sale::with(['client', 'employee', 'paymentMethod', 'saleDetails.product'])
            ->whereDate('created_at', '>=', $fechaInicio)
            ->whereDate('created_at', '<=', $fechaFin)
            ->when($tipo, function ($query, $tipo) {
                if ($tipo == 'efectivo') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) LIKE ?', ['%efectivo%']));
                } elseif ($tipo == 'digital') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) NOT LIKE ?', ['%efectivo%']));
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reportes.detalle', compact('membresias', 'ventas', 'fechaInicio', 'fechaFin'));
    }
}