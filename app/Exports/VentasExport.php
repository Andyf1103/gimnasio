<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class VentasExport implements FromCollection, WithHeadings, WithTitle
{
    protected $fechaInicio;
    protected $fechaFin;
    protected $tipo;

    public function __construct($fechaInicio, $fechaFin, $tipo = null)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->tipo = $tipo;
    }

    public function collection()
    {
        return Sale::with(['employee', 'paymentMethod', 'saleDetails.product'])
            ->whereDate('created_at', '>=', $this->fechaInicio)
            ->whereDate('created_at', '<=', $this->fechaFin)
            ->when($this->tipo, function ($query) {
                if ($this->tipo == 'efectivo') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) LIKE ?', ['%efectivo%']));
                } elseif ($this->tipo == 'digital') {
                    $query->whereHas('paymentMethod', fn($q) => $q->whereRaw('LOWER(nombre) NOT LIKE ?', ['%efectivo%']));
                }
            })
            ->get()
            ->map(function ($v) {
                $productos = $v->saleDetails->map(fn($d) => ($d->product->nombre ?? 'N/A') . ' (x' . $d->cantidad . ')')->implode(', ');
                return [
                    $productos,
                    $v->total,
                    $v->paymentMethod->nombre ?? 'N/A',
                    ($v->employee->nombre ?? '') . ' ' . ($v->employee->apellido ?? ''),
                    $v->created_at->format('d/m/Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Productos', 'Total', 'Método', 'Recepcionista', 'Fecha'];
    }

    public function title(): string
    {
        return 'Ventas de Productos';
    }
}