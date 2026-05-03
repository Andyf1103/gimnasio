<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagoMembresia extends Model
{
    protected $table = 'pagos_membresias';

    protected $fillable = [
        'membership_id',
        'monto',
        'payment_method_id',
        'comprobante',
        'fecha_pago',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
    ];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}