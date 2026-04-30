<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReporteExport implements WithMultipleSheets
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

    public function sheets(): array
    {
        return [
            new MembresiasExport($this->fechaInicio, $this->fechaFin, $this->tipo),
            new VentasExport($this->fechaInicio, $this->fechaFin, $this->tipo),
        ];
    }
}