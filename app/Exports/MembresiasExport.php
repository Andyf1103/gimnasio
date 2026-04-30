<?php

namespace App\Exports;

use App\Models\Membership;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MembresiasExport implements FromCollection, WithHeadings, WithTitle
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
        return Membership::with(['planType', 'paymentMethod'])
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
            ->map(function ($m) {
                return [
                    $m->planType->nombre_plan ?? 'N/A',
                    $m->monto_total,
                    $m->paymentMethod->nombre ?? 'N/A',
                    $m->created_at->format('d/m/Y'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Plan', 'Monto', 'Método', 'Fecha'];
    }

    public function title(): string
    {
        return 'Membresías Vendidas';
    }
}