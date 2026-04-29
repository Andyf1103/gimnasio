<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientControl extends Model
{
    protected $table = 'client_controls';
    
    protected $fillable = [
        'client_id',
        'peso_inicial',
        'peso_final',
        'talla_usuario',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}