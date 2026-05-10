<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    protected $table = 'memberships';
    
    protected $fillable = [
        'client_id',
        'plan_type_id',
        'payment_method_id',
        'employee_id',
        'fecha_inicio',
        'fecha_final',
        'monto_total',
        'saldo',
        'dias_disponibles',
        'fecha_limite_pago',
        'estado',
        'comprobante',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_final' => 'date',
        'fecha_limite_pago' => 'date',
        'creado_en' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(PagoMembresia::class);
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class);
    }

    public function getEstadoRealAttribute()
    {
        if ($this->fecha_final < now() && in_array($this->estado, ['ACTIVA', 'activa'])) {
            return 'VENCIDA';
        }
        if ($this->dias_disponibles !== null && $this->dias_disponibles <= 0 && in_array($this->estado, ['ACTIVA', 'activa'])) {
            return 'VENCIDA';
        }
        return $this->estado;
    }
}